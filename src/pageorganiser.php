<?php
session_start();
?>





<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<link rel="stylesheet" href="style.css" />
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<title>J'organise</title>






<script>




function changement1(param)     
{

  
  var tab = ["inv1","inv2","inv3","inv4","inv5",]; 

  
 if(param==0) { 
 document.getElementById(tab[param]).style.display="block";
  document.getElementById(tab[1]).style.display="none";
  document.getElementById(tab[2]).style.display="none";
  document.getElementById(tab[3]).style.display="none";
   document.getElementById(tab[4]).style.display="none"; }
   
   
  if(param==1) {
   document.getElementById(tab[0]).style.display="block";
  document.getElementById(tab[param]).style.display="block";
  document.getElementById(tab[2]).style.display="none";
  document.getElementById(tab[3]).style.display="none";
   document.getElementById(tab[4]).style.display="none"; }
   
   
   
   
 if(param==2){
document.getElementById(tab[0]).style.display="block";
  document.getElementById(tab[1]).style.display="block";
  document.getElementById(tab[param]).style.display="block";
  document.getElementById(tab[3]).style.display="none";
   document.getElementById(tab[4]).style.display="none"; }
   


 if(param==3){

document.getElementById(tab[0]).style.display="block";
  document.getElementById(tab[1]).style.display="block";
  document.getElementById(tab[2]).style.display="block";
  document.getElementById(tab[param]).style.display="block";
   document.getElementById(tab[4]).style.display="none"; }
   
  if(param==4) {
document.getElementById(tab[0]).style.display="block";
  document.getElementById(tab[1]).style.display="block";
  document.getElementById(tab[2]).style.display="block";
  document.getElementById(tab[3]).style.display="block";
   document.getElementById(tab[param]).style.display="block"; }
   }









</script>









</head>


<body >


<video  playsinline autoplay muted loop>
<source src="projet.mp4" type="video/mp4">
</video>






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
  initializeAutocomplete('invv1');
});

</script> 

<script > 


google.maps.event.addDomListener(window, 'load', function() {
  initializeAutocomplete('invv2');
});

</script> 

<script > 


google.maps.event.addDomListener(window, 'load', function() {
  initializeAutocomplete('invv3');
});

</script> 

<script > 


google.maps.event.addDomListener(window, 'load', function() {
  initializeAutocomplete('invv4');
});

</script> 


<script > 


google.maps.event.addDomListener(window, 'load', function() {
  initializeAutocomplete('invv5');
});

</script> 














<div id="ins">


<form action = "pageaction.php" method="post">
<label>Nom de ma sortie :<input type="text" name="nomsortie"size="50" style="height:25px"/> </label><br/>
<label>Date : <br/> <input type="date" name="date"size="50" style="height:25px;"/></label><br/></br>
<label>Moyen de transport :<br/><select name="transport">
	<option value="driving">En voiture</option> 
    <option value="walking">A pied</option>
    <option value="bicycling">En velo</option>
    <option value="transit">En transport en commun</option> </select> <br/> <br/>
    <br/><label>Préférence alimentaire du groupe : <br/><select name="preference">
    
    <option value="food">Pas de préférence</option>
    <option value="burger">Burger</option>
    <option value="kebab">Kebab</option>
    <option value="vegetarian">Végétarien</option> 
     <option value="pizza">Pizza</option> 
    <option value="japonais">Japonais</option>
    <option value="chinois">Chinois</option>
    </select> <br/> <br/>
    


</div>



<div id="nbinvité">



Ton nombre d'invité : <br/>

1 <input type="radio"  name="nb" value="1" onchange="changement1(0);" />

2<input type="radio" name="nb" value="2" onchange="changement1(1);"/>

3<input type="radio"  name="nb" value="3" onchange="changement1(2);"/>
 
 4<input type="radio"  name="nb" value="4" onchange="changement1(3);"/>

 


</div>








<div id="inv1" style="display:none;">



<label>Adresse de ton invité 1: <br/> <input id="invv1" type="text" name="adresseinv1"size="50" style="height:25px;"/></label><br/>


 <br/>

 


</div>


<div id="inv2" style="display:none;">



<label>Adresse de ton invité 2: <br/> <input id="invv2" type="text" name="adresseinv2"size="50" style="height:25px;"/></label><br/>


</div>


<div id="inv3" style="display:none;">



<label>Adresse de ton invité 3: <br/> <input id="invv3" type="text" name="adresseinv3"size="50" style="height:25px;"/></label><br/>



</div>

<div id="inv4" style="display:none;">



<label>Adresse de ton invité 4: <br/> <input id="invv4" type="text" name="adresseinv4"size="50" style="height:25px;"/></label><br/>

  


</div>


  


</div>





<div id="lieu1" >


<label> Premier lieu où aller :<br/><select name="lieu1">
    <option value="bar">Bar</option> 
    <option value="food">Restaurant</option>
   
     <option value="movie_threater">Cinema</option>
    <option value="bowling_alley">Bowling</option>
    <option value="night_club">Boite de nuit</option> 
     <option value="casino">Casino</option>
    <option value="park">Parc</option>
   </select> <br/>
   
   </div>
   
   
   
  <div id="lieu2" > 
    
<label> Deuxième lieu où aller :<br/><select name="lieu2">     
  <option value="bar">Bar</option> 
    <option value="food">Restaurant</option>
   
     <option value="movie_threater">Cinema</option>
    <option value="bowling_alley">Bowling</option>
    <option value="night_club">Boite de nuit</option> 
     <option value="casino">Casino</option>
    <option value="park">Parc</option>
   
      </select> <br/>
      
      
     </div> 
      
      
      
     <div id="lieu3" > 
      
<label> Troisième lieu où aller :<br/><select name="lieu3">
     <option value="bar">Bar</option> 
    <option value="food">Restaurant</option>
    
     <option value="movie_threater">Cinema</option>
    <option value="bowling_alley">Bowling</option>
    <option value="night_club">Boite de nuit</option> 
     <option value="casino">Casino</option>
    <option value="park">Parc</option>
    </select> <br/>
    
    </div>
    
    
    
   
   <div id="confirmation"> 

<input type="submit" name="affichersortie"  class="btn btn-default" value="Afficher ma sortie final" > 

</div>

</form>


</body>



</html>
