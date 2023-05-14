<?php

use App\Enums\InviteStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('department_invitations', function (Blueprint $table) {
            $table->ulid('id');
            $table->string('email')->unique();
            $table->enum('status', array_column(InviteStatus::cases(), 'value'));
            $table->foreignUlid('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_invitations');
    }
};
