<?php

namespace Phpblog\Model;
use Phpblog\Core\DBDriver;
use Phpblog\Core\Validator;

class SessionModel extends BasicModel
{
    protected $schema = [
        'id_session' => [
            'primary' => true,
            'type' => 'integer'
        ],

        'sid' => [
            'require' => true,
            'type' => 'string',
            'length' => 32
        ],

        'id_user' => [
            'require' => true,
            'type' => 'integer',
            'length' => 32
        ],
        
        'created_at' => [
            'type' => 'timestamp',
        ],

        'updated_at' => [
            'type' => 'timestamp',
        ]
    ];

    public function __construct(DBDriver $dbdriver, Validator $validator)
    {
        parent::__construct($dbdriver, 'sessions', $validator);
        $this->validator->setRules($this->schema);
        
    }

    public function setSession($id, $sid)
    {
        return $this->add(['sid' => $sid, 'id_user' => $id]);
    }

    public function getbySid($sid)
    {
        $sql ='SELECT `id_user`, `login`, `password` FROM `sessions` JOIN `пользователи` ON sessions.id_user = пользователи.id_user WHERE `sid` = :sid';
        return $this->dbdriver->select($sql, ['sid' => $sid], 'one');
    }
}