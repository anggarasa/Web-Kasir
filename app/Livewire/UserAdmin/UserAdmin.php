<?php

namespace App\Livewire\UserAdmin;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Forms\UserAdminForm;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class UserAdmin extends Component
{
    use WithPagination;

    public UserAdminForm $form;

    #[Url()]
    public $search = '';

    public function save()
    {
            $this->form->store();
            $this->dispatch('notification', 'success', 'User saved successfully.');
    }

    public function edit(User $user)
    {
        $this->form->setUser($user);
    }

    public function confirmDeleteUser($id)
    {
        $user = User::findOrFail($id);

        $this->dispatch('notification',
            type: 'warning',
            message: 'Are you sure, you want to delete the admin user '. $user->name .' ?',
            actionEvent: 'deleteUser',
            actionParams: [$id]
        );
    }

    #[On('deleteUser')]
    public function deleteUser($userId)
    {
        $this->form->delete($userId);

        $this->dispatch('notification',
            type: 'success',
            message: 'User deleted successfully.'
        );
    }

    public function searchUser()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.user-admin.user-admin', [
            'users' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'admin');
                })
                ->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%");
                })
                ->latest()
                ->paginate(5)
        ]);
    }

    // reset input
    public function resetInput()
    {
        $this->form->resetInput();
    }
}
