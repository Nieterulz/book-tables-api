<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('code')
                ->unique()
                ->comment('Code identifier of the table');

            $table->unsignedInteger('min_capacity')
                ->comment('Minimum number of diners of the table');

            $table->unsignedInteger('max_capacity')
                ->comment('Maximum number of diners of the table');

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
        Schema::dropIfExists('tables');
    }
}
