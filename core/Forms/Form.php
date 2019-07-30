<?php

namespace core\Forms;
use core\Exception\InvalidDataException;
use core\Request;

abstract class Form
{
    protected $fields;
    protected $method;
    protected $action;
    protected $formName;

    public function getMethod()
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getFields()
    {
        return new \arrayIterator($this->fields);
    }

    public function getName()
    {
        return $this->formName;
    }
    
    public function getSign()
    {
        $str = '';
        foreach ($this->getFields() as $field) {
            if(isset($field['name'])) {
                $str .= '@(~p)@22$&^' . $field['name'];
            }
        }
        return hash('ripemd160', $str);
    }

    public function handleRequest(Request $request)
    {
        $fields = [];
        if ($request->post('sign') !== $this->getSign()) {
            throw new InvalidDataException(['sing' => ['not found form']]);
        }

        foreach ($this->getFields() as $field) {
            if (!isset($field['name'])) {
                continue;
            }
            if ($request->post($field['name']) !== null) {
                $fields[$field['name']] = $request->post($field['name']);
            }
        }

        return $fields;
    }

    public function addErrors(array $errors)
    {
        foreach ($this->fields as $key => $field) {
            $name = $field['name'] ?? null;
            if (isset($errors[$name])) {
                $this->fields[$key]['errors'] = $errors[$name];
            }
        }
    }
}