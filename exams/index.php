<?php
 session_start();  
 require $_SERVER['DOCUMENT_ROOT'] ."/db.php";
 if (!isset($_SESSION["email"]) || $_SESSION["verified"] == false) {
	echo "<script>window.location.href = '/capture.php';</script>";
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
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
		crossorigin="anonymous" />
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
	<?php include $_SERVER['DOCUMENT_ROOT'] .'/includes/navbar.php'; ?>
	<div id="layoutSidenav">

		<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>

		<div id="layoutSidenav_content">
			<main id="app">
				<div class="sb-page-header pb-10 sb-page-header-dark" style="background: #404f66;">
					<div class="container-fluid">
						<div class="sb-page-header-content py-5">
							<h1 class="sb-page-header-title">
								<div class="sb-page-header-icon"><i data-feather="activity"></i></div>
								<span>Exams</span>
							</h1>
						</div>
					</div>
				</div>
				<div class="container-fluid mt-n10 d-none" id="displayExam">
					<div class="row" v-if="loadedExam">
						<div class="col-md-4" v-for="exam in exams" :key="exam.id">
							<div class="card">
								<div class="row no-gutters">
									<div class="col-md-4"><img class="img-fluid" src="http://vancouverunitarians.ca/ucv/wp-content/uploads/2019/01/books-icon.png" alt="..."></div>
									<div class="col-md-8">
										<div class="card-body">
											<h5 class="card-title">{{ exam.name }}</h5>
											<p class="card-text d-none">Course Code: {{ exam.code }}</p>
											<p class="card-text">No of Questions: {{ exam.questions }}</p>
											<p class="card-text">Duration: {{ exam.duration }}</p>
                                            <button class="btn btn-sm btn-primary col-6" @click="loadQuestion(exam.code)"
                                            :disabled="exam.questions < 1">Start Now</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
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
                loadedExam: false,
				exams: [],
			},
			methods: {
				getExams() {
					this.loading = true
					axios.get('/api/all-exams.php')
						.then((res) => {
                            this.loadedExam = true
							this.loading = false;
							this.exams = res.data
							$("#displayExam").removeClass("d-none");
						})
						.catch((e) => {
							console.log(e.response.error);
						})
                },
                loadQuestion(code) {
                    var url = '/exams/quest.php?start='+ code;
                    var myWindow = window.open(url, "", "width=900,height=600");
                }
			},
			mounted() {
				this.getExams()
				//this.getExams()
			}
		});

	</script>
</body>

</html>

<?php } ?>
