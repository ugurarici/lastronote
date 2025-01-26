<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('directories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->softDeletes();

            // SQLite için performans optimizasyonu
            $table->index('user_id');
        });

        // notes tablosuna directory_id ekleyelim
        Schema::table('notes', function (Blueprint $table) {
            $table->foreignId('directory_id')->after('user_id')
                  ->constrained()
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeignIdFor('directory_id');
        });

        Schema::dropIfExists('directories');
    }
};