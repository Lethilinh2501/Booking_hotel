<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleRoomTypesTable extends Migration
{
    public function up()
    {
        Schema::create('sale_room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value', 10, 2);
            $table->string('type');
            $table->foreignId('room_type_id')->constrained('room_types');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status', 10)->default('active'); // Hoặc 'inactive'
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_room_types');
    }
}