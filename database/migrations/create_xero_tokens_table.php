<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('xero_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('access_token');
            $table->string('refresh_token');
            $table->string('id_token')->nullable();
            $table->string('tenant_id');
            $table->string('tenant_name');
            $table->string('tenant_type');
            $table->string('auth_event_id');
            $table->timestamp('expires');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('xero_tokens');
    }
};