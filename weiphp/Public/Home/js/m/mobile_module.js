// JavaScript Document by jacy
/**
 定义基本常量
*/
var RESULT_SUCCESS = 'success';
var RESULT_FAIL = 'fail';
var WeiPHP_RAND_COLOR = ["#ff6600","#ff9900","#99cc00","#33cc00","#0099cc","#3399ff","#9933ff","#cc3366","#333333","#339999"];

/***/
(function(){
	//异步请求提交表单
	//提交后返回格式json json格式 {'result':'success|fail',data:{....}}
	function doAjaxSubmit(form,callback){
		$.Dialog.loading();
		$.ajax({
			data:form.serializeArray(),
			type:'post',
			dataType:'json',
			url:form.attr('action'),
			success:function(data){
				$.Dialog.close();
				callback(data);
				}
			})
	}
	
	function initFixedLayout(){
		var navHeight = $('#fixedNav').height();
		$('#fixedContainer').height($(window).height()-navHeight);	
	}
	
	var WeiPHP = {
		doAjaxSubmit:function(form,callback){
			doAjaxSubmit(form,callback);
		},
		initFixedLayout:initFixedLayout
	};
	$.extend({
		WeiPHP: WeiPHP
	});
})();

/*
*/
$(function(){
	$('.toggle_list .title').click(function(){
		$(this).parents('li').toggleClass("toggle_list_open");
		})
	})