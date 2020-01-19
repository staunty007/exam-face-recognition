<?php
 session_start();  
 require "./db.php";
 if (!isset($_SESSION["username"])) {
	echo "<script>window.location.href = 'login.php';</script>";
	exit; 
  } else {
	  if ($_SESSION["verified"] == true) {
		echo "<script>window.location.href = 'dashboard.php';</script>";
		exit; 
	  }
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<a class="navbar-brand" href="#">IMAGE CAPTURING</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="logout.php">LOGOUT</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<div id="layoutAuthentication">
		<div id="layoutAuthentication_content">
			<main>
				<div class="container">
					<div class="row justify-content-left mt-1">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="card shadow-lg border-0 rounded-lg">
								<div class="card-body">
									<video id="video" autoplay height="400" width="600" style="width: 100%;"></video>
								</div>
								<div class="card-footer text-center">
									<div class="row">
										<div class="col-md-3 offset-md-1">
											<button id="snap" class="btn btn-sm btn-dark btn-block">CAPTURE</button>
										</div>
										<div class="col-md-4">
	  										<p class="text-danger font-weight-bold">Note: 3 Max Trials.</p>
										</div>
										<div class="col-md-2">
	  										<h5 id="no-of-fails" class="text-primary"></h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
							<div class="card" style="width: 18rem;">
								<img id="preview"
									src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2BafRODNp9zFNeU8Sw2AqUJk0Z20olKRGxJttNLjlngf94jcW&s"
									class="card-img-top" alt="...">
								<div class="card-body">
									<p class="card-text"><span id="user"></span></p>
								</div>
                            </div>
                            <div class="mt-2 bg-light" style="width: 18rem;">
                                <p class="text-primary font-weight-bold">Welcome , <?php echo $_SESSION["fullname"]; ?><br>
                                Please, Verify your Identity</p>
                            </div>
                        </div>
					</div>
				</div>
			</main>
			<canvas id="canvas" width="320" height="240"></canvas>
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
	<script src="js/capture.js"></script>
</body>

</html>
	<?php } ?>