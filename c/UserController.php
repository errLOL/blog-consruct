<?php

namespace c;
use core\DB;
use core\DBDriver;
use core\Validator;
use core\User;
use core\Request;
use model\UsersModel;
use model\SessionModel;
use core\Exception\InvalidDataException;
use core\Exception\ErrorNotFoundException;
use core\Forms\FormBuilder;
use Forms\SignUp;
use Forms\LogIn;

class UserController extends BasicController
{
    public function signUpAction()
    {
        $form = new SignUp();
        $formBuilder = new FormBuilder($form);
        if ($this->request->is_post()) {
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
                $handled = $form->handleRequest($this->request);
                $user->signUp($handled);
                $this->redirect();
            } catch (InvalidDataException $e) {
                $form->addErrors($e->getErrors());
            }
        }
    
        $this->title = 'Регистрация';
        $this->content = $this->build('v_signup', ['form' => $formBuilder]);
    }

    public function logInAction()
    {
        $form = new LogIn();
        $formBuilder = new FormBuilder($form);
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
                $handled = $form->handleRequest($this->request);
                $user->logIn($handled);
                $this->redirect();
            } catch (InvalidDataException $e) {
                $form->addErrors($e->getErrors());

            }
        }
        $this->title = 'Войти';
        $this->content = $this->build('v_login', ['form' => $formBuilder]);
    }
}