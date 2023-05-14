<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //description.
        //date.
        //status. it an enum.
        //start time.
        //end time
        Schema::create('tasks', function (Blueprint $table) {
            $table->ulid('id');
            $table->text('description');
            $table->date('deadline');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['completed', 'pending']);
            $table->foreignUlid('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
