<?php

namespace Phpblog\Controller;

use Phpblog\Core\Request;
use Phpblog\Core\Exception\InvalidDataException;
use Phpblog\Core\Exception\ErrorNotFoundException;
use Phpblog\Core\Forms\FormBuilder;
use Phpblog\Forms\SignUp;
use Phpblog\Forms\LogIn;

class UserController extends BasicController
{
    public function signUpAction()
    {
        $form = new SignUp();
        $formBuilder = new FormBuilder($form);
        if ($this->request->is_post()) {
            try {
                $user = $this->container->get('user');
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
            try {
                $user = $this->container->get('user');
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