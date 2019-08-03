<?php

namespace Phpblog\Controller;

use Phpblog\Core\Exception\InvalidDataException;
use Phpblog\Core\Exception\ErrorNotFoundException;
/* use Phpblog\Core\Forms\FormBuilder;
use Phpblog\Forms\SignUp;
use Phpblog\Forms\LogIn; */

class NewsController extends BasicController
{

    public function indexAction()
    {
        $id = $this->request->get('id');
        $mpost = $this->container->fabricate('factory.models', 'News');
        $post = $mpost->getOnce(['id_news' => $id]);

        if(empty($post)) {
            throw new ErrorNotFoundException();  
        }
        
        $this->title = $post['title'];
        $this->content = $this->build('v_post', [
            'post' => $post
        ]);
    }

    public function addAction()
    {

        if(!$this->is_admin) {
            throw new ErrorNotFoundException();
        }
        $this->title = 'Добавить';

        if($this->request->is_post()) {
            $title =  $this->request->post('title');
            $text =  $this->request->post('text');
            $mpost = $this->container->fabricate('factory.models', 'News');

            try {
                $loc = $mpost->add(compact('title','text'));
                $this->redirect(sprintf('post/%s', $loc));
            } catch (InvalidDataException $e) {
                $titleErr = $e->getErrors()['title'] ?? '';
                $textErr = $e->getErrors()['text'] ?? '';
            }
        }
        else {
            $title = '';
            $text = '';
            $titleErr = '';
            $textErr = '';
        }

        $this->content = $this->build('v_add', [
            'title' => $title,
            'text' => $text,
            'titleErr' => $titleErr,
            'textErr' => $textErr
        ]);
    }

    public function editAction()
    {   
        $id = $this->request->get('id');

        if(!$this->is_admin) {
            throw new ErrorNotFoundException();
        }

        $this->title = 'Редактирование статьи';
        $mpost = $this->container->fabricate('factory.models', 'News');
        $post = $mpost->getOnce(['id_news' => $id]);

        if(empty($post)) {
            throw new ErrorNotFoundException();
        }
        
        if($this->request->is_post()) {
            $title = $this->request->post('title');
            $text = $this->request->post('text');

            try {
                $mpost->update(compact('title','text'), "id_news = $id");
                $this->redirect(sprintf('post/%s', $id));
            } catch (InvalidDataException $e) {
                $titleErr = $e->getErrors()['title'] ?? '';
                $textErr = $e->getErrors()['text'] ?? '';
            }
        }
        else {
            $titleErr = '';
            $textErr = '';
        }
        $this->content = $this->build('v_edit', [
            'post' => $post,
            'titleErr' => $titleErr,
            'textErr' => $textErr
        ]);
    }

    public function deleteAction()
    {
        if(!$this->is_admin) {
            throw new ErrorNotFoundException();
        }
        $id = $this->request->get('id');
        $mpost = $this->container->fabricate('factory.models', 'News');
        $post = $mpost->delete('id_news = ' . $id);
        
        $this->title = 'Успешно';
        $this->content = $this->build('v_delete');
    }
}