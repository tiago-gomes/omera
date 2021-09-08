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
            $table->string('first_name', 75);
            $table->string('last_name', 75);
            $table->string('email', 125)->unique();
            $table->string('phone', 12);
            $table->string('lead_source', 254);
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
