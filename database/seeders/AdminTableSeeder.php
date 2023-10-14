<?php
namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Support\Str;
class AdminTableSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
        Admin::create([
            'name'          =>  'Mostafa',
            'email'         =>  'admin@admin.com',
            'password'      =>  bcrypt('123123'),
            'remember_token' => Str::random(10),
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
