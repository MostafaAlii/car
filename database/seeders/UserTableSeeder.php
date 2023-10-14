<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Support\Str;
class UserTableSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        $user = User::create([
            'name'          =>  'Mostafa Alii User',
            'email'         =>  'user@app.com',
            'password'      =>  bcrypt('123123'),
            'status'        =>  'active',
            'phone'         =>  '123456',
            'remember_token' => Str::random(10),
            'country_id'    =>  65,
        ]);
        $user = User::create([
            'name'          =>  'Mostafa User',
            'email'         =>  'u@app.com',
            'password'      =>  bcrypt('123123'),
            'status'        =>  'active',
            'remember_token' => Str::random(10),
            'country_id'    =>  65,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
