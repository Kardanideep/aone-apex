<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

$admin = Admin::firstOrCreate(
    ['email' => 'admin@aoneapex.com'],
    [
        'name' => 'Super Admin',
        'password' => Hash::make('password')
    ]
);

echo "Admin created: admin@aoneapex.com / password\n";
