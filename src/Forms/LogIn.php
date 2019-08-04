<?php

namespace Phpblog\Forms;
use Phpblog\Core\Forms\Form;

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
                'label' => ['text' => 'Remember me']
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