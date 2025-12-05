<?php
// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

echo "Testing roles...\n";

// Test 1: Get all roles
$roles = Role::all();
echo "\nAll roles in database:\n";
foreach ($roles as $role) {
    echo "  - {$role->name}\n";
}

// Test 2: Get user and their roles
$user = User::find(1);
if ($user) {
    echo "\nUser id=1: {$user->name}\n";
    echo "Roles: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";
} else {
    echo "\nUser id=1 not found\n";
}

echo "\nSuccess!\n";
