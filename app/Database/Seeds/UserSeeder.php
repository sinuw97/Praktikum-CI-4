<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use PhpParser\Error;
use Throwable;

class UserSeeder extends Seeder
{
    public function run()
    {
        try {
            $data = [
                [
                    'name' => 'Budi',
                    'username' => 'admin',
                    'password' => password_hash('admin', PASSWORD_BCRYPT),
                    'created_at' => Time::now('Asia/Jakarta'),
                ],
                [
                    'name' => 'Hartanto',
                    'username' => 'hartanto',
                    'password' => password_hash('hartanto', PASSWORD_BCRYPT),
                    'created_at' => Time::now('Asia/Jakarta'),
                ],
            ];
            $this->db->table('users')->insertBatch($data);
        } catch (Throwable $e) {
            echo 'Seeder error: ' . $e->getMessage();
        }
    }
}
