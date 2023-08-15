<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {

    public function up(){
        Schema::create('company', function (Blueprint $table) {
            $table->increments('company_id');
            $table->string('company_name', 100);
            $table->string('company_address');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('company');
    }
};
