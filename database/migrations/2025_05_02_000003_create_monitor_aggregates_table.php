<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('monitor_aggregates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('bucket')->index();
            $table->unsignedMediumInteger('period')->index();
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
            $table->string('aggregate');
            $table->decimal('value', 20, 2);
            $table->unsignedInteger('count')->nullable();
            $table->unique(['bucket', 'period', 'type', 'aggregate', 'key_hash']);
            $table->index(['period', 'type', 'aggregate', 'bucket']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitor_aggregates');
    }
};
