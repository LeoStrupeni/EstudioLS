<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Leo Strupeni',
            'email' => 'leonardo.strupeni@gmail.com',
            'password' => Hash::make('1234')
        ]);
        $admin->assignRole('sistema');

        $admin1 = User::create([
            'name' => 'Lignos Melina',
            'email' => 'melinalignos@gmail.com',
            'password' => Hash::make('mlignos')
        ]);

        $admin1->assignRole('admin');

        $admin2 = User::create([
            'name' => 'Seguro Julia C',
            'email' => 'juliacsegurov@gmail.com',
            'password' => Hash::make('jseguro')
        ]);

        $admin2->assignRole('admin');

        $assistant = User::create([
            'name' => 'Montoreano Ardizzi Maria Victoria',
            'email' => 'mardizzimvictoria@gmail.com',
            'password' => Hash::make('vmontoreano')
        ]);

        $assistant->assignRole('secretaria');
    }
}
