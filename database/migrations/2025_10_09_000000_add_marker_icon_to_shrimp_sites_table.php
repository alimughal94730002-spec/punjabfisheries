<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('shrimp_sites', function (Blueprint $table) {
            $table->string('marker_icon')->nullable()->after('images');
        });
    }

    public function down(): void
    {
        Schema::table('shrimp_sites', function (Blueprint $table) {
            $table->dropColumn('marker_icon');
        });
    }
};
