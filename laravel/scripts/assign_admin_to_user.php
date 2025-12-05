<?php
// Simple script to bootstrap Laravel and assign the 'admin' role to user id 1
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$user = User::find(1);
if (! $user) {
    echo "User with id=1 not found\n";
    exit(1);
}

try {
    $user->assignRole('admin');
    echo "Assigned role 'admin' to user id {$user->id}\n";
} catch (Throwable $e) {
    echo "Error assigning role: " . $e->getMessage() . "\n";
    exit(2);
}
