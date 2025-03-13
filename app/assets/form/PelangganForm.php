<?php

namespace App\Livewire\Forms;

use App\Models\Pelanggan;
use Flux\Flux;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PelangganForm extends Form
{
    public ?Pelanggan $pelanggan = null;
    
    public $foto;
    public $name = '';
    public $username = '';
    public $noHp = '';
    public $tglLahir = '';
    public $alamat = '';
    public $oldFoto;

    public function setPelanggan(Pelanggan $pelanggan)
    {
        $this->pelanggan = $pelanggan;
        $this->name = $pelanggan->nama;
        $this->username = $pelanggan->username;
        $this->noHp = $pelanggan->no_hp;
        $this->tglLahir = $pelanggan->tgl_lahir;
        $this->alamat = $pelanggan->alamat;
        $this->oldFoto = $pelanggan->foto;
        
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
            'foto' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2024'],
        ];
        
        $this->validate($rules);

        if ($this->pelanggan) {
            // update pelanggan yang sudah ada
            $fotoURL = $this->pelanggan->foto;

            if ($this->foto) {
                // jika foto diubah hapus foto lama jika ada & simpan foto baru
                if ($fotoURL && Storage::disk('public')->exists($fotoURL)) {
                    Storage::disk('public')->delete($fotoURL);
                }

                $fotoURL = $this->foto->storeAs('pelanggan/', $this->name . '_' . now()->timestamp . '.' . $this->foto->getClientOriginalExtension(), 'public');
            }

            $this->pelanggan->fill([
                'nama' => $this->name,
                'username' => $this->username,
                'no_hp' => $this->noHp,
                'tgl_lahir' => $this->tglLahir,
                'alamat' => $this->alamat,
                'foto' => $fotoURL,
            ]);

            $this->pelanggan->save();
        } else {
            // Buat pelanggan baru
            $createFoto = $this->foto ? $this->foto->storeAs('pelanggan', $this->name. '_' . now()->timestamp . '.' . $this->foto->getClientOriginalExtension(), 'public') : null;

            Pelanggan::create([
                'nama' => $this->name,
                'username' => $this->username,
                'no_hp' => $this->noHp,
                'tgl_lahir' => $this->tglLahir,
                'alamat' => $this->alamat,
                'foto' => $createFoto
            ]);
        }
        
        $this->resetInput();
        Flux::modal('crud-pelanggan')->close();
    }

    public function delete($pelangganId)
    {
        $pelanggan = Pelanggan::findOrFail($pelangganId);

        // hapus foto pelanggan jika ada
        if ($pelanggan->foto && Storage::disk('public')->exists($pelanggan->foto)) {
            Storage::disk('public')->delete($pelanggan->foto);
        }
        
        $pelanggan->delete();
    }

    public function resetInput()
    {
        $this->reset();
        $this->pelanggan = null;
    }
}
