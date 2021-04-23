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
            $table->string('receipt_no',10);
            $table->date('declared_on')->nullable()->default(now());
            $table->string('declarant_name');
            $table->string('post');
            $table->string('schedule')->nullable();
            $table->string('office_location')->nullable();
            $table->string('address');
            $table->string('contact')->nullable();
            $table->string('witness');
            $table->string('witness_occupation')->nullable();
            $table->string('person_submitting');
            $table->string('person_submitting_contact')->nullable();
            $table->string('qrcode', 25);
            $table->boolean('synced')->default(false);
            $table->foreignId('user_id')->references('id')->on('users');
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
