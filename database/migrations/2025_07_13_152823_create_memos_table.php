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
        Schema::create('memos', function (Blueprint $table) {
            $table->id();//メモID
            $table->string('title');//メモタイトル
            $table->text('content');//メモの本文
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//ユーザーと紐付け
            $table->timestamps();//created_at,updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memos');
    }
};
