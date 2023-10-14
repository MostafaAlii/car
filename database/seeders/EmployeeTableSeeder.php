<?php
namespace Database\Seeders;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\{DB, Schema};
use Illuminate\Support\Str;
class EmployeeTableSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('employees')->truncate();
        $employee = Employee::create([
            'name'          =>  'Mostafa Alii User',
            'email'         =>  'user@app.com',
            'password'      =>  bcrypt('123123'),
            'status'        =>  'active',
            'phone'         =>  '123456',
            'remember_token' => Str::random(10)
        ]);
        $employee = Employee::create([
            'name'          =>  'Mostafa User',
            'email'         =>  'u@app.com',
            'password'      =>  bcrypt('123123'),
            'status'        =>  'active',
            'remember_token' => Str::random(10)
        ]);
        Employee::factory()->count(10)->create();
        Schema::enableForeignKeyConstraints();
    }
}
