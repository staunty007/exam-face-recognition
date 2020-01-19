<div id="layoutSidenav_nav">
	<nav class="sb-sidenav sb-shadow-right sb-sidenav-dark">
		<div class="sb-sidenav-menu">
			<div class="nav accordion" id="accordionSidenav">
				<div class="sb-sidenav-menu-heading"></div>
				<a class="nav-link" href="/dashboard.php">
					<div class="sb-nav-link-icon"><i data-feather="activity"></i></div>
					Dashboard
				</a>
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
					aria-expanded="false" aria-controls="collapseLayouts">
					<div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
					Exams
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLayouts" data-parent="#accordionSidenav">
					<nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
						<a class="nav-link" href="/exams/index.php">Available</a><a class="nav-link" href="#">Upcoming</a><a
							class="nav-link" href="#">Cancelled</a>
					</nav>
				</div>
				<a class="nav-link collapsed d-none" href="#" data-toggle="collapse" data-target="#collapseLayouts2"
					aria-expanded="false" aria-controls="collapseLayouts2">
					<div class="sb-nav-link-icon"><i data-feather="layout"></i></div>
					Courses
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="collapseLayouts2" data-parent="#accordionSidenav">
					<nav class="sb-sidenav-menu-nested nav accordion" id="accordionSidenavLayout">
						<a class="nav-link" href="exam.php?course=2345">DIGITAL ELCTRONICS</a>
						<a class="nav-link" href="#">OPERATING SYSTEM</a>
						<a class="nav-link" href="#">APPICATION PACKAGE</a>
					</nav>
				</div>

				<a class="nav-link" href="#">
					<div class="sb-nav-link-icon"><i data-feather="user"></i></div>
					Profile
				</a>
				<a class="nav-link" href="logout.php">
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
