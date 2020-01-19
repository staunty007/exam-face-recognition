<?php
 session_start();  
 require "./db.php";
 if (isset($_SESSION["username"])) {
	echo "<script>window.location.href = 'dashboard.php';</script>";
	exit; 
  } else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>UpTime Tech</title>
	<link href="css/styles.css" rel="stylesheet" />
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
	<script data-search-pseudo-elements defer
		src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous">
	</script>
	<link
		href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
		rel="stylesheet" />
	<link
		href="https://fonts.googleapis.com/css?family=Libre+Franklin:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap"
		rel="stylesheet" />
</head>

<body class="" style="background: #d6dbdf;">
	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-5">
							<div class="card shadow-lg border-0 rounded-lg mt-5">
								<div class="card-header justify-content-center bg-gray-500">
									<img src="./images/student.png" style="border: 1px solid grey;border-radius: 50%;"
										width="60" height="60" class="img-rounded" alt="">
								</div>
								<div class="card-body">
										<small class="text-danger d-flex justify-content-center" id="fail"></small>
										<small class="text-success d-flex justify-content-center" id="success"></small>
									<form>
										<div class="form-group"><label class="small mb-1"
												for="inputEmailAddress">Email</label><input class="form-control py-4"
												id="email" type="email" />
										</div>
										<div class="form-group"><label class="small mb-1"
												for="inputPassword">Password</label><input class="form-control py-4"
												id="password" type="password" /></div>
										<div class="form-group">
											<div class="custom-control custom-checkbox"><input
													class="custom-control-input" id="rememberPasswordCheck"
													type="checkbox" /><label class="custom-control-label"
													for="rememberPasswordCheck">Remember password</label></div>
										</div>
										<div
											class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">

											<button class="btn btn-primary col-12" id="loginBtn"
												type="button">Login</button></div>
									</form>
								</div>
								<div class="card-footer text-center">
									<div class="small text-muted">
										<p>Uptime Technology Examination</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<div id="layoutAuthentication_footer">
			<footer class="sb-footer py-4 mt-auto sb-footer-dark">
				<div class="container-fluid">
					<div class="d-flex align-items-center justify-content-between small">
						<div>Copyright &copy; Your Website 2019</div>
						<div>
							<a href="#">Privacy Policy</a>
							&middot;
							<a href="#">Terms &amp; Conditions</a>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
	</script>
	<script src="js/scripts.js"></script>
	<script>
		$(document).ready(function () {
			let email;
			let password;
			$('#loginBtn').click(function (e) {
				e.preventDefault();

				$("#fail").html(" ");
				$(this).html("Loggin...")


				email = $('#email').val()
				password = $('#password').val()

				if (email.trim() == "" || password.trim() == "") {
					$(this).html("Login")
					$("#fail").html("Fill Out Empty Fields");
					return;
				}

				$.post("api/login.php", {
						email: email,
						password: password
					})
					.done(function (data) {
						data = JSON.parse(data);
						if (data.success) {
							$(this).html("Login")
							$("#success").html(data.success);
							setTimeout(() => {
								location.href = "capture.php";
							}, 3000);
						} else {
							$(this).html("Login")
							$("#fail").html(data.error);
						}
					});
			})
		});

	</script>
</body>

</html>
<?php } ?>