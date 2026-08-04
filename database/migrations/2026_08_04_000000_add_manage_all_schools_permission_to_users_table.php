<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('can_manage_all_schools')->default(false)->after('school_id');
        });

        // Preserve access for legacy platform administrators that were not attached
        // to a school. School-based administrators remain restricted by default.
        DB::table('users')
            ->where('role', 'admin')
            ->whereNull('school_id')
            ->update(['can_manage_all_schools' => true]);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('can_manage_all_schools');
        });
    }
};
