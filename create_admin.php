<?php
require __DIR__ . '/bootstrap/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'Admin User',
    'email' => 'admin@bookstore.com',
    'password' => Hash::make('password123'),
    'role' => 'admin'
]);

echo "Admin user created successfully!\n";
echo "Email: admin@bookstore.com\n";
echo "Password: password123\n";
