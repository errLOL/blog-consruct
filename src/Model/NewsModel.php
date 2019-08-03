<?php

namespace Phpblog\Model;
use Phpblog\Core\DBDriver;
use Phpblog\Core\Validator;

class NewsModel extends BasicModel
{
    protected $schema = [
        'id_news' => [
            'primary' => true,
            'type' => 'integer'
        ],

        'title' => [
            'require' => true,
            'type' => 'string',
            'length' => [7, 255]
        ],

        'text' => [
            'require' => true,
            'type' => 'string',
            'length' => 5000
        ]
    ];

    public function __construct(DBDriver $dbdriver, Validator $validator)
    {
        parent::__construct($dbdriver, 'новости', $validator);
        $this->validator->setRules($this->schema);
        
    }
}