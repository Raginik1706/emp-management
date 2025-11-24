<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name'=>'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('_rag7890'),
            'dob'=>'2002-06-17',
            'age'=> Carbon::parse('2002-06-17')->age,
            'userType'=>0
        ]);
    }
}
