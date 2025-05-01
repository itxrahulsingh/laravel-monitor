<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('monitor_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('timestamp')->index();
            $table->string('type')->index();
            $table->mediumText('key');
            $driver = DB::getDriverName();
            if ($driver === 'mysql' || $driver === 'mariadb') {
                $table->char('key_hash', 16)->charset('binary')->virtualAs('unhex(md5(`key`))')->index();
            } elseif ($driver === 'pgsql') {
                $table->uuid('key_hash')->storedAs('md5("key")::uuid')->index();
            } else {
                $table->string('key_hash')->index();
            }
            $table->bigInteger('value')->nullable();
            $table->index(['timestamp', 'type', 'key_hash', 'value']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitor_entries');
    }
};
