<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    protected $packageRepository;

    public function __construct(PackageRepositoryInterface $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function index()
    {
        $packages = $this->packageRepository->getAllPackages(); // all
        return response()->json([
            'status' => 'success',
            'data' => $packages
        ]);
    }

    public function show($id)
    {
        $package = $this->packageRepository->getPackageById($id);
        if (!$package) {
            return response()->json(['status' => 'error', 'message' => 'Package not found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $package]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'boolean',
        ]);

        $package = $this->packageRepository->createPackage($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Package created successfully',
            'data' => $package
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'amount' => 'sometimes|numeric|min:0',
            'status' => 'boolean',
        ]);

        $package = $this->packageRepository->updatePackage($id, $validated);

        if (!$package) {
            return response()->json(['status' => 'error', 'message' => 'Package not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Package updated successfully',
            'data' => $package
        ]);
    }

    public function destroy($id)
    {
        $deleted = $this->packageRepository->deletePackage($id);

        if (!$deleted) {
            return response()->json(['status' => 'error', 'message' => 'Package not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Package deleted successfully'
        ]);
    }
}
