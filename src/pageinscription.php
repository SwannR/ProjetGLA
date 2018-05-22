<?php

$bdd = new PDO('mysql:host=localhost;dbname=projet', 'root','root');

if(isset($_POST['forminscription'])) {

   $login = htmlspecialchars($_POST['login']);
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $adresse = htmlspecialchars($_POST['adresse']);
	$mail = htmlspecialchars($_POST['mail']);
   $motdepasse = sha1($_POST['motdepasse']);
   $motdepasse2 = sha1($_POST['motdepasse2']);
   
   
   
   
if(isset( $_POST['login'] , $_POST['nom'] , $_POST['prenom'] , $_POST['adresse'] , $_POST['mail'] , $_POST['motdepasse'] , $_POST['motdepasse2']) ) {
      if( !(empty($_POST['login']) OR empty($_POST['nom']) OR empty($_POST['prenom']) OR empty($_POST['adresse']) OR empty($_POST['mail']) OR empty($_POST['motdepasse']) OR empty($_POST['motdepasse2'])) ) {
      	
      	$motdepasselength = strlen($motdepasse);
      	$reqlogin = $bdd->prepare("SELECT * FROM Organisateur WHERE login = ?");
        $reqlogin->execute(array($login));
        $loginexist = $reqlogin->rowCount();
      		if($loginexist == 0) {
            		if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               			$reqmail = $bdd->prepare("SELECT * FROM Organisateur WHERE mail = ?");
               			$reqmail->execute(array($mail));
               			$mailexist = $reqmail->rowCount();
               					if($mailexist == 0) {
                  					if(strlen($_POST['motdepasse'])>=6) { 
                  						if($motdepasse == $motdepasse2) {
                     						$insertmembre = $bdd->prepare("INSERT INTO Organisateur (login, nom , prenom , adresse , mail, motdepasse) VALUES( ?, ?, ?, ?, ?,?)");
                     						$insertmembre->execute(array($login, $nom, $prenom, $adresse, $mail, $motdepasse));
                     						$erreur = "Votre compte a bien été créé ! ";
                 
                 ?>
<div class="message">Tu as bien été inscrit, tu peux dorénavant te connecter.<br />
<a href="pageconnexion.php">Se connecter</a></div>
<?php
                 
                 
                  } 
                 
                  else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
                  
               }  else {
                  $erreur = "Le mot de passe que vous avez entré contient moins de 6 caractères !"; 
                  
                  }
               
           }    else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         
      } else {
         $erreur = "Login déja utilisé!";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
 }  
}?>





<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="style.css" />

<title>Inscription</title>
</head>


<body>


<video  playsinline autoplay muted loop>
<source src="projet.mp4" type="video/mp4">
</video>


<img src="logo.png" width="300" height="300">




<script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyD8Nuz4nL8A4PCrtMVhrtSCMzhxdCfiFwE">
</script>


<script type="text/javascript" src="autocomplete.js"></script>



<script > 

 function initializeAutocomplete(id) {
  var element = document.getElementById(id);
  var options = {
   types: ['geocode'] ,
  componentRestrictions: {country: 'fr'}
};
  if (element) {
    var autocomplete = new google.maps.places.Autocomplete(element,options);
    google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
  }
}

</script> 

<script > 


google.maps.event.addDomListener(window, 'load', function() {
  initializeAutocomplete('user_input_autocomplete_address');
});

</script> 




<div id="ins">


<form action = "" method="post">
<label>Login:<br/> <input type="text" name="login"size="50" style="height:25px" value="<?php if(isset($_POST['login'])){echo htmlentities($_POST['login'], ENT_QUOTES, 'UTF-8');} ?> "/></label><br/>
<label>Nom :<br/><input type="text" name="nom"size="50" style="height:25px;" value="<?php if(isset($_POST['nom'])){echo htmlentities($_POST['nom'], ENT_QUOTES, 'UTF-8');} ?> "/></label><br/>
<label>Prénom: <input type="text" name="prenom"size="50" style="height:25px;" /></label><br/>
<label>Adresse: <input id="user_input_autocomplete_address"  type="text" name="adresse"  placeholder="Votre adresse..." size="50" style="height:25px;" /></label><br/>


<label>Adresse e-mail: <input type="text" name="mail" size="50" style="height:25px;"/></label><br/>
<label>Mot de passe: <input type="password" name="motdepasse" size="50" style="height:25px;"/></label><br/>
<label>Confirmation du mot de passe: <input type="password" name="motdepasse2"size="50" style="height:25px;"/></label><br/>

 <input type="submit" name="forminscription"  class="btn btn-default" value="Crée mon compte" > 
</form>

</div>


   <div align="center">
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
         
         
         
         
    
         
         
         </div>



</body>



</html>
