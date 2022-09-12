<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender="";
        $picturePath = "";

        if(rand()%2 == 0)
        {
            $gender = 'man';
            $picturePath = "./resources/pictures/maleIcone.png";
        }
        else
        {
            $gender = 'woman';
            $picturePath = "./resources/pictures/femaleIcone.png";
        }
        
        $age = rand()%22 + 13;
        $birthyear = 2022 - $age;
        $birthmonth = rand()%12 + 1;
        $birthday = rand()%28 + 1;
        $birthhour = rand()%24;
        $birthminute = rand()%60;
        $birthseconde = rand()%60;
        
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => password_hash('1234', PASSWORD_BCRYPT),
            'remember_token' => Str::random(10),
            'is_admin' => 0,
            'location' => 'Marseille',
            'gender' => $gender,
            'birthdate' => $birthyear . '/' . $birthmonth . '/' . $birthday . " " . $birthhour . ":" . $birthminute . ":" . $birthseconde,
            'picture' => file_get_contents($picturePath)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
