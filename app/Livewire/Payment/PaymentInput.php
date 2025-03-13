<?php

namespace App\Livewire\Payment;

use App\Models\DetailTransaksi;
use App\Models\Pelanggan;
use App\Models\Product;
use App\Models\Transaksi;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentInput extends Component
{
    public ?Pelanggan $customer = null;
    public $selectedProducts = [];
    public $search = '';
    public $searchProduk = '';
    public $productQuantities = [];
    public $totalPayment = ''; // Property baru untuk menyimpan total pembayaran

    public function mount()
    {
        $this->selectedProducts = [];
        $this->productQuantities = [];
    }

    public function setCustomer($customerId)
    {
        $this->customer = Pelanggan::find($customerId);
        Flux::modal('select-customer')->close();
        
        // Reset selected products when customer changes
        $this->resetProducts();
    }

    public function resetCustomer()
    {
        $this->customer = null;
        $this->resetProducts();
    }
    
    public function resetSearch()
    {
        $this->search = '';
    }
    
    public function resetProductSearch()
    {
        $this->searchProduk = '';
    }
    
    public function resetProducts()
    {
        $this->selectedProducts = [];
        $this->productQuantities = [];
        $this->totalPayment = '';
    }
    
    public function addProduct($productId)
    {
        $product = Product::find($productId);
        
        if ($product && !in_array($productId, array_column($this->selectedProducts, 'id'))) {
            $this->selectedProducts[] = [
                'id' => $product->id,
                'nama' => $product->nama_produk,
                'harga' => $product->harga_produk,
                'quantity' => 1
            ];
            
            $this->productQuantities[$product->id] = 1;
        }
        
        $this->searchProduk = '';
    }
    
    public function removeProduct($productId)
    {
        $this->selectedProducts = array_filter($this->selectedProducts, function($product) use ($productId) {
            return $product['id'] != $productId;
        });
        
        unset($this->productQuantities[$productId]);
    }
    
    public function updateQuantity($productId, $quantity)
    {
        $quantity = max(1, intval($quantity)); // Ensure quantity is at least 1
        
        $this->productQuantities[$productId] = $quantity;
        
        foreach ($this->selectedProducts as $key => $product) {
            if ($product['id'] == $productId) {
                $this->selectedProducts[$key]['quantity'] = $quantity;
                break;
            }
        }
    }
    
    // Method baru untuk menghitung total harga semua produk
    public function getTotalPrice()
    {
        return collect($this->selectedProducts)->sum(function($product) {
            return $product['harga'] * $product['quantity'];
        });
    }
    
    // Method baru untuk menghitung kembalian
    public function getChangeAmount()
    {
        $totalPrice = $this->getTotalPrice();
        
        // Konversi totalPayment dari string ke integer (menghapus format Rp dan tanda titik)
        $payment = $this->totalPayment;
        
        if (empty($payment)) {
            return 0;
        }
        
        // Hilangkan karakter non-numerik
        $payment = preg_replace('/[^0-9]/', '', $payment);
        
        // Konversi ke integer
        $payment = intval($payment);
        
        // Hitung kembalian
        $change = $payment - $totalPrice;
        
        // Jika kembalian negatif, kembalikan 0
        return max(0, $change);
    }

    // simpan input payment sistem
    public function save()
    {
        $this->validate(['totalPayment' => ['required', 'numeric']]);

        // Convert totalPayment to integer (removing format)
        $payment = preg_replace('/[^0-9]/', '', $this->totalPayment);
        $payment = intval($payment);
        
        // Check if payment amount is less than total price
        if ($payment < $this->getTotalPrice()) {
            $this->dispatch('notification', 'error', 'Payment amount is insufficient! Please enter the correct amount.');
            return;
        }

        // simpan transaksi
        $user = Auth::user();
        $transaksi = Transaksi::create([
            'user_id' => $user->id,
            'pelanggan_id' => $this->customer->id,
            'uang_diberikan' => $payment,
            'kembalian' => $this->getChangeAmount(),
            'total_harga' => $this->getTotalPrice(),
            'tgl_transaksi' => now(),
        ]);

        // simpan detail transaksi
        foreach ($this->selectedProducts as $product) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $product['id'],
                'jumlah' => $product['quantity'], 
                'subtotal' => $product['harga'] * $product['quantity'],
            ]);

            $produk = Product::find($product['id']);
            // kurangi stok produk
            $stok = $produk->stok -= $product['quantity'];
            $produk->update(['stok' => $stok]);
        }

        // kirim notifikasi success
        $this->dispatch('notification', 'success', 'Payment has been successfully recorded!');

        $this->reset();
    }
    
    public function render()
    {
        $customers = Pelanggan::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('username', 'like', '%' . $this->search . '%')
            ->get();

        $products = Product::where('nama_produk', 'like', '%' . $this->searchProduk . '%')
                ->orWhere('harga_produk', 'like', '%' . $this->searchProduk . '%')
                ->get();
        
        $totalPrice = $this->getTotalPrice();
        $changeAmount = $this->getChangeAmount();
        
        return view('livewire.payment.payment-input', [
            'customers' => $customers,
            'products' => $products,
            'totalPrice' => $totalPrice,
            'changeAmount' => $changeAmount,
        ]);
    }
}
