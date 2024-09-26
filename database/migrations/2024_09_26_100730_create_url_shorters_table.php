<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('url_shorters', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('admin_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->text('main_url');
            $table->string('short_url');
            $table->integer('hit')->default(1);
            $table->integer('status')->default(1);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_shorters');
    }
};
