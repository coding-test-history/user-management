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
        foreach ($roles as $key => $value) {
            $num = $key + 1;
            User::factory()->withPersonalTeam()->create([
                'name' => 'User ' . $num,
                'email' =>  'user' . $num . '@mail.com',
                'role_id' => $value->id,
                'password' => 'password'
            ]);
        }
    }
}
