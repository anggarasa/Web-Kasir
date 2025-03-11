<?php

namespace App\Livewire\History;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryPayment extends Component
{
    use WithPagination;
    
    public string $searchCustomer = '';
    public string $searchCashier = '';
    public ?string $searchDate = null;

    public function updatingSearchCustomer()
    {
        $this->resetPage();
    }

    public function updatingSearchCashier()
    {
        $this->resetPage();
    }

    public function updatingSearchDate()
    {
        $this->resetPage();
    }

    
    public function render()
    {
        $transaksions = Transaksi::with(['pelanggan', 'user'])
            ->when($this->searchCustomer, fn ($query) => $query->whereHas('pelanggan', fn ($q) => $q->where('nama', 'like', "%{$this->searchCustomer}%")))
            ->when($this->searchCashier, fn ($query) => $query->whereHas('user', fn ($q) => $q->where('name', 'like', "%{$this->searchCashier}%")))
            ->when($this->searchDate, fn ($query) => $query->whereDate('tgl_transaksi', $this->searchDate))
            ->latest()
            ->paginate(5);
        
        return view('livewire.history.history-payment', compact('transaksions'));
    }
}
