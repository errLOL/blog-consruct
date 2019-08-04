<?php

namespace Phpblog\Controller;

use Phpblog\Core\Exception\InvalidDataException;
use Phpblog\Core\Exception\ErrorNotFoundException;
use Phpblog\Core\Forms\FormBuilder;
use Phpblog\Forms\AddNews;
use Phpblog\Forms\EditNews;

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
        $form = new AddNews();
        $formBuilder = new FormBuilder($form);

        if($this->request->is_post()) {
            try {
                $mpost = $this->container->fabricate('factory.models', 'News');
                $handled = $form->handleRequest($this->request);
                $loc = $mpost->add($handled);
                $this->redirect(sprintf('post/%s', $loc));
            } catch (InvalidDataException $e) {
                $form->addErrors($e->getErrors());
            }
        }
        $this->content = $this->build('v_add', ['form' => $formBuilder]);
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
        $_POST['title'] = $post['title'];
        $_POST['text'] = $post['text'];
        $form = new EditNews();
        $formBuilder = new FormBuilder($form);
        $handled = $form->handleRequest($this->request, false);
        
        if($this->request->is_post()) {
            try {
                $handled = $form->handleRequest($this->request);
                $mpost->update($handled, "id_news = $id");
                $this->redirect(sprintf('post/%s', $id));
            } catch (InvalidDataException $e) {
                $form->addErrors($e->getErrors());
            }
        }
        $this->content = $this->build('v_edit', ['form' => $formBuilder]);
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