<?php

namespace model;

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
            'length' => 32
        ],

        'surname' => [
            'require' => true,
            'type' => 'string',
            'length' => 64
        ],

        'login' => [
            'require' => true,
            'type' => 'string',
            'unique' => true,
            'length' => 32
        ],

        'password' => [
            'require' => true,
            'type' => 'string',
            'length' => [8,32]
        ]
    ];

    public function __construct(DBDriver $dbdriver, Validator $validator)
    {
        parent::__construct($dbdriver, 'пользователи', $validator);
        $this->validator->setRules($this->schema);
        
    }

}