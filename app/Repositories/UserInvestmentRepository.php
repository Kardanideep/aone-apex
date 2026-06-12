<?php

namespace App\Repositories;

use App\Models\UserInvestment;
use App\Repositories\Interfaces\UserInvestmentRepositoryInterface;

class UserInvestmentRepository implements UserInvestmentRepositoryInterface
{
    public function getAllInvestments()
    {
        return UserInvestment::latest()->get();
    }

    public function getInvestmentById($id)
    {
        return UserInvestment::find($id);
    }

    public function createInvestment(array $data)
    {
        return UserInvestment::create($data);
    }

    public function updateInvestment($id, array $data)
    {
        $investment = UserInvestment::find($id);
        if ($investment) {
            $investment->update($data);
            return $investment;
        }
        return null;
    }

    public function deleteInvestment($id)
    {
        $investment = UserInvestment::find($id);
        if ($investment) {
            return $investment->delete();
        }
        return false;
    }
}
