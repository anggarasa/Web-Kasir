<?php

namespace App\Livewire\Pelanggan;

use App\Livewire\Forms\PelangganForm;
use App\Models\Pelanggan as ModelsPelanggan;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Pelanggan extends Component
{
    use WithPagination, WithFileUploads;

    public PelangganForm $form;

    public $search = '';
    public $searchDate = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSearchDate()
    {
        $this->resetPage();
    }

    public function save()
    {
            $this->form->store();

            $this->dispatch('notification', 'success', 'Customer saved successfully.');
    }

    public function edit(ModelsPelanggan $pelanggan)
    {
        $this->form->setPelanggan($pelanggan);
    }

    public function confirmDelete($pelangganId)
    {
        $pelanggan = ModelsPelanggan::findOrFail($pelangganId);

        $this->dispatch('notification',
            type : 'warning',
            message: 'Are you sure you want to delete ' . $pelanggan->nama . ' customer?', 
            actionEvent: 'deletePelanggan',
            actionParams: [$pelangganId]
        );
    }

    #[On('deletePelanggan')]
    public function delete($pelangganId)
    {
        $this->form->delete($pelangganId);

        $this->dispatch('notification',
            type: 'success',
            message: 'Customer deleted successfully'
        );
    }
    
    public function render()
    {
        $pelanggans = ModelsPelanggan::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama', 'like', "%{$this->search}%")
                      ->orWhere('no_hp', 'like', "%{$this->search}%")
                      ->orWhere('username', 'like', "%{$this->search}%")
                      ->orWhere('alamat', 'like', "%{$this->search}%");
                });
            })
            ->when($this->searchDate, function ($query) {
                $query->whereDate('tgl_lahir', $this->searchDate);
            })
            ->latest()
            ->paginate(5);
        
        return view('livewire.pelanggan.pelanggan', compact('pelanggans'));
    }

    public function resetInput()
    {
        $this->form->resetInput();
    }
}
