<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['name'=>'Dipesan']);
        Status::create(['name'=>'Menunggu Pembayaran']);
        Status::create(['name'=>'Dibayar']);
        Status::create(['name'=>'Diproses']);
        Status::create(['name'=>'Dikirim']);
        Status::create(['name'=>'Selesai']);
        Status::create(['name'=>'Dibatalkan']);
    }
}
