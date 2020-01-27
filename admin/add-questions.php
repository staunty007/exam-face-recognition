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
								<span>Add Questions</span>
							</h1>
						</div>
					</div>
				</div>
				<div class="container-fluid mt-n10">
					<div class="row" style="margin-top: 120px;">
						<div class="col-md-10">
							<div class="card sb-card-header-actions mx-auto">
								<div class="card-header text-uppercase">
									Add Question
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
									<form action="">
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
                                                    <input type="hidden" name="" id="quest-id" value="<?php echo $_GET['cusId']; ?>">
													<label for="" class="font-weight-bold">Courses</label>
                                                    <select class="form-control" v-model="form.course_id">
														<option :value="course.code" v-for="course in courses" :key="course.id">{{ course.name }}</option>
													</select>
												</div>
											</div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold">Code</label>
                                                    <input type="text" readonly class="form-control" v-model="form.qcode">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="font-weight-bold">Mark for Question</label>
                                                <input type="number" min="1" class="form-control" v-model="form.marks">
                                            </div>
										</div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-row">
                                                    <label for="" class="font-weight-bold">Question</label>
                                                    <input type="text" class="form-control" v-model="form.question">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-5">
                                                <label for="" class="font-weight-bold">Choice 1</label>
                                                <input type="text" class="form-control" v-model="form.choice1">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="" class="font-weight-bold">Choice 2</label>
                                                <input type="text" class="form-control" v-model="form.choice2">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-5">
                                                <label for="" class="font-weight-bold">Choice 3</label>
                                                <input type="text" class="form-control" v-model="form.choice3">
                                            </div>
                                            <div class="col-md-5">
                                                <label for="" class="font-weight-bold">Choice 4</label>
                                                <input type="text" class="form-control" v-model="form.choice4">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="" class="font-weight-bold">Correct Answer</label>
                                                <select name="" id="" class="form-control" v-model="selectedAnswer">
                                                    <option value="1">Choice 1</option>
                                                    <option value="2">Choice 2</option>
                                                    <option value="3">Choice 3</option>
                                                    <option value="4">Choice 4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-3">
                                                <button @click="storeQuestion" type="button" class="btn btn-primary btn-block">
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
				showCourses: false,
				courses: [],
                selectedAnswer:"",
                quest_id:"",
                form: {
                    course_id:0,
                    qcode: 0,
                    question:"",
                    choice1:"",
                    choice2:"",
                    choice3:"",
                    choice4:"",
                    correct:"",
                    marks:"",
                },
                successMessage:"",
                failedMessage:""
			},
			methods: {
				async fetchGrades() {
					await axios.get("/api/all-courses.php")
						.then((res) => {
							this.courses = res.data;
							this.showCourses = true;
							$("#show-table").removeClass("d-none");
						})
						.catch((e) => {
							console.log(e)
						})
				},
                async storeQuestion() {
                    this.loading = true;
                    this.successMessage = ""
                    this.failedMessage = ""
                    await axios.post("/api/store-question.php", this.form)
                    .then((res) => {
                        this.loading = false
                        this.successMessage = res.data.success
                        location.href = "/admin/courses.php";
                    })
                    .catch((e) => {
						this.failedMessage = res.data.success
                    })
                }
			},
			mounted() {
				this.fetchGrades();
                console.log(this.quest_id);
                setTimeout(() => {
                    let id = $("#quest-id").val();
                    this.form.course_id = id ? id : "";
                    this.form.qcode =  parseInt(this.form.course_id) * 15;
                }, 3000);
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
