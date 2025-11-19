<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::firstOrNew(
            [
                'email' => 'admin@admin.com'
            ]
        );

        $adminUser->fill([
            'name'  => 'Admin User',
            'type'  => User::TYPE_ADMIN,
        ]);

        $adminUser->password = 'abc123';
        $adminUser->save();
    }
}
