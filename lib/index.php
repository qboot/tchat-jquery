<?php

session_start();

?>

<!DOCTYPE html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tchat JQuery - Quentin Brunet</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="You want a new way to interact with your friends ? You're tired of Facebook, Google and these big multinationals? Come chat here!" />
	<meta name="author" content="Quentin Brunet" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

    <!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Perso -->
	<link rel="stylesheet" href="css/perso.css">
	<link type="text/css" rel="stylesheet" href="assets/css/style.css" />

	</head>
	<body>
	
	<div id="fh5co-wrap">
		<header id="fh5co-header">
			<div class="container">
				<nav class="fh5co-main-nav">
					<ul>
						<li class="fh5co-active"><a href="#scrollHere"><span>Commencer à tchatter</span></a></li>
					</ul>
				</nav>
			</div>
		</header>

		<div class="fh5co-hero">
			<div id="video-fond">
				<video width="400" height="400" autoplay loop>
					  <source src="videos/bck.mp4" type="video/mp4" />
				</video>
			</div>
			
			
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
						<div class="fh5co-intro fh5co-table-cell">
							<h1 class="text-center" style="font-weight:400; font-size:90px;">Tchat JQuery</h1>
							<p>Fait avec amour par Quentin Brunet</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="fh5co-section" style="background: white;">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<h2>Les 5 bénéfices du tchat communautaire</h2>
						<p style="font-size: 18px">
                            Pour beaucoup de visiteurs, l’un des premiers freins à l’achat en ligne est le manque de fiabilité : des sites trop chargés visuellement, peu ergonomiques, des informations difficilement accessibles, des images trop petites, etc. Il est essentiel de travailler sur ces données et d’intégrer des éléments de réassurance. Le tchat communautaire est un excellent moyen de remettre de l’humain sur votre site et de rassurer vos visiteurs en leur montrant que d’autres visiteurs sont présents, connaissent et recommandent votre site en temps réel. Vous faites ainsi preuve de transparence vis-à-vis de vos visiteurs et votre site gagne en fiabilité.
                        </p>
					</div>
					<div class="col-md-7">
						<video class="vidSpecial" width="400" height="400" controls>
							  <source src="videos/bck.mp4" type="video/mp4" />
						</video>
					</div>
				</div>
			</div>
		</div>

		<div class="fh5co-parallax" style="background-image: url(images/hero_2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0 text-center fh5co-table">
						<div class="fh5co-intro fh5co-table-cell">
							<h1 class="text-center" style="font-size:60px;">À vos marques... Prêts ? Tchattez !</h1>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="scrollHere" class="fh5co-section" style="height: 1000px;">
			<div id="tchat-wrap">
				<div id="login"></div>
				<div id="register"></div>
				<div id="tchat"></div>
			</div>
		</div>

	</div> <!-- END fh5co-wrap -->


	<footer id="fh5co-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12 fh5co-copyright text-center">
					<p><small>&copy; 2016 Quentin Brunet. Tous droits réservés. </small></p>
				</div>
			</div>
		</div>
	</footer>
	
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

