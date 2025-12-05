<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'worker', 'client'];

        foreach ($roles as $name) {
            Role::firstOrCreate(['name' => $name, 'guard_name' => config('auth.defaults.guard', 'web')]);
        }
    }
}
