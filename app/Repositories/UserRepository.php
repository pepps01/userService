<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements RepositoryInterfaces\UserRepositoryInterface
{

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user;
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function getAll()
    {
        return User::orderBy('created_at', 'desc')->paginate();
    }

    public function getById(int $id)
    {
        return User::where('id', $id)->firstorFail();
    }

    public function getUsersByRole( int $roleId)
    {
        return User::where('role_id', $roleId)->orderBy('created_at', 'desc')->paginate();
    }
}
