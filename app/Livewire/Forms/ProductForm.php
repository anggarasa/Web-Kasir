<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product = null;

    public $name = '';
    public $price = '';
    public $stok = '';

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->nama_produk;
        $this->price = $product->harga_produk;
        $this->stok = $product->stok;

        Flux::modal('crud-product')->show();
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'stok' => ['required', 'integer'],
        ]);

        if ($this->product) {
            // Update product
            $this->product->fill([
                'nama_produk' => $this->name,
                'harga_produk' => $this->price,
                'stok' => $this->stok,
            ]);

            $this->product->save();
        } else {
            // Create new product
            Product::create([
                'nama_produk' => $this->name,
                'harga_produk' => $this->price,
                'stok' => $this->stok,
            ]);

        }
        $this->resetInput();

        Flux::modal('crud-product')->close();
    }

    public function delete($productId)
    {
        $produk = Product::findOrFail($productId);
        $produk->delete();
    }

    // reset input
    public function resetInput()
    {
        $this->reset([
            'name',
            'price',
            'stok',
        ]);
        $this->product = null;
    }
}
