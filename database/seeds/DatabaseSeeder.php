<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
        ]);
        DB::table('sps')->insert([
            'sp_company_name' => 'dummy sp',
            'sp_company_address' => 'dummy sp address',
            'sp_pic_name' => 'dummy sp pic name',
            'sp_contact_number' => 'dummy sp contact'
        ]);
        DB::table('sps')->insert([
            'sp_company_name' => 'none',
            'sp_company_address' => 'none',
            'sp_pic_name' => 'none',
            'sp_contact_number' => 'none'
        ]);
        DB::table('bps')->insert([
            'bp_company_name' => 'dummy bp',
            'bp_company_address' => 'dummy bp address',
            'bp_pic_name' => 'dummy bp pic name',
            'bp_contact_number' => 'dummy bp contact'
        ]);
        DB::table('bps')->insert([
            'bp_company_name' => 'none',
            'bp_company_address' => 'none',
            'bp_pic_name' => 'none',
            'bp_contact_number' => 'none'
        ]);
        DB::table('spareparts')->insert([
            'part_number' => 'dummy part number',
            'part_serial' => 'dummy serial number',
            'part_name' => 'dummy part name',
            'part_date_of_entry' => now(),
            'part_out_date' => now(),
            'part_condition' => 'new',
        ]);
        DB::table('clients')->insert([
            'client_customer_name' => 'dummy client',
            'client_site_location_name' => 'dummy site loc.',
            'client_site_location_address' => 'dummy address',
        ]);
        DB::table('product_details')->insert([
            'product_name' => 'dummy product',
            'brand_name' => 'dummy brand',
            'type_series' => 'dummy type',
            'serial_number' => 'dummy serial',
            'id_number' => 'dummy id',
            'date_of_entry' => now(),
            'activation_date' => now(),
        ]);
    }
}
