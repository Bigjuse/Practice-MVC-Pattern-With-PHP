<?php

namespace App\Models;

use App\Model;

class RegisterModel extends Model
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $confirm_password = '';


    public function register()
    {
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 8], [self::RULE_MIN, 'min' => 4]],
            'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}
