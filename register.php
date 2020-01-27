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
	<link href="/css/styles.css" rel="stylesheet" />
	<link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
	<script data-search-pseudo-elements defer
		src="/js/font-awesome.js" crossorigin="anonymous"></script>
	<script src="/js/feather.min.js" crossorigin="anonymous">
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
					<div class="row justify-content-start">
                        <div class="col-lg-5 mt-5">
                        <h2 class="text-dark mt-5"> UpTime Technology</h2>
                        <h5 class="text-dark mt-5 mb-5">Create an Account for Examination</h5>

                        
                        <div class="row">
                            <div class="col-md-4">
                                <a href="/login.php" class="btn bg-gray-600 text-white btn-block mt-5">LOGIN</a>
                            </div>
                            <div class="col-md-5">
                                <a href="/pre-capture.php" class="btn bg-gray-500 text-dark btn-block mt-5">PRE-CAPTURE</a>
                            </div>
                        </div>

                        </div>
						<div class="col-lg-6 offset-md-1">
							<div class="card shadow-lg border-0 rounded-lg mt-5">
								<div class="card-header justify-content-center bg-gray-500">
									<h5 class="text-dark text-uppercase">Registration</h5>
								</div>
								<div class="card-body">
										<small class="text-danger font-weight-bold d-flex justify-content-center" id="fail"></small>
										<small class="text-success font-weight-bold d-flex justify-content-center" id="success"></small>
									<form>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small font-weight-bold mb-1"
                                                        for="inputEmailAddress">First Name</label><input class="form-control py-4"
                                                        id="f_name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small font-weight-bold mb-1"
                                                        for="inputEmailAddress">Last Name</label><input class="form-control py-4"
                                                        id="l_name" type="text" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group"><label class="small font-weight-bold mb-1"
                                                        for="inputEmailAddress">Email</label><input class="form-control py-4"
                                                        id="email" type="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small font-weight-bold mb-1"
                                                        for="inputPassword">Password</label><input class="form-control py-4"
                                                        id="password" type="password" /></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small font-weight-bold mb-1"
                                                        for="inputPassword">Confirm Password</label><input class="form-control py-4"
                                                        id="confirm_password" type="password" /></div>
                                            </div>
                                        </div>
										<div
											class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">

											<button class="btn btn-primary col-12 text-uppercase" id="regBtn"
												type="button">Register</button></div>
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
	<script src="/js/jquery.js" crossorigin="anonymous"></script>
	<script src="/js/boostrap.js" crossorigin="anonymous"></script>
	<script src="/js/scripts.js"></script>
	<script>
		$(document).ready(function () {
			let first; let last; let email; let password; let confirm_password;
			$('#regBtn').click(function (e) {
				e.preventDefault();

				$("#fail").html(" ");
				$("#regBtn").html("REGISTERING...");
                
				first = $('#f_name').val()
				last = $('#l_name').val()
				email = $('#email').val()
				password = $('#password').val()
				confirm_password = $('#confirm_password').val()
                

				if (first.trim() == "" || last.trim() == "" || email.trim() == "" || password.trim() == "" || confirm_password.trim() == "") {
					$("#regBtn").html("REGISTER")
					$("#fail").html("Fill Out Empty Fields");
					return;
				}

                if (password.trim() != confirm_password.trim()) {
                    $("#regBtn").html("REGISTER")
					$("#fail").html("Password Does not Match");
                    return;
                }

				$.post("api/register.php", {
                        first: first,
                        last: last,
						email: email,
						password: password
					})
					.done(function (data) {
						data = JSON.parse(data);
						if (data.success) {
							$(this).html("Login")
							$("#success").html(data.success);
							setTimeout(() => {
								location.href = "pre-capture.php";
							}, 2000);
						} else {
							$(this).html("REGISTER")
							$("#fail").html(data.error);
						}
					});
			})
		});

	</script>
</body>

</html>
<?php } ?>