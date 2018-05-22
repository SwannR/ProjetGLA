<?php
session_start();
?>






<!DOCTYPE html>
<html>




<head>
<meta charset="UTF-8">

 <link rel="stylesheet" href="style.css" />

<title>Accueil</title>
</head>
<body>
<video  playsinline autoplay muted loop>


<source src="projet.mp4" type="video/mp4">
</video>


<div id="logosommaire">
<img src="logo.png" width="200" height="300">
</div>


<div id="accueil">

<p> &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hey <?php echo htmlentities(trim($_SESSION['login'])); ?> ! </br>
<br>




<button onclick="window.open('pageorganiser.php')" > Organiser ma sortie </button>
<button onclick="window.open('suggestiondesortie.html')" > Suggestions de sorties </button>

<button onclick="window.open('pagelieu.php')"> Voir des lieux </button>

<button onclick="window.open('deconnection.php')"> Déconnection </button>
</div>

<div id="calendrier">


<iframe name="InlineFrame1" id="InlineFrame1" style="width:180px;height:220px;" src="https://www.mathieuweb.fr/calendrier/calendrier-des-semaines.php?nb_mois=1&nb_mois_ligne=4&mois=&an=&langue=fr&texte_color=B9CBDD&week_color=DAE9F8&week_end_color=C7DAED&police_color=453413&sel=true" scrolling="no" frameborder="0" allowtransparency="true"></iframe>





</div>


<div id="meteo" > <div id="cont_NzUwNTZ8NXwzfDR8MXxGOEEwQzJ8MTB8RkZGRkZGfGN8MQ--"><div id="spa_NzUwNTZ8NXwzfDR8MXxGOEEwQzJ8MTB8RkZGRkZGfGN8MQ--"><a id="a_NzUwNTZ8NXwzfDR8MXxGOEEwQzJ8MTB8RkZGRkZGfGN8MQ--" href="http://www.meteocity.com/france/paris_v75056/" target="_blank" style="color:#333;text-decoration:none;">Météo Paris</a> ©<a href="http://www.meteocity.com">meteocity.com</a></div><script type="text/javascript" src="http://widget.meteocity.com/js/NzUwNTZ8NXwzfDR8MXxGOEEwQzJ8MTB8RkZGRkZGfGN8MQ--"></script></div>
</div>




<footer>
				
					
					<p>Copyright 2018 &copy; Dys&Friends Tous droits réservés.</p>
					
					<p>Nous contacter: <a href="mailto:dysandfriends@outlook.com">dysandfriends@outlook.com</a>.</p>
				</div>
				
				

				
	</footer>



</body>
</html>