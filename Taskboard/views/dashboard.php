<?php


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
		/>
		<link rel="stylesheet" href="./views/css/style.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Dashboard</title>
	</head>
	<body>
		<!-- Navbar -->
		<nav class="navbar bg-body-tertiary">
			<div class="container justify-content-between ">
				<a class="navbar-brand" href="#">
					<img src="./views/img/logo.png" alt="logo" width="100" />
				</a>
				<?php if(isset($_SESSION['userId'])):?>
				<div class="d-flex align-items-center">
					<p class="m-0 fw-bold me-2">Hi <?php echo $_SESSION['userName'];?></p>
					<a href="logout">
						<button class="secondary-btn">logout</button>
					</a>
				</div>
				<?php endif;?>
			</div>
		</nav>
		<!-- Add and search -->
		<section class="mt-5">
			<div class="container d-flex justify-content-between align-items-center">
				<div>
					<input class="me-2" type="text" placeholder="Search" id="search"/>
				</div>
				<div>
					<button
						type="button"
						class="primery-btn open"
					>
						Add Task
					</button>
				</div>
			</div>
		</section>

		<!-- Add form pop Up -->
		<section class="position-fixed w-100 h-100 bg-transparent align-items-center justify-content-center" style="top: 0;left: 0;z-index: 100;display:none;" id="add">
			<div class="position-absolute w-100 h-100 close" style="z-index: 10;background-color:#5757578f;">
			</div>
			<div class="bg-light position-relative p-2 rounded pop" style="width: 500px;z-index: 12;">
					<form>
						<div class="mb-3">
							<label class="col-form-label">N° of Tasks to add</label>
							<input type="number" class="form-control" name="num" id="num"/>
						</div>
						<!-- container of forms created by javascript -->
						<div id="form">
						</div>
						<div class="text-end">
							<button type="button" class="secondary-btn close">
								Close
							</button>
							<button type="button" class="main-btn"  id="create">Create</button>
						</div>
					</form>
				</div>
		</section>

		<!-- Edit form pop Up -->
		<section class="position-fixed w-100 h-100 bg-transparent align-items-center justify-content-center" style="top: 0;left: 0;z-index: 100;display:none;" id="edit">
			<div class="position-absolute w-100 h-100 cancle" style="z-index: 10;background-color:#5757578f;">
			</div>
			<div class="bg-light position-relative p-2 rounded pop" style="width: 500px;z-index: 12;">
				<form>
					<div class="mb-3">
						<label class="col-form-label">Task</label>
						<input type="text" class="form-control" name="task"/>
					</div>
					<div class="mb-3">
						<labe class="col-form-label">Deadline</labe>
						<input type="date" class="form-control" name="deadline"/>
					</div>
					<div class="mb-3">
						<labe class="col-form-label">Status</labe>
						<select class="form-select" name="status">
							<option selected value="">Open this select menu</option>
							<option value="to do">To do</option>
							<option value="in progress">In progress</option>
							<option value="done">Done</option>
						</select>
					</div>
					<div class="text-end">
						<button type="button" class="secondary-btn cancle">
							Close
						</button>
						<button type="button" class="main-btn" id="update">Update</button>
					</div>
				</form>
			</div>
			<!-- <div id="check"></div>  -->
		</section>
		
		<!-- Task status -->
		<section class="mt-5 p-2">
			<div class="container">
				<div class="row gap-3 align-items-start">
					<div class="task-card col-lg col-md-12 p-3 rounded-1" >
            <div class="d-flex justify-content-between align-items-center mb-5">
              <h6 class="m-0">To do <span id="tdnum"></span></h6>
              <button class="toggel border-0">-</button>
            </div>
						<div id="todo">
							
						</div>
					</div>

					<div class="task-card col-lg col-md-12 p-3 rounded-1">
						<div class="d-flex justify-content-between align-items-center mb-5">
              <h6 class="m-0">In progress <span id="ipnum"></span></h6>
              <button class="toggel border-0">-</button>
            </div>
						<div id="progress">
							
						</div>
					</div>

					<div class="task-card col-lg p-3 rounded-1">
            <div class="d-flex justify-content-between align-items-center mb-5">
              <h6 class="m-0">Done <span id="dnum"></span></h6>
              <button class="toggel border-0">-</button>
            </div>
						<div id="done">
							
						</div>
					</div>

				</div>
			</div>
		</section>
		<input type="hidden" value="<?php echo $_SESSION['userId'];?>" id="userId">
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
			crossorigin="anonymous"
		></script>
    <script src="./views/js/main.js"></script>
		
	</body>
</html>
