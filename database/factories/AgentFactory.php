<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Agent, Country, Admin};
use Illuminate\Support\Facades\DB;

class AgentFactory extends Factory {
    protected $model = Agent::class;
    public function definition(): array {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'admin_id' => Admin::all()->random()->id,
            'country_id' => Country::all()->random()->id,
            'phone' => $this->faker->unique()->phoneNumber(),
            'password' => bcrypt('123123'),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
