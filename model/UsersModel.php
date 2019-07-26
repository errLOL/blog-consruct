<?php

namespace model;
use core\DBDriver;
use core\Validator;
use core\Exception\InvalidDataException;

class UsersModel extends BasicModel
{
    protected $schema = [
        'id_user' => [
            'primary' => true,
            'type' => 'integer'
        ],

        'name' => [
            'require' => true,
            'type' => 'string',
            'not_blank' => true,
            'length' => 32
        ],

        'surname' => [
            'require' => true,
            'type' => 'string',
            'not_blank' => true,
            'length' => 64
        ],

        'login' => [
            'require' => true,
            'type' => 'string',
            'not_blank' => true,
            'length' => 32
        ],

        'password' => [
            'require' => true,
            'type' => 'string',
            'not_blank' => true,
            'length' => [8,32]
        ]
    ];

    public function __construct(DBDriver $dbdriver, Validator $validator)
    {
        parent::__construct($dbdriver, 'пользователи', $validator);
        $this->validator->setRules($this->schema);
        
    }

    public function signUp(array $field)
    {
        $this->validator->execute($field);
        if($this->getByLogin($field['login'])) {
            $this->validator->success = false;
            $this->validator->errors['login'][] = sprintf('Username %s is already taken.', $field['login']);
        }
        if(!$this->validator->success) {
            throw new InvalidDataException($this->validator->errors);
        }else {
            $field['password'] = password_hash($field['password'], PASSWORD_ARGON2I);
            return $this->add($field, false);
        }
    }

    public function getByLogin($login)
    {
        return $this->getOnce(['login' => $login]);
    }

}