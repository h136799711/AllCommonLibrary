$(function(){
	//图标隐藏菜单
	$(".entrance").hover(function(){
		$(this).children(".user-menu").show();
	},function(){
		$(this).children(".user-menu").hide();
	});

	$('.action .detailed').each(function(){
		$(this).click(function() {
        	detailed_content();
        	return false;
        });
  	});

	$('.action .thinkbox-image').each(function(){
		$(this).click(function() {
        	thinkbox_image();
        	return false;
        });
  	});

	(function(){
		var $nav = $("#nav"), $current = $nav.children("[data-key=" + $nav.data("key") + "]");
		if($nav.length){
			$current.addClass("current");
		} else {
			$("#nav").children().first().addClass("current");
		}
	})();


    //ajax post submit请求
    $('.ajax-post').click(function(){
        var target;//请求url
        var query;//post数据
        var target_form = $(this).attr('target-form');//数据在DOM的来源位置,目标应该是(或者内部含有)form,input,select,textarea元素
	    var form;//数据在DOM中的jquery对象
        var success_callback = $(this).attr('success');//成功以后的回调函数
        var error_callback = $(this).attr('error');
        var that = this;
        var nead_confirm=false;//是否需要弹出确认框
        if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
            form = $('.'+target_form);
            if ($(this).attr('hide-data') === 'true'){//无数据时也可以使用的功能
            	form = $('.hide-data');
            	query = form.serialize();
            }else if (form.get(0)==undefined){
            	return false;
            }else if ( form.get(0).nodeName=='FORM' ){
                if ( $(this).hasClass('confirm') ) {
                    if(!confirm('确认要执行该操作吗?')){
                        return false;
                    }
                }
                if($(this).attr('url') !== undefined){
                	target = $(this).attr('url');
                }else{
                	target = form.get(0).action;
                }
                query = form.serialize();
            }else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
                form.each(function(k,v){
                    if(v.type=='checkbox' && v.checked==true){
                        nead_confirm = true;
                    }
                });
                if ( nead_confirm && $(this).hasClass('confirm') ) {
                    if(!confirm('确认要执行该操作吗?')){
                        return false;
                    }
                }
                query = form.serialize();
            }else{
                if ( $(this).hasClass('confirm') ) {
                    if(!confirm('确认要执行该操作吗?')){
                        return false;
                    }
                }
                query = form.find('input,select,textarea').serialize();
            }
            $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
            $.post(target,query).success(function(data){
                if (data.status==1) {
                    window[success_callback](data);
                }else{
	                $(that).removeClass('disabled').attr('autocomplete','off').prop('disabled',false);
                    window[error_callback](data);
                }
            });
        }
        return false;
    });

    //添加first-child,last-child兼容ie6/7/8class
    var selecters=[
        '.ot_post_list >li',
        '.side-block >div',
        '.ot-list-info div',
        '.ot-recommend .list-group-item',
        '.ot_answer_list li.list-group-item',
        '.login #myTab li',
        '.download .btn-group .btn',
        '.side-block>div>div',
        '.main-block >div'
    ];
    $(selecters).each(function(i,v){
        $(v).filter(':first-of-type').addClass('first-child').end().filter(':last-of-type').addClass('last-child');
    });

    //设置页面最小高度
    var wHeight = $(window).height();
    var hHeight = $("header").height();
    var fHeight = $(".record").height();
    var cHeight = wHeight-hHeight-fHeight;
    $(".content").css({
        minHeight:cHeight
    })
});

    //IE浏览器模拟placeholder
    function placeholderIE(target,posTop,posLeft){
        if(window.ActiveXObject){
            $(target).find(".placeholder_ie  i").css({
                marginTop:posTop,
                marginLeft:posLeft
            });
            $(target).find(".placeholder_ie  i").show(); 
            $(target).find(".placeholder_ie  input").keydown(function(){
                $(this).parent("div").find("i").hide();        
            });
           $(target).find(".placeholder_ie  i").blur(function(){
                if($(this).val()==""){
                    $(this).parent("div").find("i").show();   
                }     
            }) 
        }           
    }

