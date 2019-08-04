<?php

namespace Phpblog\Forms;
use Phpblog\Core\Forms\Form;

class AddNews extends Form
{
    public function __construct() {
        $this->fields = [
            [
                'name' => 'title',
                'type' => 'text',
                'class' => 'form__input',
                'placeholder' => 'Title of article'
            ],
            [
                'name' => 'text',
                'type' => 'textarea',
                'class' => 'form__textarea',
                'placeholder' => 'Article\'s text'
            ],
            [
                'type' => 'submit',
                'class' => 'form__submit',
                'value' => 'Add'
            ]
        ];

        $this->formName = 'addNews';
        $this->method = 'POST';
    }
}