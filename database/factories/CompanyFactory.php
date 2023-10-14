<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Admin, Company, Country, Agent};
class CompanyFactory extends Factory {
    protected $model = Company::class;
    public function definition(): array {
        $adminId = $this->faker->boolean(70) ? Admin::pluck('id')->random() : null;
        $agentId = !$adminId ? Agent::pluck('id')->random() : null;
        return [
            'name' => $this->faker->company,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('123123'),
            'admin_id' => $adminId,
            'agent_id' => $agentId,
            'country_id' => Country::all()->random()->id,
        ];
    }
}
