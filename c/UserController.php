<?php

namespace c;
use core\DB;
use core\DBDriver;
use core\Validator;
use core\User;
use core\Response;
use model\UsersModel;
use model\SessionModel;
use core\Exception\InvalidDataException;
use core\Exception\ErrorNotFoundException;

class UserController extends BasicController
{
    public function signUpAction()
    {
        $error = '';
        if ($this->request->is_post()) {
            $name =  $this->request->post('name');
            $surname =  $this->request->post('surname');
            $login =  $this->request->post('login');

            $mUser = new UsersModel(
                new DBDriver(DB::getConnect()),
                new Validator()
            );
            $mSession = new SessionModel(
                new DBDriver(DB::getConnect()),
                new Validator()
            );
            try {
                $user = new User($mUser, $mSession, new Response($_GET, $_POST, $_COOKIE, $_FILES, $_SESSION));
                $user->signUp($this->request->post());
                $this->redirect();
            } catch (InvalidDataException $e) {
                $nameErr = $e->getErrors()['name'] ?? '';
                $surnameErr = $e->getErrors()['surname'] ?? '';
                $loginErr = $e->getErrors()['login'] ?? '';
                $passwordErr = $e->getErrors()['password'] ?? '';
            }
        } else {
            $name = '';
            $surname = '';
            $login = '';
            $nameErr = '';
            $surnameErr = '';
            $loginErr = '';
            $passwordErr = '';
        }
        $this->title = 'Регистрация';
        $this->content = $this->build('v_signup', compact(
            'name', 'surname', 'login', 'nameErr', 'surnameErr', 'loginErr', 'passwordErr'
        ));
    }

    public function logInAction()
    {
        if ($this->request->is_post()) {
            $login =  $this->request->post('login');

            $mUser = new UsersModel(
                new DBDriver(DB::getConnect()),
                new Validator()
            );
            $mSession = new SessionModel(
                new DBDriver(DB::getConnect()),
                new Validator()
            );
            try {
                $user = new User($mUser, $mSession);
                $user->logIn($this->request->post());
                $this->redirect();
            } catch (InvalidDataException $e) {
                $loginErr = $e->getErrors()['login'] ?? '';
                $passwordErr = $e->getErrors()['password'] ?? '';
            }
        } else {
            $login = '';
            $loginErr = '';
            $passwordErr = '';
        }
        $this->title = 'Войти';
        $this->content = $this->build('v_login', compact(
            'login', 'loginErr', 'passwordErr'
        ));
    }
}