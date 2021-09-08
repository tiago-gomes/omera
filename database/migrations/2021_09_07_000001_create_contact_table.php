<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 75)->nullable();
            $table->string('last_name', 75)->nullable();
            $table->string('email', 125)->unique()->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('lead_source', 254)->nullable();
            $table->string('salesforce_external_id', 254)->unique()->nullable();
            $table->timestamps();
            
            $table->unique(['email', 'salesforce_external_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
