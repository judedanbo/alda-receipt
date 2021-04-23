<?php

namespace Database\Factories;

use App\Models\Declaration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DeclarationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Declaration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'receipt_no' => Str::random(8),
            'declared_on' => $this->faker->date('Y-m-d', 'now') ,
            'declarant_name' => $this->faker->name ,
            'post' => $this->faker->jobTitle ,
            'schedule' => $this->faker->jobTitle ,
            'office_location' => $this->faker->city ,
            'address' => $this->faker->address ,
            'contact' => $this->faker->phoneNumber ,
            'witness' => $this->faker->name ,
            'witness_occupation' => $this->faker-> jobTitle,
            'person_submitting' => $this->faker->name ,
            'person_submitting_contact' => $this->faker->phoneNumber ,
            'user_id' => 1 ,
            'qrcode' =>  Str::random(15),
        ];
    }
}
