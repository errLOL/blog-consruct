<?php

namespace Forms;
use core\Forms\Form;

class SignUp extends Form
{
    public function __construct() {
        $this->fields = [
            [
                'name' => 'name',
                'type' => 'text',
                'class' => 'form__input',
                'placeholder' => 'Name'
            ],
            [
                'name' => 'surname',
                'type' => 'text',
                'class' => 'form__input',
                'placeholder' => 'Surname'
            ],
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
                'type' => 'submit',
                'class' => 'form__submit',
                'value' => 'Зарегистрироваться'
            ]
        ];

        $this->formName = 'signUp';
        $this->method = 'POST';
    }
}