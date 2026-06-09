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
        Schema::table('questions', function (Blueprint $table) {
            $table->string('option_a')->nullable()->after('question_text');
            $table->string('option_b')->nullable()->after('option_a');
            $table->string('option_c')->nullable()->after('option_b');
            $table->string('option_d')->nullable()->after('option_c');
            $table->string('correct_answer')->nullable()->after('correct_option');
            $table->string('question_type')->default('multiple_choice')->after('correct_answer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['option_a', 'option_b', 'option_c', 'option_d', 'correct_answer', 'question_type']);
        });
    }
};
