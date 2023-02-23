		<header class="top-header">
			<nav class="navbar navbar-expand">
				<div class="left-topbar d-flex align-items-center">
					<a href="javascript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
					</a>
				</div>				
				<div class="right-topbar ml-auto">
					<ul class="navbar-nav">
						<li class="nav-item search-btn-mobile">
							<a class="nav-link position-relative" href="javascript:;">	<i class="bx bx-search vertical-align-middle"></i>
							</a>
						</li>
					
						<li class="nav-item dropdown dropdown-lg">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="javascript:;" data-toggle="dropdown">	<i class="bx bx-bell vertical-align-middle"></i>
								<span class="msg-count"><?php echo $notifications; ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="javascript:;">
									<div class="msg-header">
										<h6 class="msg-header-title"><?php echo $notifications; ?> New</h6>
										<p class="msg-header-subtitle">Application Notifications</p>
									</div>
								</a>
								<div class="header-notifications-list">
									<?php  
										if(!empty($notificationInfo))
										{
											foreach ($notificationInfo as $key => $value) {
												echo $value;
											}
										}

									?>
								</div>
								<a href="javascript:;">
									<div class="text-center msg-footer">View All Notifications</div>
								</a>
							</div>
						</li>
						<li class="nav-item dropdown dropdown-user-profile">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-toggle="dropdown">
								<div class="media user-box align-items-center">
									<div class="media-body user-info">
										<p class="user-name mb-0"><?php echo $_SESSION['fullname']; ?></p>
										<p class="designattion mb-0">Available</p>
									</div>
									<img src="assets/images/icons/<?php echo $_SESSION['image']; ?>" class="user-img" alt="user">
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">	
								<a class="dropdown-item" href="./user-profile.php">
									<i class="bx bx-user"></i><span>Profile</span>
								</a>
								<!--
								<a class="dropdown-item" href="javascript:;">
									<i class="bx bx-cog"></i><span>Settings</span>
								</a>
								<a class="dropdown-item" href="./index.php">
									<i class="bx bx-tachometer"></i><span>Dashboard</span>
								</a>
								-->
								<div class="dropdown-divider mb-0"></div>
								<a class="dropdown-item" href="logout.php">
									<i class="bx bx-power-off"></i><span>Logout</span>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>