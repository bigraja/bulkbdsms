<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bulk_sms_b_d_logs', function (Blueprint $table) {
            $table->id();
            $table->string('to');
            $table->text('message');
            $table->string('status')->nullable();
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulk_sms_b_d_logs');
    }
};
