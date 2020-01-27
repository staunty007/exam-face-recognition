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

<body>
	<h5 class="text-danger d-flex justify-content-center mt-1">Caution : Please dont move away from the window or
		Refresh . </h5>

	<div class="d-none" id="app">
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
						<li class="page-item" v-for="(exam, index) in exams" :key="exam.id"
							@click="filterQuestion(exam.id)" :class="{ active: checkActive(exam.id) }">
                            <span class="page-link">
							{{ index + 1 }}
                                <span class="sr-only">(current)</span>
                            </span>
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
							<div class="form-check" @click="saveAnswer(exam.id, exam.choice1)">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
									:value="exam.choice1" :checked="exam.choice1 == exam.answer">
								<label class="form-check-label" for="exampleRadios1">
									{{ exam.choice1 }}
								</label>
							</div>
							<div class="form-check" @click="saveAnswer(exam.id, exam.choice2)">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2"
									:value="exam.choice2" :checked="exam.choice2 == exam.answer">
								<label class="form-check-label" for="exampleRadios2">
									{{ exam.choice2 }}
								</label>
							</div>
							<div class="form-check" @click="saveAnswer(exam.id, exam.choice3)">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3"
									:value="exam.choice3" :checked="exam.choice3 == exam.answer">
								<label class="form-check-label" for="exampleRadios3">
									{{ exam.choice3 }}
								</label>
							</div>
							<div class="form-check" @click="saveAnswer(exam.id, exam.choice4)">
								<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4"
									:value="exam.choice4" :checked="exam.choice4 == exam.answer">
								<label class="form-check-label" for="exampleRadios4">
									{{ exam.choice4 }}
								</label>
							</div>
						</div>
					</div>
                    
					<div class="row">
						<div class="col-md-4 offset-md-4 mt-3" v-if="!examSubmitted">
							<button :disabled="!allIsAnswered" class="btn btn-success btn-lg btn-block" type="button" @click="endTest">Submit Exam</button>
						</div>
						<div class="col-md-6 offset-md-4 mt-3" v-if="examSubmitted">
							<h3 class="text-success">Exam Submitted</h3>
						</div>
					</div>

				</div>
			</div>
		</main>
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
				startExam: false,
				showQuestions: false,
				examSubmitted: false,
				qcode: 0,
				course: null,
				duration: null,
				exams: [],
				exam: {},
				examMinutes: 0,
                examSeconds: 0,
				rec: [],
				allIsAnswered:false
			},
			methods: {
                saveAnswer(id, choice) {
                    const quest = this.exams.filter(e => e.id == id)[0];
                    quest.answer = choice;
					console.log(quest);
					this.checkAllAnswered()

                },
                checkActive(id){
                    const quest = this.exams.filter(e => e.id == id)[0];
                    if (quest.answer.trim() == "") {
                        return false;
                    } else {
                        return true;
                    }
				},
				checkAllAnswered(){
					const check = this.exams.every(o => o.answer !== "")
					if (check == true) {
						this.allIsAnswered = true
					}
				},
				beginExam() {
					this.fetchQuestions(this.qcode);
				},
				fetchQuestions(code) {
                    const quest = `/api/questions.php?qcode=${code}`;
                    
					axios.get(quest).then((res) => {
						this.course = res.data.course
						this.duration = parseInt(res.data.duration)
                        this.exams = res.data.exam;
                        
                        const newData = [];
                        this.exams.forEach(e => {
                            Object.keys(e).forEach(key => {
                                e['answer'] = "";
                            });
                            newData.push(e);
                        });
						//console.log(res.data);
						this.showQuestions = true
						//console.log(this.exams.length)
						this.exam = this.exams[0]
                        this.countDown();
                        let index = 0;
                        for (let index = 0; index < 5; index++) {
                            let name = `Johnson-${index}`;
                            this.$set(this.rec, index , name);
                            
                        }
					})
				},
				filterQuestion(id) {
					this.exam = this.exams.filter(e => e.id == id)[0];
					console.log(this.exam)
				},
				countDown() {
					var deadline = new Date().getTime();
					var deadline = new Date(deadline + this.duration * 60000);
					var that = this
					var x = setInterval(function () {
						var now = new Date().getTime();
						var t = deadline - now;
						var days = Math.floor(t / (1000 * 60 * 60 * 24));
						var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
						var seconds = Math.floor((t % (1000 * 60)) / 1000);

						if (t < 0) {
							that.endTest();
							clearInterval(x)
						}
						that.examMinutes = minutes
						that.examSeconds = seconds
					}, 1000);
				},
				endTest() {
					axios.post("/api/store-exam.php", this.exams)
					.then((res) => {
						this.examSubmitted = true;
						Swal.fire(
							'Exam Completed',
							'Check your Grades...!',
							'success'
						)
						setTimeout(() => {
							window.close()
						}, 1000);
						//res.data = 
					}).catch((e) => {
						console.log(e);
					})
				},
			},
			mounted() {
				const qcode = $("#q-code").val()
				this.qcode = qcode;
				console.log(qcode);
				setTimeout(() => {
					$("#app").removeClass("d-none");
				}, 500);
                
			}
		})

	</script>
</body>

</html>
