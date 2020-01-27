<?php
 session_start();  
 require "./db.php";
 if (!isset($_SESSION["email"]) || $_SESSION["verified"] == false) {
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
			<main id="app">
				<div class="sb-page-header pb-5 sb-page-header-dark" style="background: #404f66;">
					<div class="container-fluid">
					</div>
				</div>
				<div class="container-fluid mt-n10">
					<div class="row" style="margin-top: 120px;">
						<div class="col-md-8">
							<div class="sb-datatable table-responsive table-striped d-none" id="show-table">
								<table class="table table-bordered table-hover" width="100%"
									cellspacing="0">
									<thead>
										<tr class="bg-gray-700 text-white">
											<th>ID</th>
											<th>COURSE</th>
											<th>SCORE</th>
											<th>DATE</th>
										</tr>
									</thead>
									<tfoot class="bg-gray-700 text-white">
										<tr>
                                            <th>ID</th>
											<th>COURSE</th>
											<th>SCORE</th>
											<th>DATE</th>
										</tr>
									</tfoot>
									<tbody>
										<tr v-for="(grade, index) in grades" :key="grade.id">
											<td>{{index + 1  }}</td>
											<td>{{ grade.course.toUpperCase() }}</td>
											<td>{{ grade.score }}</td>
											<td>{{ grade.date }}</td>
										</tr>
									</tbody>
								</table>
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


	<script src="/js/jquery.js" crossorigin="anonymous"></script>
	<script src="/js/boostrap.js" crossorigin="anonymous"></script>
	<script src="/js/scripts.js"></script>
	<script src="/js/axios.js"></script>
	<script src="/js/vue.js"></script>
	<script>
		const vue = new Vue({
			el: "#app",
			data: {
				loading: false,
				showGrades: false,
				grades: [],
			},
			methods: {
				async fetchGrades() {
					await axios.get("/api/all-grades.php")
						.then((res) => {
							this.grades = res.data;
                            this.showGrades = true;
                            $("#show-table").removeClass("d-none");
						})
						.catch((e) => {
							console.log(e)
						})
				}
			},
			mounted() {
				this.fetchGrades();
			}
		});

	</script>
</body>

</html>

<?php } ?>
