<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Models\Master;
use App\Consts\ControllerConsts;
use App\Models\WardManager;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //部署の情報を取得
        $departments = Master::where('master_key', ControllerConsts::MASTER_KEY_DEPARTMENT)
                    ->where('item_code', '!=', '000')
                    ->pluck('item_name')
                    ->toArray();
        // SuperAdmin Email
        $superAdminEmail = 'h94051987@gmail.com';

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'telephone' => $this->faker->phoneNumber(),
            'department' => $this->faker->randomElement($departments),
            'employ_id' => $this->faker->numerify('EMP###'),
            'roles' => '001',
            'user_type' => '000',
            'approval_date' => null,
            'approval_user' => null,
            'last_activity_date' => Carbon::createFromTimestamp($this->faker->dateTimeBetween('-1 month', 'now')->getTimestamp())->format('Y-m-d H:i:s'),
            'visit_count' => 0,
            'wards_in_charge' => $this->faker->sentence,
            'current_team_id' => null,
            'profile_photo_path' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }
    // public function wardManager() {
    //     return $this->hasOne(WardManager::class, 'user_id', 'id');
    // }
}
