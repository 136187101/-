(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = {
					"required":{    			
						
						"regex":"none",// 添加您的正则表达式规则，在这里，你可以以电话为例
						"alertText":"* 此项为必填项！",
						"alertTextCheckboxMultiple":"* 请选择一个选项",
						"alertTextCheckboxe":"* 此复选框是必需的"},
					"length":{
						"regex":"none",
						"alertText":"*您填写的内容应是 ",
						"alertText2":" 到 ",
						"alertText3": " 之间允许的字符"},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"* 超出允许检查"},	
					"minCheckbox":{
						"regex":"none",
						"alertText":"* 请选择 ",
						"alertText2":" 选项"},	
					"confirm":{
						"regex":"none",
						"alertText":"* 重复密码填写不正确"},		
					"tel":{
						//"regex":"/^[0-9\-\(\)\ ]+$/",
						//"regex":"/^[1]{1}(([3]{1}[4-9]{1})|([5]{1}[89]{1}))[0-9]{8}$/",
						"regex":"/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",
						//"regex":"/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/",
						"alertText":"* 填写的号码不是正确手机号码"},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* 无效的电子邮件地址"},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* 无效的日期，必须采用yyyy- MM - DD格式"},
					"username":{
						"regex":"/^(?!_)(?!.*?_$)[a-zA-Z0-9_]+$/",
						"alertText":"* 必须是英文字母和数字，不能特殊字符或者空格！"
						},
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z]+$/",
						"alertText":"* 不准特殊caracters"},	
					"ajaxUser":{
						"file":"ajaxyan.php",
						"extraData":"name=eric",
						"alertTextOk":"* 这个用户可用",	
						"alertTextLoad":"* 载入中，请稍候",
						"alertText":"* 这位用户已经采取"},	
					"ajaxName":{
						"file":"ajaxyan.php",
						"alertText":"* 用户名禁止注册或是用户名已经存在",
						"alertTextOk":"* 用户名可以使用",	
						"alertTextLoad":"* 载入中，请稍候"},
					"ajaxcode":{
						"file":"/ajaxyzm.php",
						"alertText":"* 验证码输入有误",
						"alertTextOk":"* 验证码输入正确",	
						"alertTextLoad":"* 载入中，请稍候"},
					"ajaxtel":{
						"file":"checktel.php",
						"alertText":"* 此手机号码已经存在",
						"alertTextOk":"* 此手机号码可以使用",	
						"alertTextLoad":"* 载入中，请稍候"},
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* 只能是英文字符"},
					"validate2fields":{
    					"nname":"validate2fields",
    					"alertText":"* 你必须有一个名字和一个姓氏"}	
					}	
					
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});

/*
1.required：值不可以为空
2.length[0,100] ：文字允许长度
3.confirm[fieldID] ：匹配其他的表单元素的值，fieldID就是其他表单元素的id，这个主要用于再次确认密码
4.telephone ：数据格式要求符合电话格式
5.custom[email] ： 数据格式要求符合email 格式
6.custom[onlyLetterNumber] ：只允许输入数字
7.noSpecialCaracters ：不允许出现特殊字符
8.onlyLetter ： 只能是字母
9.custom[date]：必须符合日期格式YYYY-MM-DD 
10.minSize[6] :最少几位数
11.maxSize[6] ：最多几位数

*/