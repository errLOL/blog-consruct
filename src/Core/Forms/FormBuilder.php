<?php

namespace Phpblog\Core\Forms;

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
        $label = null;

        if (isset($attr['errors'])) {
            $class = $attr['class'] ?? '';
            $attr['class'] = sprintf('%s error', $class);
            $errors = '<div class="error_message">' . implode('</div><div class="error_message">', $attr['errors']) . '</div>';
            unset($attr['errors']); 
        }

        if (isset($attr['label'])) {
            $label = $attr['label'];
            unset($attr['label']);
        }
        
        if (isset($attr['type']) && $attr['type'] === 'textarea') {
            $value = $attr['value'] ?? '';
            unset($attr['value']);
            $input = sprintf('<textarea %s>%s</textarea>%s', $this->buildAttributes($attr), $value, $errors);
        }else {
            $input = sprintf('<input %s>%s', $this->buildAttributes($attr), $errors);
        }
    
        if ($label) {
            $input = sprintf('<label %s>%s %s</label>', $this->buildAttributes($label), $input, $label['text']);
        }

        return $input;
    }

    public function buildAttributes(array $attr)
    {
        $arr = [];
        foreach ($attr as $attribute => $value) {
            if($attribute === 'text') {
                continue;
            }
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