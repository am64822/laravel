<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownlreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downlreqs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name', 255);
            $table->string('phone', 32);
            $table->string('email', 64);
            $table->text('content');
            $table->enum('status', ['new', 'inprg', 'decl', 'closed'])->default('new');
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('downlreqs');
    }
}
