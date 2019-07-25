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
}
