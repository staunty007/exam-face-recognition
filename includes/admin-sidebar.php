<div id="layoutSidenav_nav">
	<nav class="sb-sidenav sb-shadow-right sb-sidenav-dark">
		<div class="sb-sidenav-menu">
			<div class="nav accordion" id="accordionSidenav">
				<div class="sb-sidenav-menu-heading"></div>
				<a class="nav-link" href="/admin/dashboard.php">
					<div class="sb-nav-link-icon"><i data-feather="activity"></i></div>
					Dashboard
				</a>

				<a class="nav-link" href="/admin/students.php">
					<div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
					Students
				</a>
				<a class="nav-link" href="/admin/courses.php">
					<div class="sb-nav-link-icon"><i data-feather="user"></i></div>
					Courses
				</a>
				<a class="nav-link d-none" href="/admin/questions.php">
					<div class="sb-nav-link-icon"><i data-feather="user"></i></div>
					Questions
				</a>
				<a class="nav-link" href="/logout.php">
					<div class="sb-nav-link-icon"><i data-feather="power"></i></div>
					Logout
				</a>
			</div>
		</div>
		<div class="sb-sidenav-footer">
			<div>
				<div class="small">Logged in as:</div>
				<span class="text-white">
					<?php echo strtoupper($_SESSION['fullname']); ?>
				</span>
			</div>
		</div>
	</nav>
</div>
