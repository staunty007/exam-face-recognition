<?php
 session_start();  
 require "./db.php";
 if (!isset($_SESSION["username"]) || $_SESSION["verified"] == false) {
	echo "<script>window.location.href = 'capture.php';</script>";
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
	<title>Dashboard</title>
	<link href="css/styles.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
		crossorigin="anonymous" />
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
	<style>
		.sb-sidenav-dark {
			background: #18263b;
		}

	</style>
</head>

<body class="sb-nav-fixed">
	<?php include 'includes/navbar.php'; ?>
	<div id="layoutSidenav">

		<?php include 'includes/sidebar.php'; ?>

		<div id="layoutSidenav_content">
			<main>
				<div class="sb-page-header pb-10 sb-page-header-dark" style="background: #404f66;">
					<div class="container-fluid">
						<div class="sb-page-header-content py-5">
							<h1 class="sb-page-header-title">
								<div class="sb-page-header-icon"><i data-feather="activity"></i></div>
								<span>Dashboard</span>
							</h1>
						</div>
					</div>
				</div>
				<div class="container-fluid mt-n10">
					<div class="row">
						<div class="col-xl-3 col-md-6">
							<div class="card bg-success text-white mb-4">
								<div class="card-body">Available Exams</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="#">View</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<div class="card bg-warning text-white mb-4">
								<div class="card-body">Upcoming Exams</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="#">View</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<div class="card bg-danger text-white mb-4">
								<div class="card-body">Cancelled Exams</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="#">View</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6">
							<div class="card bg-secondary text-white mb-4">
								<div class="card-body">Grades</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link" href="#">View</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>
					</div>
					<div class="card mb-4">

					</div>
				</div>
			</main>
			<?php include 'includes/footer.php'; ?>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
	</script>
	<script src="js/scripts.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/datatables-demo.js"></script>
</body>

</html>

<?php } ?>
