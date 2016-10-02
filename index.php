<?php

session_start();

?>

<!DOCTYPE html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Quentin Brunet | Tchat JQuery</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="[DEMO] Réalisation d'un tchat JQuery en temps réel (AJAX). Système de messagerie instantanée avec inscription, gestion du profil, du thème et bien d'autres fonctionnalités." />
	<meta name="author" content="Quentin Brunet" />

	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

    <!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Perso -->
	<link rel="stylesheet" href="css/perso.css">
	<link type="text/css" rel="stylesheet" href="assets/css/style.css" />

	</head>
	<body>
	
	<div id="scrollHere" class="fh5co-section">
		<div id="tchat-wrap">
			<div id="login"></div>
			<div id="register"></div>
			<div id="tchat"></div>
		</div>
	</div>
	
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<!-- PERSO -->
	<script>
        $('html, body').animate({
            scrollTop : 0
        },500);

		$(window).scroll(function(e){
			$('#video-fond').css({
				marginTop: $(window).scrollTop()
			});
		});
		
		$('.fh5co-active').click(function(e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop : $('#scrollHere').offset().top
			},1500);
			return false;
		});
		
	</script>
	<script src="assets/js/main.js"></script>
	</body>
</html>

