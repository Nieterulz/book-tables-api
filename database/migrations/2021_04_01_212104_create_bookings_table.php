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

            $table->string('code')
                ->unique()
                ->comment('Code identifier of the book');

            $table->date('date')
                ->comment('Date of the book');

            $table->unsignedInteger('persons')
                ->comment('Number of diners of the book');

            $table->unsignedBigInteger('table_id')
                ->comment('Table related to the book');

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
