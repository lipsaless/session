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
	
<!--===============================================================================-->
							<!-- LOGIN -->
<!--===============================================================================-->

<div id="login" class="limiter">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<img src="images/323.jpg" alt="IMG">
			</div>

			<form id="form-login" class="login100-form validate-form" action="controller/autentica.php" method="POST">
				<span class="login100-form-title">
					Login
				</span>
				<div class="alert alert-danger" style="display: none;">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					<strong></strong>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Digite algum e-mail">
					<input class="input100" type="text" name="email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Digite alguma senha">
					<input class="input100" type="password" name="senha">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>
				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn">Entrar<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
				</div>
				<div class="text-center p-t-136">
					<a id="nova-conta" class="txt2" href="#">
						Criar nova conta
						<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!--===============================================================================-->
							<!-- CADASTRO -->
<!--===============================================================================-->

<div id="cadastro" class="limiter" style="display:none;">
	<div class="container-login100">
		<div class="wrap-login100">
			<div class="login100-pic js-tilt" data-tilt>
				<img src="images/323.jpg" alt="IMG">
			</div>

			<form id="form-cadastro" class="login100-form validate-form" action="" method="POST">
				<input type="hidden" name="action">
				<span class="login100-form-title">
					Cadastro
				</span>
				<div class="alert alert-danger" style="display: none;">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					<strong></strong>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Digite o nome">
					<input class="input100" type="text" name="nome">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-user" aria-hidden="true"></i>
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Digite algum e-mail">
					<input class="input100" type="text" name="email">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Digite alguma senha">
					<input class="input100" type="password" name="senha">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-lock" aria-hidden="true"></i>
					</span>
				</div>
				<div class="container-login100-form-btn">
					<button type="submit" class="login100-form-btn">Salvar<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
				</div>
				<div class="text-center p-t-136">
					<a id="realiza-login" class="txt2" href="#">
						<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
						Realizar login
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.js-tilt').tilt({
				scale: 1.2
			});

			$('#form-login').unbind('submit').submit(function(e) {
				e.preventDefault();
				$.ajax({
					method:'POST',
					url: 'controller/autentica.php',
					data: $(this).serialize(),
					dataType:'json',
					success: function(json) {
						if (json.type == 'success') {
							window.location.href = 'views/template.php';
						} else {
							$('.alert-danger').css('display', 'block');
							$('.alert-danger strong').html(json.msg);
						}
					}
				})
			});

			$('#form-cadastro').unbind('submit').submit(function(e) {
				e.preventDefault();
				
				$('[name="action"]').val('inserirUser');

				$.ajax({
					method:'POST',
					url: 'controller/crud.php',
					data: $(this).serialize(),
					dataType:'json',
					success: function(json) {
					}
				})
			});

			$('#nova-conta').unbind('click').click(function() {
				$('#login').css('display', 'none');
				$('#cadastro').css('display', 'block');
				$('.alert-danger').css('display', 'none');
			});

			$('#realiza-login').unbind('click').click(function() {
				$('#cadastro').css('display', 'none');
				$('#login').css('display', 'block');
			});
		});
	</script>

	<script src="js/main.js"></script>

</body>
</html>