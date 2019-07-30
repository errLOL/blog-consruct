<?php

namespace core\Forms;

class FormBuilder
{
    public function __construct(Form $form) {
        $this->form = $form;
    }

    public function method()
    {
        $method = $this->form->getMethod();

        if ($method === null) {
            $method = 'GET';
        }
        return sprintf('method="%s"', $method);
    }

    public function fields()
    {
        $inputs = [];
        foreach ($this->form->getFields() as $field) {
            $inputs[] = $this->input($field); 
        }
        
        return $inputs;
    }

    public function input(array $attr)
    {
        $errors = '';

        if (isset($attr['errors'])) {
            $class = $attr['class'] ?? '';
            $attr['class'] = sprintf('%s error', $class);
            $errors = '<div class="error_message">' . implode('</div><div class="error_message">', $attr['errors']) . '</div>';
            unset($attr['errors']);
            
        }
        $input = sprintf('<input %s>%s', $this->buildAttributes($attr), $errors);
        return $input;
    }

    public function buildAttributes(array $attr)
    {
        $arr = [];
        foreach ($attr as $attribute => $value) {
            $arr[] = sprintf('%s = "%s"', $attribute, $value);
        }
        
        return implode(' ', $arr);
    }

    public function inputSign()
    {
        return $this->input([
            'name' => 'sign',
            'type' => 'hidden',
            'value' => $this->form->getSign()
        ]);
    }
}