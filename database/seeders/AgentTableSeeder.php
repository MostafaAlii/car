<?php
namespace Database\Seeders;
use App\Models\Agent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class AgentTableSeeder extends Seeder {
    public function run(): void {
        Schema::disableForeignKeyConstraints();
        DB::table('agents')->delete();
        Agent::factory()->count(20)->create();
        Schema::enableForeignKeyConstraints();
    }
}
