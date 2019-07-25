<?php

namespace core;
use model\UsersModel;

class User
{
    private $mUser;

    public function __construct(UsersModel $mUser) {
        $this->mUser = $mUser;
    }

    public function signUp(array $fields)
    {
        $this->mUser->signUp($fields);
    }

    public function logIn(array $fields)
    {
        $user = $this->mUser->getOnce(['login' => $fields['login']];
        if ($user) {
           throw new InvalidDataException(['login'] => 'User not found');
        } elseif (!password_verify($fields['password'], $user['password'] )) {
            throw new InvalidDataException(['password'] => 'Incorrect password');
        }

    }
}
