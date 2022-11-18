<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>moktarba - blog de présentation</title>
  <meta name="description" content="">

  <meta name="viewport" content="width=device-width">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/main.css">
  <body>
    <div id="wrap">
  	<nav>
  		<div id="menu">
  			<ul>
  				<a href="../portfolio/index.html"><li>moktarba</li></a>
  				<a href="../portfolio/index.html"><li>portfolio</li></a>
  				<a href="contact.php"><li>contact</li></a>

  			</ul>
  			<ul id="reseaux">
  				<?php if (USER::auth()): ?>
            <a href="login.php?logout"><li>Déconnexion</li></a>
            <a href="compte.php"><li>Mon compte</li></a>
            <a><li>Bonjour <?php echo $_SESSION['user']['username'] ?></li></a>
        <?php else: ?>
            <a href="login.php"><li>se connecter</li></a>
            <a href="signup.php"><li>s'inscrire</li></a>
          <?php endif ?>
  			</ul>
  		</div>
  		<div id="search">
  			<form id="searchform" action='search.php' method="GET" >
  				<input type="text" id="q" name="q" value= "Recherche" 
  				onfocus='if(this.value=="Recherche"){value="";}'
  				onblur='if(this.value==""){this.value="Recherche";}'
  				>
  			</form>
  		</div>
  	</nav>
  	<header>
  		<div id="logo"><a href="../"><img src="img/logo.png"></a><p>L'informatique, ma passion</p></div>
  		<div id="menu">
  			<ul>
          <a href="index.php?categorie=4"><li>Divers</li></a>
  				<a href="index.php?categorie=3"><li>sport</li></a>
  				<a href="index.php?categorie=2"><li>high-tech</li></a>
  				<a href="index.php?categorie=1"><li>informatique</li></a>
          <a href="index.php"><li>home</li></a>
  			</ul>
  		</div>
  	</header>