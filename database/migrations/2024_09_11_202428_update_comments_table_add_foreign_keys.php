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
        Schema::table('comments', function (Blueprint $table) {
            // Зміна типу стовпців
            $table->unsignedBigInteger('avtor_id')->change();
            $table->unsignedBigInteger('post_id')->change();

            // Додавання зовнішніх ключів
            $table->foreign('avtor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Видалення зовнішніх ключів
            $table->dropForeign(['avtor_id']);
            $table->dropForeign(['post_id']);
        });
    }
};
