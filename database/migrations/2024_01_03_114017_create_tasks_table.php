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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('user_id')->constrained();
            $table->date('due_date');
            $table->string('status');
            $table->string('priority');

            // created parts
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('created_at')->useCurrent();

            // updated parts
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamp('updated_at')->useCurrent();

            // completed parts
            $table->foreignId('completed_by')->constrained('users');
            $table->timestamp('completed_at')->useCurrent();

            // assigned parts
            $table->foreignId('assigned_by')->constrained('users');
            $table->timestamp('assigned_at')->useCurrent();
            $table->foreignId('assigned_to')->constrained('users');
            $table->timestamp('assigned_to_at')->useCurrent();

            // Additional Columns
            $table->text('comments')->nullable(); // Comments or additional details
            $table->text('attachments')->nullable(); // File paths or attachment details
            $table->string('tags')->nullable(); // Tags or categories
            $table->foreignId('parent_task_id')->nullable()->constrained('tasks'); // Parent task for subtasks
            $table->text('dependencies')->nullable(); // Task dependencies (e.g., list of task IDs)
            $table->text('notifications')->nullable(); // Notification details

            $table->softDeletes();
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
