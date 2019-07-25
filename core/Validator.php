<?php

namespace core;
use core\Exception\ValidatorException;

class Validator
{
    private $rules;
    public $success = false;
    public $errors = [];
    public $clean = [];

    public function execute(array $fields)
    {
        
        if(!$this->rules) {
            throw new ValidatorException('Rules for validation not given');
        }
        foreach ($this->rules as $key => $rule) {

            if(!isset($fields[$key]) && (isset($rule['require']) && $rule['require'])){
                $this->errors[$key][] = sprintf('Field %s is not filled', $key);
            }

            if(!isset($fields[$key]) && !(isset($rule['require']) && !$rule['require'])) {
                continue;
            }

            $fields[$key] = htmlspecialchars(trim($fields[$key]));

            if(isset($rule['not_blank']) && $rule['not_blank']) {
                if($fields[$key] === '') {
                    $this->errors[$key][] = sprintf('Field %s is not filled', $key);
                }
            }

            if(isset($rule['type'])) {
                switch ($rule['type']) {
                    case 'string':
                        if(!is_string($fields[$key])) {
                            $this->errors[$key][] = sprintf('Field %s must be string', $key);
                        }
                        break;
                    case 'integer':
                       if(!ctype_digit($fields[$key])) {
                            $this->errors[$key][] = sprintf('Field %s must be integer', $key);
                        }
                        break;
                    case 'bool':
                       if(!is_bool($fields[$key])) {
                            $this->errors[$key][] = sprintf('Field %s must be boolean', $key);
                        }
                        break;
                    default:
                        throw new ValidatorException('Type in rules for validation not given');
                        break;
                }
            }

            if(isset($rule['length'])) {
                $length = iconv_strlen($fields[$key]);

                if(is_numeric($rule['length'])) {
                    if ($length > $rule['length']) {
                        $this->errors[$key][] = sprintf('Field %s must be at least %s characters', $key, $rule['length']);
                    } 
                }
                elseif (is_array($rule['length'])) {
                    $min = $rule['length'][0];
                    $max = $rule['length'][1];
                    if (!($min < $length && $max > $length)) {
                        $this->errors[$key][] = sprintf(
                            'Field %s must be at least %s and no more than %s characters',
                            $key,
                            $min,
                            $max
                        );
                    }
                }
                else {
                    throw new ValidatorException('Incorrect rule length for validation');
                }
            }

            if (empty($this->errors[$key])) {
                $this->clean[] = $key;
            }
        }
        if (empty($this->errors)) {
            $this->success = true;
        }
    }

    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }
}