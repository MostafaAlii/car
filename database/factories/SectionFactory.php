<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Section, Country, Admin, Agent};
class SectionFactory extends Factory {
    protected $model = Section::class;
    public function definition(): array {
        $adminId = $this->faker->boolean(70) ? Admin::pluck('id')->random() : null;
        $agentId = !$adminId ? Agent::pluck('id')->random() : null;
        $countryId = Country::pluck('id')->random();
        return [
            'name' => $this->faker->word,
            'admin_id' => $adminId,
            'agent_id' => $agentId,
            'country_id' => $countryId,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
