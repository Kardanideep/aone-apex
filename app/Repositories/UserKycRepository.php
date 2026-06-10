<?php

namespace App\Repositories;

use App\Models\UserKyc;
use App\Repositories\Interfaces\UserKycRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class UserKycRepository implements UserKycRepositoryInterface
{
    protected $cacheTtl = 3600;

    public function getKycByUserId($userId)
    {
        return Cache::remember("user_kyc.{$userId}", $this->cacheTtl, function () use ($userId) {
            return UserKyc::where('user_id', $userId)->first();
        });
    }

    public function submitKyc($userId, array $data)
    {
        $kyc = UserKyc::updateOrCreate(
            ['user_id' => $userId],
            $data
        );
        
        $this->clearCache($userId);
        return $kyc;
    }

    public function updateKycStatus($kycId, $status)
    {
        $kyc = UserKyc::find($kycId);
        if ($kyc) {
            $kyc->update(['status' => $status]);
            $this->clearCache($kyc->user_id);
            return $kyc;
        }
        return null;
    }

    protected function clearCache($userId)
    {
        Cache::forget("user_kyc.{$userId}");
    }
}
