<?php
 include("Commun/Header.php");
 ?>
</head>

<body>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="traitementinscription.php" method="post">
				<h1>Creer un compte</h1>
				<div class="social-container">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-google-plus-g"></i></a>
					<a href="#"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>Utiliser compte gmail</span>
				<label for="nom"></label>
				<input type="text" name="nom" placeholder="nom" $pattern = '/[A-Za-z0-9\x{00c0}-\x{00ff}]{5,20}/u'>
				<label for="email"></label>
				<input type="email" name="mail" placeholder="email">
				<input type="password" name="password" id="" pattern="[A-Za-z0-9_$]{8,}">
				<input type="submit" value="Creer le compte">
				<!-- <button>Creer le compte</button> -->
			</form>
		</div>
		<div class="form-container login-container">
			<form action="connexion.php" method="post">
				<h1>Se connecter</h1>
				<div class="social-container">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-google-plus-g"></i></a>
					<a href="#"><i class="fab fa-linkedin-in"></i></a>
				</div>
				<span>Je n'ai pas de compte</span>
				<input type="email" name="mail" placeholder="Email">
				<input type="password" name="password" placeholder="Mot de passe">
				<a href="forgot.php">Forgot your password?</a>
				<button>Se connecter</button>
			</form>
		</div>

		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Lorem ipsum dolor sit amet consectetur.</h1>
					<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
					<button class="ghost" id="login">Se connecter</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Lorem ipsum dolor sit amet consectetur.</h1>
					<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. </p>
					<button class="ghost" id="signUp">Creer un compte</button>
				</div>
			</div>
		</div>
	</div>

	<script src="script.js" charset="utf-8"></script>
    <?php
 include"Commun/footer.php";
 ?>
