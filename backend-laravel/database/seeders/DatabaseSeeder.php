<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Insert admin credentials
        DB::table('admin_credentials')->insert([
            'admin_email' => 'admin@gmail.com',
            'admin_password' => Hash::make('admin')
        ]);

        // Insert users with specified IDs from 1 to 10
        DB::table('users')->insert([
            [
                'user_name' => 'Lidia',
                'user_email' => 'lidia.client@gmail.com',
                'user_password' => Hash::make('mdp123'),
                'user_birthday' => '1985-06-15',
                'email_verified_at' => '2025-01-10 15:30:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'John Doe',
                'user_email' => 'john.doe@gmail.com',
                'user_password' => Hash::make('securepassword1'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'Jane Smith',
                'user_email' => 'jane.smith@gmail.com',
                'user_password' => Hash::make('securepassword2'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'Alice Cooper',
                'user_email' => 'alice.cooper@gmail.com',
                'user_password' => Hash::make('password1'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'Bob Marley',
                'user_email' => 'bob.marley@gmail.com',
                'user_password' => Hash::make('password2'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'Charlie Brown',
                'user_email' => 'charlie.brown@gmail.com',
                'user_password' => Hash::make('password3'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'Diana Prince',
                'user_email' => 'diana.prince@gmail.com',
                'user_password' => Hash::make('password4'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => "Emma Watson",
                'user_email' => "emma.watson@gmail.com",
                'user_password' => Hash::make("password5"),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'Frank Sinatra',
                'user_email' => 'frank.sinatra@gmail.com',
                'user_password' => Hash::make('password6'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ],
            [
                'user_name' => 'Grace Hopper',
                'user_email' => 'grace.hopper@gmail.com',
                'user_password' => Hash::make('password7'),
                'user_birthday' => '1990-08-25',
                'email_verified_at' => '2025-01-09 10:00:00',
                'role' => 'CLIENT'
            ]
        ]);

        // Insert cryptocurrencies
        DB::table('crypto')->insert([
            ['label' => 'Bitcoin'],
            ['label' => 'Ethereum'],
            ['label' => 'Ripple'],
            ['label' => 'Litecoin'],
            ['label' => 'Cardano'],
            ['label' => 'Polkadot'],
            ['label' => 'Chainlink'],
            ['label' => 'Bitcoin Cash'],
            ['label' => 'Stellar'],
            ['label' => 'Dogecoin']
        ]);

        DB::table('crypto_cours')->insert([
            ['id_crypto' => 1, 'cours' => 50000.00, 'date_cours' => '2025-01-01 10:00:00'],
            ['id_crypto' => 2, 'cours' => 3000.00, 'date_cours' => '2025-01-01 11:15:00'],
            ['id_crypto' => 3, 'cours' => 5000, 'date_cours' => '2025-01-01 12:30:00'],
            ['id_crypto' => 4, 'cours' => 1500.00, 'date_cours' => '2025-01-01 13:45:00'],
            ['id_crypto' => 5, 'cours' => 1778.20, 'date_cours' => '2025-01-01 14:00:00'],
            ['id_crypto' => 6, 'cours' => 10300.00, 'date_cours' => '2025-01-01 15:10:00'],
            ['id_crypto' => 7, 'cours' => 70000.00, 'date_cours' => '2025-01-01 16:20:00'],
            ['id_crypto' => 8, 'cours' => 3000.00, 'date_cours' => '2025-01-01 17:30:00'],
            ['id_crypto' => 9, 'cours' => 150, 'date_cours' => '2025-01-01 18:40:00'],
            ['id_crypto' => 10, 'cours' => 7500, 'date_cours' => '2025-01-01 19:50:00']
        ]);

        // Insert crypto transactions
        DB::table('crypto_transactions')->insert([
            ['id_user' => 1, 'id_crypto' => 1, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 0.5, 'date_transaction' => '2025-01-07 10:00:00'],
            ['id_user' => 2, 'id_crypto' => 2, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 1.0, 'date_transaction' => '2025-01-08 11:15:00'],
            ['id_user' => 3, 'id_crypto' => 3, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 10.0, 'date_transaction' => '2025-01-09 12:30:00'],
            ['id_user' => 4, 'id_crypto' => 4, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 2.5, 'date_transaction' => '2025-01-09 13:45:00'],
            ['id_user' => 5, 'id_crypto' => 5, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 15.0, 'date_transaction' => '2025-01-09 14:00:00'],
            ['id_user' => 6, 'id_crypto' => 6, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 0.8, 'date_transaction' => '2025-01-08 15:10:00'],
            ['id_user' => 7, 'id_crypto' => 7, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 3.2, 'date_transaction' => '2025-01-07 16:20:00'],
            ['id_user' => 8, 'id_crypto' => 8, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 4.0, 'date_transaction' => '2025-01-08 17:30:00'],
            ['id_user' => 9, 'id_crypto' => 9, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 1.5, 'date_transaction' => '2025-01-07 18:40:00'],
            ['id_user' => 10, 'id_crypto' => 10, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 0.6, 'date_transaction' => '2025-01-09 19:50:00'],
            ['id_user' => 1, 'id_crypto' => 2, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 2.0, 'date_transaction' => '2025-01-08 20:05:00'],
            ['id_user' => 2, 'id_crypto' => 3, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 1.2, 'date_transaction' => '2025-01-09 21:15:00'],
            ['id_user' => 3, 'id_crypto' => 4, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 7.0, 'date_transaction' => '2025-01-07 22:25:00'],
            ['id_user' => 4, 'id_crypto' => 5, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 3.0, 'date_transaction' => '2025-01-09 23:35:00'],
            ['id_user' => 5, 'id_crypto' => 6, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 4.5, 'date_transaction' => '2025-01-08 09:45:00'],
            ['id_user' => 6, 'id_crypto' => 7, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 2.8, 'date_transaction' => '2025-01-09 10:55:00'],
            ['id_user' => 7, 'id_crypto' => 8, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 1.1, 'date_transaction' => '2025-01-08 11:05:00'],
            ['id_user' => 8, 'id_crypto' => 9, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 0.9, 'date_transaction' => '2025-01-09 12:15:00'],
            ['id_user' => 9, 'id_crypto' => 10, 'is_sale' => false, 'is_purchase' => true, 'quantity' => 3.3, 'date_transaction' => '2025-01-07 13:25:00'],
            ['id_user' => 10, 'id_crypto' => 1, 'is_sale' => true, 'is_purchase' => false, 'quantity' => 0.7, 'date_transaction' => '2025-01-08 14:35:00']
        ]);
    }
}
