<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>newLogin.php</title>

	<script src="https://kit.fontawesome.com/8bd68fd7c7.js" crossorigin="anonymous"></script>


	<style>
		body {
			background-image: url("baymaxLogo.png");
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			background-attachment: fixed;
		}
		input[type=text], input[type=password] {
			margin: 1px 8px;
			padding: 14px 20px;
			/*display: inline-block; */
			border: 1px solid black;
			box-sizing: border-box;
			border-radius: 30px;
			border: none;
			outline: none;
			text-align: left;
			text-indent: 24px;
			background-color: lightblue;
		} 
		text {
			margin: 0 0 0 20px;
		}
		input[type=submit] {
			background-color: red;
			color: white;
			padding: 10px 20px;
			margin: 16px 0px 0px 0px;
			border: none;
			border-radius: 30px;
			cursor: pointer;
			width: 100%;
			height: 45px;
		}
		input[type=submit]:hover {
			background-color: #B91520;
		} 
		a {
			display: block;
			text-align: left;
			margin-top: 5px;
			color: gray;
			font-size: 16px;
			text-decoration: none;
		}
		a:hover {
			color: #B91520;
			text-decoration: underline;
		}
		.my-box {
			background-color: white;
			display: flex;
			justify-content: center;
			align-items: center;
			max-width: 300px;
			height: fit-content;
			border-radius: 20px;
			position: fixed;
			bottom: 300px;
			left: 20%;
		}
		.container {
			width: 350px;
			display: flex;
			flex-direction: column;
			padding: 0 15px 0 15px;
		}
		i {
			position: relative;
			top: 31px;
			left: 24px;
		}
		.bottom-text {
			padding: 10px;
		}
		h2 {
			text-align: center;
			color: red;
			font-size: 30px;
		}
		

	</style>

</head>
<body>
	<div class="my-box">
		<div class="container">

			<h2>Login</h2>

			<i class="fa-solid fa-envelope"></i>
			<input type="text" id="email" name="email" placeholder="Email:" required>

			<i class="fa-solid fa-lock"></i>
			<input type="password" id="password" name="password" placeholder="Password:" required>

			<input type="submit" value="Login">

			<div class="bottom-text">
				<a href="">Forgot Password:</a>
				<a href="">Not a member? <u>Sign up now</u></a>
			</div>

		</div>

	</div>

</body>
</html>