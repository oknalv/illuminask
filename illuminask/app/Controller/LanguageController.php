<?php
	class LanguageController extends AppController {

    public $components = array(
      'Session'
    );
    public $uses = null;

    public function change($lang = null){
      if($lang != null){
        $this->Session->write("Config.language",$lang);
        Configure::write('Config.language', $this->Session->read('Config.language'));
      }
      return $this->redirect($this->referer());

    }

	}
