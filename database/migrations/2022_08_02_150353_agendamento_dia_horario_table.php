<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_dia_horario', function (Blueprint $table) {
            $table->unsignedBigInteger('schedule_id');
            $table->string('dia',30);
            $table->string('horario',30);
            $table->timestamps();

            $table->foreign('schedule_id')
                    ->references('id')
                    ->on('schedules')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
