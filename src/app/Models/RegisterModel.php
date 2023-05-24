<?php

namespace App\Models;

use App\DbModel;
use App\Model;

class RegisterModel extends DbModel
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $confirm_password = '';


    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save() ? "Success" : "Error";
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

    public function attributes(): array
    {
        return ['name', 'email', 'password'];
    }

    public function tableName(): string
    {
        return 'users';
    }
}