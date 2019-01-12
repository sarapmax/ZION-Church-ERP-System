<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cell_id' => 1,
            'email' => 'teerpong.me@gmail.com',
            'password' => bcrypt('035505791aA'),
            'administrative_status' => 1,
            'spiritual_status' => 6,
            'first_name' => 'Teerpong',
            'last_name' => 'Phothiphun',
            'nickname' => 'Max',
            'birthday' => '1995-03-03',
            'idcard' => '3344433323',
            'race' => 'Thai',
            'nationality' => 'Thai',
            'mobile_number' => '0861752745',
            'facebook' => 'Teerpong Phothiphun',
            'line' => 'max20958'
        ]);
    }
}
