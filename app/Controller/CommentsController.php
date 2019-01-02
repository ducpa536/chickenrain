<?php

class CommentsController extends AppController
{
    public $uses = ['Comment'];
	//Add Comment
    public function add()
    {
        
        if ($this->request->is('post')) {
            $this->Comment->set($this->request->data);
            if ($this->Comment->validates()) { //trả về true or false
                $this->Comment->create();
                if ($this->Comment->save($this->request->data)) {
                    $this->Session->setFlash(__('Da gui nhan xet'),'default',array('alert alert-info'));
                } else {
                    $this->Session->setFlash(__('Chua gui duoc vui long thu lai'),'default',array('alert alert-danger'));
                }
            } else {
                $comment_errors = $this->Comment->validationErrors;
                $this->Session->write('comment_errors', $comment_errors);
            }
            $this->redirect($this->referer().'#related'); // tu dong load lai trang hien tai
        }
    }

    
}

?>