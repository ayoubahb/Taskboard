<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./views/css/home_style.css" />
		<link href="https://fonts.cdnfonts.com/css/blanka" rel="stylesheet" />
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
		/>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
			crossorigin="anonymous"
		/>
		<title>PLAN A</title>
	</head>
	<body>
		<!-- login and regester form -->
		<section
			id="login"
			class="bg-transparent text-black position-fixed w-100 h-100 justify-content-center align-items-center"
			style="z-index: 100; display: none"
		>
			<div class="form-box position-relative">
				<i
					id="closePop"
					class="bi bi-x-circle-fill position-absolute top-0 end-0 me-2 mt-1"
					style="font-size: 20px"
				></i>
				<div class="btn-field">
					<button type="button" id="loginBtn">Login</button>
					<button type="button" class="disable" id="registerBtn">
						Register
					</button>
				</div>
				<h2 id="title">Login</h2>
				<form action="auto-reg" method="post">
          <input type="hidden" name="type" value="login" id="type">
					<div class="input-field" id="nameField">
						<i class="bi bi-person-fill"></i>
						<input type="text" placeholder="Username" name="username"/>
					</div>

					<div class="input-field">
						<i class="bi bi-envelope"></i>
						<input type="email" placeholder="Email" name="email"required/>
					</div>

					<div class="input-field">
						<i class="bi bi-lock-fill"></i>
						<input type="password" placeholder="Password" name="password"required/>
					</div>
					<button
						type="submit"
            name="submit"
						class="w-100 getstart rounded-5 border-0 bg-black text-light fs-5"
					>
						Submit
					</button>
				</form>
			</div>
		</section>
		<nav class="navbar bg-transparent">
			<div class="container align-items-end">
				<a class="navbar-brand" href="#">
					<img src="./views/img/logo2.png" alt="Logo PLAN A" width="150px" />
				</a>
				<button type="button" class="main-btn openLogin">LOGIN</button>
			</div>
		</nav>

		<section class="main">
			<div
				class="container w-100 h-100 d-flex justify-content-lg-between justify-content-center align-items-center position-relative"
			>
				<?php include('./views/includes/alerts.php') ?>
				<div
					id="cont"
					class="d-flex flex-column align-items-center align-items-lg-start"
				>
					<h1>Plan A</h1>
					<p class="fs-3">Faster, more accurate, closer to your goal</p>
					<button class="main-btn getstart fs-4 openLogin">Get started</button>
				</div>
				<div class="d-none d-lg-block">
					<img src="./views/img/Lo-fi concept-cuate.png" alt="A person working on his laptop"/>
				</div>
			</div>
		</section>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
			crossorigin="anonymous"
		></script>
    <script src="./views/js/home.js"></script>

	</body>
</html>