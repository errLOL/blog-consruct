<?php

namespace c;
use core\DB;
use core\DBDriver;
use core\Validator;
use model\NewsModel;
use core\Exception\InvalidDataException;
use core\Exception\ErrorNotFoundException;

class NewsController extends BasicController
{

    public function indexAction()
    {
        $id = $this->request->get('id');
        $mpost = new NewsModel(
            new DBDriver(DB::getConnect()),
            new Validator()
        );
        $post = $mpost->getOnce($id);

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

            $mpost = new NewsModel(
                new DBDriver(DB::getConnect()),
                new Validator()
            );
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
            //$error = '';
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
        $mpost = new NewsModel(
            new DBDriver(DB::getConnect()),
            new Validator()
        );
        $post = $mpost->getOnce($id);

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
        $mpost = new NewsModel(
            new DBDriver(DB::getConnect()),
            new Validator()
        );
        $post = $mpost->delete('id_news = ' . $id);
        
        $this->title = 'Успешно';
        $this->content = $this->build('v_delete');
    }
}