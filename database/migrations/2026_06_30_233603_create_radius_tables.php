<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabel Cek Kredensial (Username & Password PPPoE)
        Schema::create('radcheck', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 64)->default('')->index();
            $table->string('attribute', 64)->default('');
            $table->string('op', 2)->default('==');
            $table->string('value', 253)->default('');
        });

        // 2. Tabel Atribut Balasan (Limitasi Kecepatan Dinamis / Mikrotik-Rate-Limit)
        Schema::create('radreply', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 64)->default('')->index();
            $table->string('attribute', 64)->default('');
            $table->string('op', 2)->default('=');
            $table->string('value', 253)->default('');
        });

        // 3. Tabel Akuntansi / Log Sesi Online Pelanggan (Guna Monitoring Billing)
        Schema::create('radacct', function (Blueprint $table) {
            $table->bigIncrements('radacctid');
            $table->string('acctsessionid', 64)->default('')->index();
            $table->string('acctuniqueid', 32)->default('')->unique();
            $table->string('username', 64)->default('')->index();
            $table->string('groupname', 64)->default('');
            $table->string('realm', 64)->nullable()->default('');
            $table->string('nasipaddress', 15)->default('')->index();
            $table->string('nasportid', 32)->nullable();
            $table->string('nasporttype', 32)->nullable();
            $table->dateTime('acctstarttime')->nullable()->index();
            $table->dateTime('acctupdatetime')->nullable();
            $table->dateTime('acctstoptime')->nullable()->index();
            $table->integer('acctinterval')->nullable();
            $table->unsignedInteger('acctsessiontime')->nullable();
            $table->string('acctauthentic', 32)->nullable();
            $table->string('connectinfo_start', 128)->nullable();
            $table->string('connectinfo_stop', 128)->nullable();
            $table->bigInteger('acctinputoctets')->nullable();
            $table->bigInteger('acctoutputoctets')->nullable();
            $table->string('calledstationid', 50)->default('');
            $table->string('callingstationid', 50)->default('');
            $table->string('acctterminatecause', 32)->default('');
            $table->string('servicetype', 32)->nullable();
            $table->string('frameipaddress', 15)->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radcheck');
        Schema::dropIfExists('radreply');
        Schema::dropIfExists('radacct');
    }
};
