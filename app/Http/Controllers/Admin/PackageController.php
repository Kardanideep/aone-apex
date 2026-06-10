<?php

namespace App\Http\Controllers\Admin;

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
        $packages = $this->packageRepository->getAllPackages();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $validated['status'] = $request->has('status');

        $this->packageRepository->createPackage($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Package created successfully.');
    }

    public function edit($id)
    {
        $package = $this->packageRepository->getPackageById($id);
        if (!$package) {
            return redirect()->route('admin.packages.index')->with('error', 'Package not found.');
        }
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $validated['status'] = $request->has('status');

        $this->packageRepository->updatePackage($id, $validated);

        return redirect()->route('admin.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $this->packageRepository->deletePackage($id);
        return redirect()->route('admin.packages.index')->with('success', 'Package deleted successfully.');
    }
}
