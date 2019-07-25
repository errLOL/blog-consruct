<?php

namespace c;
use core\DB;
use core\DBDriver;
use core\Validator;
use core\User;
use model\UsersModel;
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
            try {
                $user = new User($mUser);
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
}