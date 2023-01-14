<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $data = [
           'password' => password_hash('admin', PASSWORD_DEFAULT)
        ];

        // Using Query Builder
        $this->db->table('account')->insert($data);
    }
}
