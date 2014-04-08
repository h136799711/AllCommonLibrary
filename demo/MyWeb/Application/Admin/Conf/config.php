<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2013  All rights reserved.
// +----------------------------------------------------------------------
// | Author: bd 
// +----------------------------------------------------------------------

/**
 * 前台配置文件
 * 所有除开系统级别的前台配置
 */
return array(
    /* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => '', //session前缀
    'COOKIE_PREFIX'  => 'bd_admin_', // Cookie前缀 避免冲突

    /* 后台错误页面模板 */
    'TMPL_ACTION_ERROR'     =>  MODULE_PATH.'View/Public/error.html', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  MODULE_PATH.'View/Public/success.html', // 默认成功跳转对应的模板文件
    'TMPL_EXCEPTION_FILE'   =>  MODULE_PATH.'View/Public/exception.html',// 异常页面的模板文件
	
    /* 公共资源相关路径配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/lib',
        '__IMG__'    => __ROOT__ . '/Public/images',
        '__CSS__'    => __ROOT__ . '/Public/css',
        '__JS__'     => __ROOT__ . '/Public/js',
    ),

    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX'    => 'bd_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
	'ADMIN_ALLOW_IP' => array('127.0.0.1') //管理员账户允许访问的IP
    
);
