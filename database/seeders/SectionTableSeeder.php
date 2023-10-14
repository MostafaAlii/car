<?php
namespace Database\Seeders;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class SectionTableSeeder extends Seeder {
    public function run(): void {
        Schema::disableForeignKeyConstraints();
        DB::table('sections')->delete();
        Section::factory()->count(20)->create();
        Schema::enableForeignKeyConstraints();
    }
}
