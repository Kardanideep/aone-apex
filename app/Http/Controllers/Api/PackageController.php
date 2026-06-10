<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PackageRepositoryInterface;

class PackageController extends Controller
{
    protected $packageRepository;

    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {
        $packages = $this->packageRepository->getAllPackages(true); // active only
        return response()->json([
            'status' => 'success',
            'data' => $packages
        ]);
    }

    public function show($id)
    {
        $package = $this->packageRepository->getPackageById($id);
        
        if (!$package || !$package->status) {
            return response()->json([
                'status' => 'error',
                'message' => 'Package not found or inactive'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $package
        ]);
    }
}
