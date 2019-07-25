<?php 

namespace c;
use core\DB;
use core\DBDriver;
use core\Validator;
use model\NewsModel;

class HomeController extends BasicController
{
    public function indexAction()
    {
        $this->title = 'Главная';
        $NewsModel = new NewsModel(
            new DBDriver(DB::getConnect()),
            new Validator()
        );
        $posts = $NewsModel->getAll();
        $this->content = $this->build('v_index', [
            'is_admin' => $this->is_admin,
            'posts' => $posts
        ]);
    }
}