<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class DemoController extends Controller {
	
	public function ueditor()
	{
		if(IS_GET){
			$this->display();
		}else if(IS_POST){
			echo $this->htmldecode();
		}
	}

	public function htmldecode(){  
        if(!empty($_POST['ueditortext'])){                                   
            $contents=htmlspecialchars(stripslashes($_POST['ueditortext']));  
            return $contents;  
        }  
    }

    public function index(){
    $DemoIndex   = D('DemoIndex');
	
	$fields = $DemoIndex->getDbFields();
	//$list = array("a"=>"b","b"=>"c","c"=>"d");
	$list = 	$DemoIndex->select(); 
	dump($fields);
	dump($list);
	$this->assign("fields",$fields);
	$this->assign("list",$list);
	$this->display();
	//$this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px }</style><div style="padding: 24px 48px;"> <p>欢迎使用 <b></b>！</p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }
	
	public function config($param='default'){
		$DB_HOST= C("DB_HOST");
		$PORT= C("DB_PORT");
        $host = $DB_HOST.($PORT?":{$PORT}":'');
		$DB_NAME= C("DB_NAME");
		$DB_USER= C("DB_USER");
		$DB_PWD= C("DB_PWD");
		$DB_NAME= C("DB_NAME");
		//$con = mysql_connect($host, $DB_USER, $DB_PWD,true,131072);
	//	if(!$con )
	//	{
	//		$this->show('数据库链接失败！'.$host);
	//		return ;
	//	}
	//	if(!mysql_select_db($DB_NAME, $con))
	//	{
	//		$this->show('选择数据库失败！');
	//		return ;
	//	}

		$arr["ROOT"] = THINK_PATH ;
		$arr["APP"] = APP_PATH.'' ;		
		$arr["MODULE"] = $Think.__MODULE__;
		$arr["CONTROLLER"] = $Think.__CONTROLLER__;
		$arr["ACTION"] = $Think.__ACTION__;
		$arr["SELF"] = $Think.__SELF__;
		$arr["INFO"] = $Think.__INFO__;
		$this->assign("DB_HOST",$DB_HOST);
		$this->assign("DB_NAME",$DB_NAME);
		$this->assign("DB_USER",$DB_USER);
		$this->assign("DB_PWD",$DB_PWD);
		$this->assign($arr);
		$this->display('config');
	}

}