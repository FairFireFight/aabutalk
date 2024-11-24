<?php

use App\Models\Board;
use App\Models\ForumPost;
use App\Models\User;
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
        Schema::create('board_posts', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Board::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ForumPost::class)->constrained()->nullOnDelete();

            $table->string('title');
            $table->string('content');
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('board_posts');
    }
};
