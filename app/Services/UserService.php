<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function all()
    {
        return User::paginate(5);
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function create(array $data): User
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $data['is_admin'] = $data['type'];
        return User::create($data);
    }

    public function update(array $data, int $id): User
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->find($id);
        return $user->delete();
    }

    public function countUsers(): int
    {
        return User::count();
    }
}
