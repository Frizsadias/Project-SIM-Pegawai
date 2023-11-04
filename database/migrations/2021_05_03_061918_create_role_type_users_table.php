<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRoleTypeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_type_users', function (Blueprint $table) {
            $table->id();
            $table->string('role_type')->nullable();
            $table->timestamps();
        });

        DB::table('role_type_users')->insert([
            ['role_type' => 'Admin'],
            ['role_type' => 'Super Admin'],
            ['role_type' => 'User'],
            ['role_type' => 'Kepala Ruang IGD Terpadu'],
            ['role_type' => 'Kepala Ruang Bedah Central'],
            ['role_type' => 'Kepala Ruang RR'],
            ['role_type' => 'Kepala Ruang Rawat Jalan'],
            ['role_type' => 'Kepala Ruang Hemodialisis (HD)'],
            ['role_type' => 'Kepala Ruang Kebidanan'],
            ['role_type' => 'Kepala Ruang Pinang'],
            ['role_type' => 'Kepala Ruang Perinatologi'],
            ['role_type' => 'Kepala Ruang Cemara'],
            ['role_type' => 'Kepala Ruang HCU Bougenvill'],
            ['role_type' => 'Kepala Ruang ICU'],
            ['role_type' => 'Kepala Ruang ICCU'],
            ['role_type' => 'Kepala Ruang Asoka'],
            ['role_type' => 'Kepala Ruang Pinus'],
            ['role_type' => 'Kepala Ruang Wijiaya Kusuma'],
            ['role_type' => 'Kepala Ruang Paviliun'],
            ['role_type' => 'Kepala Ruang Palem/PICU'],
            ['role_type' => 'Kepala Ruang Unit Stroke'],
            ['role_type' => 'Kepala Ruang Bidara/Ranap Jiwa'],
            ['role_type' => 'Kepala Ruang Lain-Lain/Non Perawatan'],
            ['role_type' => 'Kepala Ruang Pavilium Anggrek'],
            ['role_type' => 'Kepala Ruang Mawar'],
            ['role_type' => 'Kepala Ruang Flamboyan'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_type_users');
    }
}
