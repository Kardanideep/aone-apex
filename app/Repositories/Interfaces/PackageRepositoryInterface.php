<?php

namespace App\Repositories\Interfaces;

interface PackageRepositoryInterface
{
    public function getAllPackages($activeOnly = false);
    public function getPackageById($id);
    public function createPackage(array $data);
    public function updatePackage($id, array $data);
    public function deletePackage($id);
}
