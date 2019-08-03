<?php 

namespace Phpblog\Controller;

class HomeController extends BasicController
{
    public function indexAction()
    {
        $this->title = 'Главная';
        $NewsModel = $this->container->fabricate('factory.models', 'News');
        $posts = $NewsModel->getAll();
        $this->content = $this->build('v_index', [
            'is_admin' => $this->is_admin,
            'posts' => $posts
        ]);
    }
}