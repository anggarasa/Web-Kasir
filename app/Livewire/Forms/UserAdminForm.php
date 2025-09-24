<?php

namespace App\Livewire\Forms;

use Flux\Flux;
use Livewire\Form;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserAdminForm extends Form
{
    public ?User $user = null;

    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        Flux::modal('crud-admin')->show();
    }

    public function store()
    {
        $rules = [
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
            $this->user->fill([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if ($this->password) {
                $this->user->password = Hash::make($this->password);
            }

            $this->user->save();
        } else {
            // Buat user baru
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            $user->assignRole('admin');
        }

        $this->resetInput();
        Flux::modal('crud-admin')->close();
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
    }

    public function resetInput()
    {
        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
        ]);
        $this->user = null;
    }
}
