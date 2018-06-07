<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="index.php" method="POST">
					<span class="login100-form-title">
						Login
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="senha">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">Entrar</button>
					</div>
					<div class="text-center p-t-12">
						<a class="txt2" href="#">
							Esqueceu e-mail ou senha? clique aqui.
						</a>
					</div>
					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Criar nova conta
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php 
		if ($_POST) {
			include 'connect/connect.php';
			include 'connect/userDAO.php';

			$usuarioDAO = new UserDAO();

			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			
			$user = $usuarioDAO->logar($email, $senha);

			if ($user == true) {
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['senha'] = $senha;

				header('Location: admin.php');
			} else {
				header('Location: index.php?erro=senha');
			}
		}
	?>

	<?php 
		if ($_GET) {
			if (isset($_GET['erro'])) {
				echo " 

					<div class='row'>
					</div>
			<div class='row'>
				

				<div class='col-md-4'>      
				
				</div>
				
				
				<div class='col-md-4'>      
					<div class='alert alert-danger'>
						Usuário ou senha inválidos!
					</div>   
				</div>
					
					<div class='col-md-4'>      
				
				</div>
					

				</div>";
			}
		}
	?>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>