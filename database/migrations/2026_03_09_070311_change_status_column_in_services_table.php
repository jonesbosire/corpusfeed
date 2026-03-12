<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE services MODIFY status VARCHAR(20) NOT NULL DEFAULT 'active'");
        DB::statement("UPDATE services SET status = CASE WHEN status = '1' THEN 'active' ELSE 'inactive' END WHERE status IN ('0','1')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE services MODIFY status TINYINT(1) NOT NULL DEFAULT 1");
    }
};
