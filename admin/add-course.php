<?php
 session_start();  
 require "../db.php";
 if (!isset($_SESSION["email"]) && isset($_SESSION["role"]) != 1 ) {
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
	<?php include '../includes/navbar.php'; ?>
	<div id="layoutSidenav">

		<?php include '../includes/admin-sidebar.php'; ?>

		<div id="layoutSidenav_content">
			<main id="app">
				<div class="sb-page-header pb-0 sb-page-header-dark" style="background: #404f66;">
					<div class="container-fluid">
						<div class="sb-page-header-content py-4">
							<h1 class="sb-page-header-title">
								<div class="sb-page-header-icon"><i data-feather="activity"></i></div>
								<span>Add Course</span>
							</h1>
						</div>
					</div>
				</div>
				<div class="container-fluid mt-n10">
					<div class="row" style="margin-top: 120px;">
						<div class="col-md-10">
							<div class="card sb-card-header-actions mx-auto">
								<div class="card-header text-uppercase">
									Add Course
									<div>
										<button class="btn btn-pink sb-btn-icon mr-2">
											<i data-feather="heart"></i>
										</button>
										<button class="btn btn-teal sb-btn-icon mr-2">
											<i data-feather="bookmark"></i>
										</button>
										<button class="btn btn-blue sb-btn-icon">
											<i data-feather="share"></i>
										</button>
									</div>
								</div>
								<div class="card-body">
									<form action="" class="d-none" id="show-form">
										<div class="row" >
                                            <div class="col-md-4">
                                                <label for="" class="font-weight-bold">Course Name</label>
                                                <input type="text"  class="form-control" v-model="form.name">
                                            </div>
                                            <div class="col-md-5">
                                            <label for="" class="font-weight-bold">Department</label>
                                                <select name="" id="" class="form-control" v-model="form.dept">
                                                    <option value="Computer Science">Computer Science</option>
                                                    <option value="Mass Communication">Mass Communication</option>
                                                    <option value="BioChemisty">BioChemisty</option>
                                                    <option value="Chemistry">Chemistry</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="font-weight-bold">Duration <small class="text-primary font-weight-bold">(in Minutes)</small></label>
                                                <input type="text"  class="form-control" v-model="form.time">
                                            </div>
										</div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <button @click="saveCourse" type="button" class="btn btn-primary btn-block">
                                                    {{ loading ? 'SUBMITTING' : 'SUBMIT'  }}
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-success" v-if="successMessage != ''">{{ successMessage }}</p>
                                                <p class="text-danger" v-if="failedMessage != ''">{{ failedMessage }}</p>
                                            </div>
                                        </div>  
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="card mb-4">

					</div>
				</div>
			</main>
			<?php include '../includes/footer.php'; ?>
		</div>
	</div>


	<script src="/js/jquery.js" crossorigin="anonymous"></script>
	<script src="/js/boostrap.js" crossorigin="anonymous"></script>
	<script src="/js/scripts.js"></script>
	<script src="/js/sweet-alert.js"></script>
	<script src="/js/polyfill.js"></script>
	<script src="/js/axios.js"></script>
	<script src="/js/vue.js"></script>
	<script>
		const vue = new Vue({
			el: "#app",
			data: {
				loading: false,
                form: {
                    name:'',
                    dept:'',
                    time:''
                },
                successMessage:"",
                failedMessage:""
			},
			methods: {
                async saveCourse() {
                    this.loading = true;
                    this.successMessage = ""
                    this.failedMessage = ""
                    await axios.post("/api/store-course.php", this.form)
                    .then((res) => {
                        this.loading = false
                        this.successMessage = res.data.success
                        setTimeout(() => {
                            location.href = "/admin/courses.php";
                        }, 2000);
                    })
                    .catch((e) => {
						this.failedMessage = res.data.success
                    })
                },
			},
			mounted() {
                setTimeout(() => {
                    $("#show-form").removeClass("d-none");
                }, 500);
			},
            watch: {
                selectedAnswer(value){
                   if (value == 1) 
                       this.form.correct = this.form.choice1
                   else if (value == 2)
                       this.form.correct = this.form.choice2
                   else if (value == 3)
                       this.form.correct = this.form.choice3
                   else if (value == 4)
                       this.form.correct = this.form.choice4
                }
            }
		});

	</script>
</body>

</html>

<?php } ?>
