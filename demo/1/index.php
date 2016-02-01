<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>登陆</title>
	<script>
	function SetFocus()
	{
	if (document.Login.username.value=="")
		document.Login.username.focus();
	else
		document.Login.username.select();
	}
	function CheckForm()
	{
		if(document.Login.username.value=="")
		{
			alert("请输入用户名！");
			document.Login.username.focus();
			return false;
		}
		if(document.Login.userpass.value == "")
		{
			alert("请输入密码！");
			document.Login.userpass.focus();
			return false;
		}
	}
	</script>
</head>

<body>
<form id="Login" name="Login" method="post" action="login.php">
	<div>
		username:<input name="username" type="text" class="input" id="username" />
	</div>
	<div>
		password:<input name="userpass" type="password" class="input" id="userpass" />
	</div>
	<div>
		<input type="submit" name="submit" id="submit" value="submit" />
	</div>
</form>
</body>
</html>