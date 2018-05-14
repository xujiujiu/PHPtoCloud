// JavaScript Document
function Check(){
	if (document.send.rem_id.value ==""){
		window.alert('请输入账号！');
		return false;
	};
	if (document.send.rem_id.value.length < 4){
		window.alert('账号名长度必须大于4！');
		return false;
	};
	if (document.send.rem_password.value ==""){
		window.alert('请输入密码！');
		return false;
	};
	if (document.send.rem_password.value.length < 6){
		window.alert('密码长度必须大于6');
		return false;
	};
	if (document.send.rem_password.value != document.send.rem_cpassword.value){
		window.alert('确认密码与密码不一致！');
		return false;
	};
	if (document.send.rem_email.value == ""){
		window.alert('请输入Email地址！');
		return false;
	};
	if (document.send.rem_email.value.indexOf("@") == -1){
		window.alert('请输入有效的Email地址！');
		return false;
	};
	
}
function CheckIndex(){
	if(document.login.rem_name.value ==""){
		window.alert('请输入账号！');	
		return false;
	};
	if(document.login.rem_name.value.length < 4){
		window.alert('账号名长度必须大于4');	
		return false;
	};
	if(document.login.rem_password.value ==""){
		window.alert('请输入密码！');	
		return false;
	};
	if(document.login.rem_password.value.length < 6){
		window.alert('密码长度大于6');	
		return false;
	};
}
function CheckUser(){
	if(document.login.user_name.value ==""){
		window.alert('请输入账号！');	
		return false;
	};
	if(document.login.user_name.value.length < 4){
		window.alert('账号名长度必须大于4');	
		return false;
	};
	if(document.login.user_password.value ==""){
		window.alert('请输入密码！');	
		return false;
	};
	if(document.login.user_password.value.length < 4){
		window.alert('密码长度大于4');	
		return false;
	};
}