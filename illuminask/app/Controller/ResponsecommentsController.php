<?php
  class ResponsecommentsController extends AppController {

      public function add() {
          if ($this->request->is('post')) {
            $this->request->data['Responsecomment']['date']=date("Y-m-d H:i:s");
            $this->request->data['Responsecomment']['user_id']=$this->Session->read("Auth.User.id");
              if ($this->Responsecomment->save($this->request->data)) {
                  $this->Flash->success('Your comment has been published');
              $this->redirect($this->referer());
              }
              else{
                  $this->Flash->error('Your comment could not be published');
              $this->redirect($this->referer());
              }
          }
      }
  }
