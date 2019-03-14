<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRingfortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ringforts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entity_id')->nullable();
            $table->string('classcode')->nullable();
            $table->string('classdesc')->nullable();
            $table->string('smrs')->nullable();
            $table->string('tland_names')->nullable();
            $table->decimal('org_lat', 10, 7)->nullable();
            $table->decimal('org_long', 10, 7)->nullable();
            $table->decimal('new_lat', 10, 7)->nullable();
            $table->decimal('new_long', 10, 7)->nullable();
            $table->string('link')->nullable();
            $table->integer('status')->default(0);
            $table->integer('priority')->default(0);
            $table->timestamp('posted')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ringforts');
    }
}
