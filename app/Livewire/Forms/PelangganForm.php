<?php

namespace App\Livewire\Forms;

use App\Models\Pelanggan;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PelangganForm extends Form
{
    public ?Pelanggan $pelanggan = null;

    public $name = '';
    public $username = '';
    public $noHp = '';
    public $tglLahir = '';
    public $alamat = '';

    public function setPelanggan(Pelanggan $pelanggan)
    {
        $this->pelanggan = $pelanggan;
        $this->name = $pelanggan->nama;
        $this->username = $pelanggan->username;
        $this->noHp = $pelanggan->no_hp;
        $this->tglLahir = $pelanggan->tgl_lahir;
        $this->alamat = $pelanggan->alamat;

        Flux::modal('crud-pelanggan')->show();
    }

    public function store()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3', 'max:10', Rule::unique('pelanggans')->ignore($this->pelanggan?->id)],
            'noHp' => ['required', 'string', 'min:10', 'max:13'],
            'tglLahir' => ['required', 'date'],
            'alamat' => ['required'],
        ];

        $this->validate($rules);

        if ($this->pelanggan) {
            // update pelanggan yang sudah ada
            $this->pelanggan->fill([
                'nama' => $this->name,
                'username' => $this->username,
                'no_hp' => $this->noHp,
                'tgl_lahir' => $this->tglLahir,
                'alamat' => $this->alamat,
            ]);

            $this->pelanggan->save();
        } else {
            // Buat pelanggan baru
            Pelanggan::create([
                'nama' => $this->name,
                'username' => $this->username,
                'no_hp' => $this->noHp,
                'tgl_lahir' => $this->tglLahir,
                'alamat' => $this->alamat,
            ]);
        }

        $this->resetInput();
        Flux::modal('crud-pelanggan')->close();
    }

    public function delete($pelangganId)
    {
        $pelanggan = Pelanggan::findOrFail($pelangganId);
        $pelanggan->delete();
    }

    public function resetInput()
    {
        $this->reset();
        $this->pelanggan = null;
    }
}
