<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ListUsers extends AdminComponent
{
    public $state = [];

    public $user;

    public $showEditModal = false;

    public $userIdBeingRemoved = null;

    public function AddNew()
    {
        $this->state = [];

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {

        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ])->validate();

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User Added Successfully']);
    }

    public function edit(User $user)
    {
        $this->showEditModal = true;
        $this->user = $user;

        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $this->user->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User Updated Successfully']);
    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-modal',  ['message' => 'User Deleted Successfully']);
    }

    public function render()
    {
        $users = User::latest()->paginate(5);
        return view('livewire.admin.users.list-users', [
            'users' => $users
        ]);
    }
}
