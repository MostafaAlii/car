<?php
namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Admin, Company, Country, Agent, Employee, Captain};
class CaptainFactory extends Factory {
    public function definition(): array {
        $adminId = $this->faker->boolean(70) ? Admin::pluck('id')->random() : null;
        $agentId =  Agent::pluck('id')->random();
        $companyId = Company::pluck('id')->random();
        $employeeId =  Employee::pluck('id')->random() ;
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'gender' => fake()->randomElement(['male', 'female']),
            'password' => bcrypt('123123'), // password
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'country_id' => Country::all()->random()->id,
            'admin_id' => $adminId,
            'agent_id' => $agentId,
            'company_id' => $companyId,
            'employee_id' => $employeeId,
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}