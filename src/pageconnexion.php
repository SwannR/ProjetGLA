<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projet', 'root','root');
?>
<?php
if(isset($_POST["send"])){
$login = htmlspecialchars($_POST['login']);
$motdepasse = sha1($_POST['motdepasse']);
$rep = $bdd->prepare("SELECT * FROM Organisateur WHERE login = ? and motdepasse = ? ");
$rep->execute(array($login,$motdepasse));
$existe =$rep->rowCount();
if($existe == 1){
$_SESSION["login"]=$login;
header("location:pagesommaire.php");            
 } else { 
     		echo ' <div id="con2"> <font color="red">Login et/ou mot de passe incorrecte ou compte inexistant</font> </br> <a href="pageinscription.php">Pas encore de compte ?</a> </div>' ;} 
     }
     ?>






<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="style.css" />

<title>Connexion</title>
</head>


<body>


<video  playsinline autoplay muted loop>


<source src="projet.mp4" type="video/mp4">
</video>


<img src="logo.png" width="300" height="300">




<div id="con">


<form name="connexion" method="post" action=" ">


<label>Login:<br/> <input type="text" name="login"size="50" style="height:25px;"/></label><br/>
<label>Mot de passe: <input type="password" name="motdepasse"size="50" style="height:25px;"/></label><br/>

<input type="submit" name="send" value="Connexion"> 
</form>

</div>





</body>

</html>