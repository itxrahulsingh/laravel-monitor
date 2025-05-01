<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('monitor_performance_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('metric_name')->index();
            $table->decimal('value', 10, 2);
            $table->json('context')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitor_performance_metrics');
    }
};
