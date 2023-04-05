<?php
require('database.php');
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./style.css">
		<title>Student Login</title>
	</head>

	<body>
		<div class="centered">

			<h1 class="main-title">Student Login</h1>
			<div class="login-container">
				<form action="./login.php?type=student" method="POST" id="login-form">
					<input type="text" name="email" id="email" placeholder="test@example.com" />
					<input type="password" name="password" id="password" placeholder="********" />

					<button type="submit" name="submitBtn" id="login-btn">Log in</button>


				</form>

				<div class="popup-overlay" id="popup-overlay">
					<div class="popup">
						<ul id="validation-errors"></ul>
						<?php
						if(isset($_GET['error'])){
							$error = $_GET['error'];
						echo '<li style="color: red;">Invalid credentials provided.</li>';
						}
						?>
					</div>
				</div>

				<script>
					const loginForm = document.getElementById("login-form");
					const emailInput = document.getElementById("email");
					const passwordInput = document.getElementById("password");
					const loginBtn = document.getElementById("login-btn");
					const popupOverlay = document.getElementById("popup-overlay");
					const validationErrors = document.getElementById("validation-errors");

					loginForm.addEventListener("submit", function (event) {
						event.preventDefault();
						validationErrors.innerHTML = "";
						let errors = [];

						// Validate email
						if (!emailInput.value) {
							errors.push("Email field is required");
						} else if (!isValidEmail(emailInput.value)) {
							errors.push("Invalid email format");
						}

						// Validate password
						if (!passwordInput.value) {
							errors.push("Password field is required");
						}

						// If there are errors, show popup with error messages
						if (errors.length > 0) {
							for (let i = 0; i < errors.length; i++) {
								let errorItem = document.createElement("li");
								errorItem.textContent = errors[i];
								errorItem.style.color = "red";
								validationErrors.appendChild(errorItem);
							}
							popupOverlay.style.display = "flex";
						} else {
							// Submit the form if there are no errors
							document.getElementById("login-form").submit();
						}
					});

					function isValidEmail(email) {
						const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
						return emailRegex.test(email);
					}
				</script>
			</div>
		</div>


	</body>

</html>
