<?php

namespace Services\Controller;

/**
 * 验证码控制器
 * @author hbd
 */
class VerifyController extends \Think\Controller {   

    public function index($id=''){
    	$config =    array(    
    		'fontSize'    =>    20,      // 验证码字体大小  
    		'length'      =>    4,  	// 验证码位数   
    	    'useNoise'    =>    false, // 关闭验证码杂点
    	    'imageW'      =>    130
        );
        $verify = new \Think\Verify($config);
        return $verify->entry($id);
    }

}
