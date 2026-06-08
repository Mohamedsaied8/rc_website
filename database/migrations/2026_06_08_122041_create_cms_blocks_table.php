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
        Schema::create('cms_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cms_section_id')->constrained()->cascadeOnDelete();
            $table->string('key');
            $table->longText('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, html, image, url, number, boolean
            $table->string('label')->nullable();
            $table->string('placeholder')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->unique(['cms_section_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_blocks');
    }
};
