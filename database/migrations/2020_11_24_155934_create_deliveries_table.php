<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['ACTIVO', 'PROCESADO', 'ENTREGADO',])->default('ACTIVO');
            $table->dateTime('delivery_time', 0);
            $table->longText('description');
            $table->double('amount', 8, 2);
            $table->foreignId('delivery_request_id')->constrained('delivery_requests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
