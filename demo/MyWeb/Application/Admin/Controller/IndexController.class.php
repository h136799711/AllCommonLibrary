<?php

namespace Admin\Controller;
use Think\Controller;

class IndexController extends AdminController {
	
    public function index(){
    	
		  if(UID){
        $this->meta_title = '管理首页';
//        echo UID;
        $this->display();
      } else {
        $this->redirect('Public/login');
      }
    }
}