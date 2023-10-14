<?php
namespace Database\Seeders;
use App\Models\Captain;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Support\Str;
class CaptainTableSeeder extends Seeder
{
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('captains')->truncate();
        Captain::factory()->count(10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
