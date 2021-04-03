<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class account extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_accounts')->insert([
            'acc_type'     => 1,
            'acc_username' => 'admin',
            'acc_password' => \bcrypt('admin'),
            'acc_name'     => 'Administrator',
            'acc_email'    => 'ianbalatbat@gmail.com',
        ]);
    }
}
