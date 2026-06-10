<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class UserRepository implements UserRepositoryInterface
{
    protected $cacheTtl = 3600; // 1 hour

    public function getAllUsers()
    {
        return Cache::remember('users.all', $this->cacheTtl, function () {
            return User::all();
        });
    }

    public function getUserById($id)
    {
        return Cache::remember("users.{$id}", $this->cacheTtl, function () use ($id) {
            return User::find($id);
        });
    }

    public function createUser(array $data)
    {
        $user = User::create($data);
        $this->clearCache();
        return $user;
    }

    public function updateUser($id, array $data)
    {
        $user = User::find($id);
        if ($user) {
            $user->update($data);
            $this->clearCache($id);
            return $user;
        }
        return null;
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->clearCache($id);
            return true;
        }
        return false;
    }

    protected function clearCache($id = null)
    {
        Cache::forget('users.all');
        if ($id) {
            Cache::forget("users.{$id}");
        }
    }
}
