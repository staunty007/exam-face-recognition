<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link href="/css/styles.css" rel="stylesheet" />
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

<body>
	<h5 class="text-danger d-flex justify-content-center mt-1">Caution : Please dont move away from the window or
		Refresh . </h5>

	<div id="app">
		<div class="alert alert-primary" role="alert">
			<div class="row">
				<div class="col-md-4">
					<h5>Course: <span v-if="course">{{ course }}</span> </h5>
				</div>
				<div class="col-md-4 offset-md-4">
					<p class="font-weight-bold">Time Remaining  <span v-if="duration"> {{ examMinutes }} :
							{{ examSeconds }} </span></p>
					<input type="hidden" value="<?php echo $_GET['start'] ?>" id="q-code">
				</div>
			</div>
		</div>

		<div class="container">
			<div id="preload" class="" v-if="!showQuestions">
				<div class="d-flex justify-content-center">
					<button class="btn btn-primary btn-lg mt-5" @click="startExam = true" v-if="!startExam">START
						EXAM</button>
					<button class="btn btn-info btn-lg mt-5" @click="beginExam" v-if="startExam">BEGIN NOW</button>
				</div>
				<p class="text-dark text-center mt-5">Click Start and Question Begins</p>
			</div>
		</div>
		<main v-if="showQuestions">
			<div class="d-flex justify-content-center">
				<nav aria-label="...">
					<ul class="pagination">
						<li class="page-item page-link" v-for="exam in exams" :key="exam.id"
							@click="filterQuestion(exam.id)">
							{{ exam.id }}
						</li>
					</ul>
				</nav>
			</div>
			<div class="jumbotron row">
				<div class="col-md-8">
					<h5 class="text-primary">Question No {{ exam.id }} out of {{ exams ? exams.length : 0 }}</h5>
					<div class="">
						<div class="alert bg-gray-500 font-weight-bold" role="alert">
							{{ exam.question }}
						</div>
						<div class="ml-2" style="font-size: 20px;">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
									:value="exam.choice1" checked>
								<label class="form-check-label" for="exampleRadios1">
									{{ exam.choice1 }}
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
									:value="exam.choice2">
								<label class="form-check-label" for="exampleRadios2">
									{{ exam.choice2 }}
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
									:value="exam.choice3">
								<label class="form-check-label" for="exampleRadios3">
									{{ exam.choice3 }}
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
									:value="exam.choice4">
								<label class="form-check-label" for="exampleRadios4">
									{{ exam.choice4 }}
								</label>
							</div>
						</div>
					</div>
                    

				</div>
			</div>
		</main>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
	</script>
	<script src="/js/scripts.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="assets/demo/datatables-demo.js"></script>
	<script src="/js/axios.js"></script>
	<script src="/js/vue.js"></script>
	<script>
		const vue = new Vue({
			el: "#app",
			data: {
				startExam: false,
				showQuestions: false,
				qcode: 0,
				course: null,
				duration: null,
				exams: [],
				exam: {},
				examMinutes: 0,
				examSeconds: 0
			},
			methods: {
				beginExam() {
					this.fetchQuestions(this.qcode);
				},
				fetchQuestions(code) {
					const quest = `/api/questions.php?qcode=${code}`;
					axios.get(quest).then((res) => {
						this.course = res.data.course
						this.duration = parseInt(res.data.duration)
						this.exams = res.data.exam;
						console.log(res.data);
						this.showQuestions = true
						console.log(this.exams.length)
						this.exam = this.exams[0]
						this.countDown();
					})
				},
				filterQuestion(id) {
					this.exam = this.exams.filter(e => e.id == id)[0];
					console.log(this.exam)
				},
				countDown() {
					var deadline = new Date().getTime();
					var deadline = new Date(deadline + 10 * 60000);
					var that = this
					var x = setInterval(function () {
						var now = new Date().getTime();
						var t = deadline - now;
						var days = Math.floor(t / (1000 * 60 * 60 * 24));
						var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
						var seconds = Math.floor((t % (1000 * 60)) / 1000);

						if (t < 0) {
							this.endTest();
						}
						that.examMinutes = minutes
						that.examSeconds = seconds
					}, 1000);
				},
				endTest() {

				},
			},
			mounted() {
				const qcode = $("#q-code").val()
				this.qcode = qcode;
				console.log(qcode);
			}
		})

	</script>
</body>

</html>
