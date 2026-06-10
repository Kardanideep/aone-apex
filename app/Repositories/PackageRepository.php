<?php

namespace App\Repositories;

use App\Models\Package;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class PackageRepository implements PackageRepositoryInterface
{
    protected $cacheTtl = 3600; // 1 hour

    public function getAllPackages($activeOnly = false)
    {
        $cacheKey = $activeOnly ? 'packages.active' : 'packages.all';
        
        return Cache::remember($cacheKey, $this->cacheTtl, function () use ($activeOnly) {
            if ($activeOnly) {
                return Package::where('status', true)->get();
            }
            return Package::all();
        });
    }

    public function getPackageById($id)
    {
        return Cache::remember("packages.{$id}", $this->cacheTtl, function () use ($id) {
            return Package::find($id);
        });
    }

    public function createPackage(array $data)
    {
        $package = Package::create($data);
        $this->clearCache();
        return $package;
    }

    public function updatePackage($id, array $data)
    {
        $package = Package::find($id);
        if ($package) {
            $package->update($data);
            $this->clearCache($id);
            return $package;
        }
        return null;
    }

    public function deletePackage($id)
    {
        $package = Package::find($id);
        if ($package) {
            $package->delete();
            $this->clearCache($id);
            return true;
        }
        return false;
    }

    protected function clearCache($id = null)
    {
        Cache::forget('packages.all');
        Cache::forget('packages.active');
        if ($id) {
            Cache::forget("packages.{$id}");
        }
    }
}
