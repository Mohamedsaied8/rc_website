<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->enum('type', ['blog', 'news', 'paper'])->default('blog')->after('slug');
            $table->foreignId('user_id')->nullable()->after('author')->constrained()->nullOnDelete();
            $table->boolean('featured')->default(false)->after('status');
            $table->json('tags')->nullable()->after('featured');
            $table->unsignedInteger('views')->default(0)->after('tags');
            $table->text('rejection_reason')->nullable()->after('views');

            // Published-paper metadata. Every field is optional: an admin can publish a paper
            // with nothing but a title and still get the highlighted treatment.
            $table->string('paper_authors')->nullable();
            $table->text('paper_abstract')->nullable();
            $table->string('paper_venue')->nullable();
            $table->smallInteger('paper_year')->nullable();
            $table->string('paper_doi')->nullable();
            $table->string('paper_url')->nullable();
            $table->string('paper_pdf')->nullable();
            $table->string('paper_code_url')->nullable();
            $table->text('paper_bibtex')->nullable();

            $table->index('type');
            $table->index(['type', 'status']);
        });

        // Widen the status enum for the user-submission flow. Raw ALTER because doctrine/dbal
        // isn't installed and Laravel can't modify an enum without it.
        DB::statement("ALTER TABLE blog_posts MODIFY status ENUM('draft','pending','published','rejected') NOT NULL DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE blog_posts SET status = 'draft' WHERE status IN ('pending','rejected')");
        DB::statement("ALTER TABLE blog_posts MODIFY status ENUM('draft','published') NOT NULL DEFAULT 'draft'");

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['type', 'status']);
            $table->dropIndex(['type']);
            $table->dropColumn([
                'type', 'user_id', 'featured', 'tags', 'views', 'rejection_reason',
                'paper_authors', 'paper_abstract', 'paper_venue', 'paper_year',
                'paper_doi', 'paper_url', 'paper_pdf', 'paper_code_url', 'paper_bibtex',
            ]);
        });
    }
};
