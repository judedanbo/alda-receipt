<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeclarationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('declarations', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_no', 10);
            $table->date('declared_on')->nullable()->default(now());
            $table->string('declarant_name');
            $table->string('post');
            $table->string('schedule')->nullable();
            $table->string('office_location')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->string('witness')->nullable();
            $table->string('witness_occupation')->nullable();
            $table->string('person_submitting')->nullable();
            $table->string('person_submitting_contact')->nullable();
            $table->string('qrcode', 25)->nullable();
            $table->boolean('synced')->default(false);
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('office_id')->nullable()->constrained();
            $table->string('old_received_by', 100)->nullable();
            $table->string('old_serial_no', 12)->nullable();
            $table->unsignedInteger('old_declaration_id')->nullable();
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
        Schema::dropIfExists('declarations');
    }
}