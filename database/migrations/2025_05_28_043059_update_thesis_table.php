<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('thesis', function (Blueprint $table) {
            $table->text('abstract')->after('year');
            $table->string('source_code_path')->after('abstract')->nullable();
            $table->string('source_code_name')->after('source_code_path')->nullable();
            $table->string('file_data_source_path')->after('source_code_name')->nullable();
            $table->string('file_data_source_name')->after('file_data_source_path')->nullable();
            $table->text('link_data_source')->after('file_data_source_name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('thesis', function (Blueprint $table) {
            $table->dropColumn(['abstract', 'source_code_path', 'source_code_name', 'file_data_source_path', 'file_data_source_name', 'link_data_source']);
        });
    }
};