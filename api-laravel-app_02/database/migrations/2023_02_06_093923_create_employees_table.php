<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {

    public function up(){
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('employee_phone');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('employees');
    }
};
