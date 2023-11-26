<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(
            'notes',
            function (Blueprint $table) {
                $table->id();
                $table->text('content');
                $table->unsignedInteger('parent_id')->nullable();
                $table->unsignedInteger('previous_id')->nullable();
                $table->unsignedInteger('next_id')->nullable();
                $table->unsignedInteger('user_id')->nullable();
                $table->boolean('pinned')->default(false);
                $table->enum('todo_status', ['pending', 'in_progress', 'completed'])->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