/**
 * 和PHP一样的时间戳格式化函数
 * @param  {string} format    格式
 * @param  {int}    timestamp 要格式化的时间 默认为当前时间
 * @return {string}           格式化的时间字符串
 */
 function date(format, timestamp){ 
    var a, jsdate=((timestamp) ? new Date(timestamp*1000) : new Date());
    var pad = function(n, c){
        if((n = n + "").length < c){
            return new Array(++c - n.length).join("0") + n;
        } else {
            return n;
        }
    };
    var txt_weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var txt_ordin = {1:"st", 2:"nd", 3:"rd", 21:"st", 22:"nd", 23:"rd", 31:"st"};
    var txt_months = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]; 
    var f = {
        // Day
        d: function(){return pad(f.j(), 2)},
        D: function(){return f.l().substr(0,3)},
        j: function(){return jsdate.getDate()},
        l: function(){return txt_weekdays[f.w()]},
        N: function(){return f.w() + 1},
        S: function(){return txt_ordin[f.j()] ? txt_ordin[f.j()] : 'th'},
        w: function(){return jsdate.getDay()},
        z: function(){return (jsdate - new Date(jsdate.getFullYear() + "/1/1")) / 864e5 >> 0},
        // Week
        W: function(){
            var a = f.z(), b = 364 + f.L() - a;
            var nd2, nd = (new Date(jsdate.getFullYear() + "/1/1").getDay() || 7) - 1;
            if(b <= 2 && ((jsdate.getDay() || 7) - 1) <= 2 - b){
                return 1;
            } else{
                if(a <= 2 && nd >= 4 && a >= (6 - nd)){
                    nd2 = new Date(jsdate.getFullYear() - 1 + "/12/31");
                    return date("W", Math.round(nd2.getTime()/1000));
                } else{
                    return (1 + (nd <= 3 ? ((a + nd) / 7) : (a - (7 - nd)) / 7) >> 0);
                }
            }
        },
        // Month
        F: function(){return txt_months[f.n()]},
        m: function(){return pad(f.n(), 2)},
        M: function(){return f.F().substr(0,3)},
        n: function(){return jsdate.getMonth() + 1},
        t: function(){
            var n;
            if( (n = jsdate.getMonth() + 1) == 2 ){
                return 28 + f.L();
            } else{
                if( n & 1 && n < 8 || !(n & 1) && n > 7 ){
                    return 31;
                } else{
                    return 30;
                }
            }
        },
        // Year
        L: function(){var y = f.Y();return (!(y & 3) && (y % 1e2 || !(y % 4e2))) ? 1 : 0},
        //o not supported yet
        Y: function(){return jsdate.getFullYear()},
        y: function(){return (jsdate.getFullYear() + "").slice(2)},
        // Time
        a: function(){return jsdate.getHours() > 11 ? "pm" : "am"},
        A: function(){return f.a().toUpperCase()},
        B: function(){
            // peter paul koch:
            var off = (jsdate.getTimezoneOffset() + 60)*60;
            var theSeconds = (jsdate.getHours() * 3600) + (jsdate.getMinutes() * 60) + jsdate.getSeconds() + off;
            var beat = Math.floor(theSeconds/86.4);
            if (beat > 1000) beat -= 1000;
            if (beat < 0) beat += 1000;
            if ((String(beat)).length == 1) beat = "00"+beat;
            if ((String(beat)).length == 2) beat = "0"+beat;
            return beat;
        },
        g: function(){return jsdate.getHours() % 12 || 12},
        G: function(){return jsdate.getHours()},
        h: function(){return pad(f.g(), 2)},
        H: function(){return pad(jsdate.getHours(), 2)},
        i: function(){return pad(jsdate.getMinutes(), 2)},
        s: function(){return pad(jsdate.getSeconds(), 2)},
        //u not supported yet
        // Timezone
        //e not supported yet
        //I not supported yet
        O: function(){
            var t = pad(Math.abs(jsdate.getTimezoneOffset()/60*100), 4);
            if (jsdate.getTimezoneOffset() > 0) t = "-" + t; else t = "+" + t;
            return t;
        },
        P: function(){var O = f.O();return (O.substr(0, 3) + ":" + O.substr(3, 2))},
        //T not supported yet
        //Z not supported yet
        // Full Date/Time
        c: function(){return f.Y() + "-" + f.m() + "-" + f.d() + "T" + f.h() + ":" + f.i() + ":" + f.s() + f.P()},
        //r not supported yet
        U: function(){return Math.round(jsdate.getTime()/1000)}
    };
    return format.replace(/[\\]?([a-zA-Z])/g, function(t, s){
        if( t!=s ){
            // escaped
            ret = s;
        } else if( f[s] ){
            // a date function exists
            ret = f[s]();
        } else{
            // nothing special
            ret = s;
        }
        return ret;
    });
 }
// 点击列表头像后获得的信息的json数组赋值
function showInfo(choose,data){
    //用户姓名
    choose.parents(".show_info").find(".ot_user_info_username").text(data.username);
    //在线or离线
    if(data.online == 1){
        choose.parents(".show_info").find(".ot_user_info_online").text('在线');
    }else {
        choose.parents(".show_info").find(".ot_user_info_online").text('离线');
    }
    //注册时间
    choose.parents(".show_info").find(".ot_user_info_reg_time").text(date("Y-m-d", data.reg_time));

    //最后登陆时间
    choose.parents(".show_info").find(".ot_user_info_last_login_time").text(date("Y-m-d"));
    //用户等级
    var levelVal;
    var level = parseInt(data.level,10);
    switch(level){
        case 1 :
            levelVal = "初出茅庐";
            break; 
    }
    choose.parents(".show_info").find(".ot_user_info_level").text(levelVal);
    //用户签名
    choose.parents(".show_info").find(".ot_user_info_sign p").text(data.sign);
}
// 点击活跃用户头像后获得的信息的json数组赋值
function showActInfo(choose,data){
    //用户姓名
    choose.parents(".show_info").find(".ot_active_username").text(data.username);
    //在线or离线
    if(data.online == 1){
        choose.parents(".show_info").find(".ot_active_online").text('在线');
    }else {
        choose.parents(".show_info").find(".ot_active_online").text('离线');
    }
    //注册时间
    choose.parents(".show_info").find(".ot_active_reg_time").text(date("Y-m-d", data.reg_time));

    //最后登陆时间
    choose.parents(".show_info").find(".ot_active_last_login_time").text(date("Y-m-d"));
    //用户等级
    var levelVal;
    var level = parseInt(data.level,10);
    switch(level){
        case 1 :
            levelVal = "初出茅庐";
            break; 
    }
    choose.parents(".show_info").find(".ot_active_level").text(levelVal);
}