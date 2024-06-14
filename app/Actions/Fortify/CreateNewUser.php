<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Ward;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Carbon\Carbon;
use App\Models\WardManager;
use Illuminate\Support\Facades\Auth;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $validated = Validator::make($input, [
            'department' => ['required', 'string', 'max:255'],
            //'ward' => ['required', 'string', 'max:255'],
            'ward' => ['required', 'array'], 
            'ward.*' => ['string', 'max:255'], 
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'department' => $validated['department'],
            'ward' => json_encode($validated['ward']),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'last_activity_date' => Carbon::createFromTimestamp(now()->getTimestamp())->format('Y-m-d H:i:s'),
        ]);

        $creatorId = Auth::id() ?? 0;
        
        foreach ($validated['ward'] as $wardCode) {
            WardManager::create([
                'user_id' => $user->id,
                'ward_code' => $wardCode,
                'creator_id' => $creatorId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return $user;
    }
}
