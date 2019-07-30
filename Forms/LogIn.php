<?php

namespace Forms;
use core\Forms\Form;

class LogIn extends Form
{
    public function __construct() {
        $this->fields = [
            [
                'name' => 'login',
                'type' => 'text',
                'class' => 'form__input',
                'placeholder' => 'Login'
            ],
            [
                'name' => 'password',
                'type' => 'password',
                'class' => 'form__input',
                'placeholder' => 'Password'
            ],
            [
                'name' => 'remember',
                'type' => 'checkbox',
                'value' => 'Запомнить'
            ],
            [
                'type' => 'submit',
                'class' => 'form__submit',
                'value' => 'Войти'
            ]
        ];

        $this->formName = 'logIn';
        $this->method = 'POST';
    }
}