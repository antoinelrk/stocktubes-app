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
        Schema::create('semi_conductors', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 255)
                ->unique();
            $table->string('slug', 255)
                ->unique();
            $table->bigInteger('user_id')
                ->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('used')
                ->default(0);
            $table->integer('unused')
                ->default(0);
            $table->integer('warning')
                ->default(0);
            $table->integer('critical')
                ->default(0);
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
        Schema::dropIfExists('semi_conductors');
    }
};
