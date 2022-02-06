<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_types', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('short', 60);
            $table->string('unit', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100);
            $table->string('ip_address', 100);
            $table->text('value');
            $table->text('link');
            $table->bigInteger('event_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_type_id')
                ->references('id')->on('event_types')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_types');
        Schema::dropIfExists('events');
    }
}
