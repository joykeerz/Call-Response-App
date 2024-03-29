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
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Dwi',
            'email' => 'dwinanda@yaksaharmoni.com',
            'password' => Hash::make('yaksa123'),
        ]);
        DB::table('users')->insert([
            'name' => 'aryo',
            'email' => 'aryo@yaksaharmoni.com',
            'password' => Hash::make('aryo123'),
        ]);
        DB::table('sps')->insert([
            'sp_company_name' => 'none',
            'sp_company_address' => 'none',
            'sp_pic_name' => 'none',
            'sp_contact_number' => 'none',
            'sp_email' => 'none',
            'sp_bank_name' => 'none'
        ]);
        DB::table('sps')->insert([
            'sp_company_name' => 'dummy sp',
            'sp_company_address' => 'dummy sp address',
            'sp_pic_name' => 'dummy sp pic name',
            'sp_contact_number' => 'dummy sp contact',
            'sp_email' => 'dummy sp email',
            'sp_bank_name' => 'dummy sp bank name'
        ]);
        DB::table('bps')->insert([
            'bp_company_name' => 'none',
            'bp_company_address' => 'none',
            'bp_pic_name' => 'none',
            'bp_contact_number' => 'none',
            'bp_email' => 'none',
            'bp_bank_name' => 'none',
        ]);
        DB::table('bps')->insert([
            'bp_company_name' => 'dummy bp',
            'bp_company_address' => 'dummy bp address',
            'bp_pic_name' => 'dummy bp pic name',
            'bp_contact_number' => 'dummy bp contact',
            'bp_email' => 'dummy bp email',
            'bp_bank_name' => 'dummy bp bank name'
        ]);
        DB::table('spareparts')->insert([
            'part_number' => 'dummy part number',
            'part_serial' => 'dummy serial number',
            'part_name' => 'dummy part name',
            'part_condition' => 'new',
            'part_module' => 'module 1',
            'part_qty' => 1,
            'product_detail_id' => 1,
            'part_date_of_entry' => now(),
        ]);
        DB::table('clients')->insert([
            'product_detail_id' => 1,
            'customer_service_engineer_id' => 1,
            'client_machine_id' => 1,
            'client_customer_name' => 'dummy client',
            'client_machine_status' => 'new installation',
            'client_pic_name' => 'dummy pic name',
            'client_pic_hp' => '0211231231',
            'client_site_location_name' => 'dummy site loc.',
            'client_site_location_address' => 'dummy address',
            'client_activation_date' => now(),
            'client_operation_hours' => '24 hours',
            'client_warranty_year' => '1 year',

        ]);
        DB::table('product_details')->insert([
            'product_name' => 'dummy product',
            'brand_name' => 'dummy brand',
            'type_series' => 'dummy type',
            'serial_number' => 'dummy serial',
            'date_of_entry' => now(),
        ]);
        DB::table('product_details')->insert([
            'product_name' => 'dummy product 2',
            'brand_name' => 'dummy brand 2',
            'type_series' => 'dummy type 2',
            'serial_number' => 'dummy serial 2',
            'date_of_entry' => now(),
        ]);
        DB::table('customer_service_engineers')->insert([
            'sp_id' => 1,
            'nama_cse' => 'none',
            'initial_cse' => 'none',
            'area_cse' => 'none',
            'hp_cse' => 'none',
            'leader_cse' => 'none',
        ]);
        DB::table('customer_service_engineers')->insert([
            'sp_id' => 2,
            'nama_cse' => 'cse 1',
            'initial_cse' => 'mr.cse',
            'area_cse' => 'jkt',
            'hp_cse' => '12413543346',
            'leader_cse' => 'mr.cse',
        ]);
    }
}
