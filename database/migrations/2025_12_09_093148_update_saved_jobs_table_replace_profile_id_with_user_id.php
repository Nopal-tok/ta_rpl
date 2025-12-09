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
        Schema::table('saved_jobs', function (Blueprint $table) {
            try {
                $table->dropForeign('saved_jobs_profile_id_foreign');
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
            try {
                $table->dropColumn('profile_id');
            } catch (\Exception $e) {
                // Column might not exist
            }
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saved_jobs', function (Blueprint $table) {
            try {
                $table->dropForeign('saved_jobs_user_id_foreign');
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
            try {
                $table->dropColumn('user_id');
            } catch (\Exception $e) {
                // Column might not exist
            }
            $table->foreignId('profile_id')->nullable()->constrained('profiles')->onDelete('cascade');
        });
    }
};
