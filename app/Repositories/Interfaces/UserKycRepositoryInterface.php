<?php

namespace App\Repositories\Interfaces;

interface UserKycRepositoryInterface
{
    public function getKycByUserId($userId);
    public function submitKyc($userId, array $data);
    public function updateKycStatus($kycId, $status);
}
