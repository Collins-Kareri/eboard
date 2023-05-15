<?php

use App\Enums\UserRole;
use App\Models\Departments;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id');
            $table->index('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job_title');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('employeeID')->default('');
            $table->string('phone_number')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('contract_start_date')->nullable();
            $table->timestamp('contract_end_date')->nullable();
            $table->string('password');
            $table->enum('role', array_column(UserRole::cases(), 'value'));
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
