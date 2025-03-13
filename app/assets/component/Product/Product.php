<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\ProductForm;
use App\Models\Product as ModelsProduct;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public ProductForm $form;
    
    #[Url()]
    public $search = '';
    
    public function save()
    {
        $this->form->store();

        $this->dispatch('notification',
            type: 'success',
            message: 'Product saved successfully',
        );
    }

    public function edit(ModelsProduct $product)
    {
        $this->form->setProduct($product);
    }

    public function confirmDelete($productId)
    {
        $product = ModelsProduct::find($productId);

        $this->dispatch('notification',
            type: 'warning',
            message: 'Are you sure you want to delete ' . $product->nama_produk . ' product?',
            actionEvent: 'deleteProduct',
            actionParams: [$productId]
        );
    }

    #[On('deleteProduct')]
    public function delete($productId)
    {
        $this->form->delete($productId);
        
        $this->dispatch('notification', 'success', 'Product deleted successfully');
    }
    
    public function searchProduct()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $query = ModelsProduct::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_produk', 'like', '%' . $this->search . '%')
                  ->orWhere('harga_produk', 'like', '%' . $this->search . '%')
                  ->orWhere('stok', 'like', '%' . $this->search . '%');
            });
        }

        $products = $query->latest()->paginate(5);
        
        return view('livewire.product.product', compact(['products']));
    }

    public function resetInput()
    {
        $this->form->resetInput();
    }
}
