<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'celular' => ['required','digits:10','numeric']
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'celular' => $input['celular'],
            'password' => Hash::make($input['password']),
            'socio' => 1,
            'genero' => 0
        ]);
    }
}
