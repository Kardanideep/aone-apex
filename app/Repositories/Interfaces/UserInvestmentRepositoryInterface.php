<?php

namespace App\Repositories\Interfaces;

interface UserInvestmentRepositoryInterface
{
    public function getAllInvestments();
    public function getInvestmentById($id);
    public function createInvestment(array $data);
    public function updateInvestment($id, array $data);
    public function deleteInvestment($id);
}
