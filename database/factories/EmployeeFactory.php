<?php
namespace Database\Factories;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'company_id' => Company::inRandomOrder()->first()->id,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}


