<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('client_name')
                ->comment('Customer name of the booking');

            $table->string('code')
                ->unique()
                ->comment('Code identifier of the booking');

            $table->date('date')
                ->comment('Date of the booking');

            $table->unsignedInteger('persons')
                ->comment('Number of persons of the booking');

            $table->unsignedBigInteger('table_id')
                ->comment('Table related to the booking');

            $table->foreign('table_id')
                ->references('id')
                ->on('tables')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('bookings');
    }
}
