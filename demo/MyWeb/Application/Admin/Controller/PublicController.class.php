<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2013
// +----------------------------------------------------------------------
// | Author: 
// +----------------------------------------------------------------------

namespace Admin\Controller;
use User\Api\UserApi;

/**
 * 后台首页控制器
 * @author hbd
 */
class PublicController extends \Think\Controller {

    /**
     * 后台用户登录
     * @author hbd
     */
    public function login($username = null, $password = null, $secodeverify = null){
        
        
        if(IS_POST){
            /* 检测验证码 */
            if(!$this->check_verify($secodeverify)){
                $this->error('验证码输入错误！');
            }

            /* 调用UC登录接口登录 */
            $User = new UserApi;
            $uid = $User->login($username, $password);
            
            if(0 < $uid){ //UC登录成功
                /* 登录用户 */
                $Member = D('Member');
                if($Member->login($uid)){ //登录用户
                    //跳转到登录前页面
                    $this->success('登录成功！', U('Admin/Index/index'));
                } else {
                    $this->error($Member->getError());
                }

            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }
        } else {
            if(is_login()){
                $this->redirect('Admin/Index/index');
            }else{
                /* 读取数据库中的配置 */
                $config	=	S('DB_CONFIG_DATA');
                if(!$config){
                    $config	=	D('Config')->lists();
                    S('DB_CONFIG_DATA',$config);
                }
                C($config); //添加配置
                
                $this->display();
            }
        }
    }

    /* 退出登录 */
    public function logout(){
        if(is_login()){
            D('Member')->logout();
            session('[destroy]');
            $this->success('退出成功！', U('login'));
        } else {
            $this->redirect('login');
        }
    }
    
    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    
    public function verify($id=''){
        $config =    array(
            'fontSize'    =>    24,      // 验证码字体大小  
            'length'      =>    4,      // 验证码位数   
            'useNoise'    =>    false, // 关闭验证码杂点
            'imageW'      =>    180
        );
        $verify = new \Think\Verify($config);
        return $verify->entry($id);
    }

    public function check_verify($code, $id = ''){    
        $verify = new \Think\Verify();   
        return $verify->check($code, $id);
    }
}
