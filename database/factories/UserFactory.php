<?php

namespace Database\Factories;

use App\Enum\Can;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withPermission(Can $key): static
    {
        return $this->afterCreating(function (Model $user) use ($key) {
            /** @var User $user */
            $user->givePermissionTo($key);
        });
    }

    public function withValidationCode(): static
    {
        return $this->state(fn () => [
            'email_verified_at' => null,
            'validation_code'   => random_int(100000, 999999),
        ]);
    }

    public function admin(): static
    {
        return $this->afterCreating(function (Model $user) {
            /** @var User $user */
            $user->givePermissionTo(Can::BE_AN_ADMIN);
        });
    }

    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => now(),
            'deleted_by' => User::factory()->admin(),
        ]);
    }
}
