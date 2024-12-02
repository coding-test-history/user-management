<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get role data
        $roles = Role::select('id', 'role_name')->get();

        // create uesr
        foreach ($roles as $value) {
            $roleName = $value->role_name;
            User::factory()->withPersonalTeam()->create([
                'name' => $roleName,
                'email' => str_replace(' ', '_', $roleName) . '@example.com',
                'role_id' => $value->id,
                'password' => Hash::make('password')
            ]);
        }
    }
}
