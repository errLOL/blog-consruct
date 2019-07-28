<?php

namespace core;
use model\UsersModel;
use model\SessionModel;
use core\Session;
use core\Cookie;
use core\Request;
use core\Exception\InvalidDataException;

class User
{
    private $mUser;
    private $mSession;

    public function __construct(UsersModel $mUser, SessionModel $mSession) {
        $this->mUser = $mUser;
        $this->mSession = $mSession;
    }

    public function signUp(array $fields)
    {
        $this->mUser->signUp($fields);
    }

    public function logIn(array $fields)
    {
        $user = $this->mUser->getByLogin($fields['login']);
        if (!$user) {
           throw new InvalidDataException(['login' => 'User not found']);
        } elseif (!password_verify($fields['password'], $user['password'])) {
            throw new InvalidDataException(['password' => 'Incorrect password']);
        }
        $uniqueNumber = uniqid();
        Session::setSession('sid', $uniqueNumber);
        $this->mSession->setSession($user['id_user'], $uniqueNumber);

        if ($fields['remember'] ?? false) {
            Cookie::setCookie('login', $fields['login']);
            Cookie::setCookie('password', $fields['password']);
        }

        return true;
    }

    public function isAuth(Request $request)
    {
        if($request->session('sid') && $this->sessionModel->getBySid($request->session('sid'))) {
            return true;
        } elseif ($request->cookie('remember')) {
            return true;
        }
    }
}
