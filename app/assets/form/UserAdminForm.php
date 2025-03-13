<?php

namespace App\Livewire\Forms;

use Flux\Flux;
use Livewire\Form;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserAdminForm extends Form
{
    public ?User $user = null;

    public $image;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $oldImage;

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->oldImage = $user->image;
        Flux::modal('crud-admin')->show();
    }

    public function store()
    {
        $rules = [
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'], // Max 2MB
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:dns,rfc,strict', Rule::unique('users')->ignore($this->user?->id)],
        ];

        if (!$this->user) {
            // Password hanya divalidasi saat create user
            $rules['password'] = ['required', 'string', 'confirmed', Rules\Password::defaults()];
        } else {
            // Password opsional saat update, tapi harus dikonfirmasi jika diisi
            $rules['password'] = ['nullable', 'string', 'confirmed', Rules\Password::defaults()];
        }

        $this->validate($rules);

        if ($this->user) {
            // Update user yang sudah ada
            $imageURL = $this->user->image;

            if ($this->image) {
                // Hapus gambar lama jika ada
                if ($imageURL && Storage::disk('public')->exists($imageURL)) {
                    Storage::disk('public')->delete($imageURL);
                }

                // Simpan gambar baru
                $imageURL = $this->image->storeAs('user-admin', $this->name . '_' . now()->timestamp . '.' . $this->image->getClientOriginalExtension(), 'public');
            }

            $this->user->fill([
                'name' => $this->name,
                'email' => $this->email,
                'image' => $imageURL,
            ]);

            if ($this->password) {
                $this->user->password = Hash::make($this->password);
            }

            $this->user->save();
        } else {
            // Buat user baru
            $createImageURL = $this->image ? $this->image->storeAs('user-admin', $this->name . '_' . now()->timestamp . '.' . $this->image->getClientOriginalExtension(), 'public') : null;

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'image' => $createImageURL,
            ]);
            $user->assignRole('admin');
        }

        $this->resetInput();
        Flux::modal('crud-admin')->close();
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);

        // hapus image dari storage
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $user->delete();
    }

    public function resetInput()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
            'image',
            'oldImage'
        ]);
        $this->user = null;
    }
}
