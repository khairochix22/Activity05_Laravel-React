<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('posts', 'message')) {
            Schema::table('posts', function (Blueprint $table): void {
                $table->text('message')->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('posts', 'message')) {
            Schema::table('posts', function (Blueprint $table): void {
                $table->dropColumn('message');
            });
        }
    }
};
