<?php
  include "inc/includes.php";
  include "header.php"; 
  $posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");
  if (isset($_GET['logout'])) {
    if (isset($_SESSION['user'])) {
      unset($_SESSION['user']);
    }
     if (isset($_SESSION['uncrypted_token'])) {
      unset($_SESSION['uncrypted_token']);
    }
     if (isset($_SESSION['token'])) {
      unset($_SESSION['token']);
    }
    $_SESSION['authentificated']=false;
    $_SESSION['alert_success']= "Vous etes déconnecté avec succès!";
    unset($_SESSION['alert_success']);
    unset($_SESSION['alert_error']);
    header("location:../index.php");
     
  }
  if($_SERVER['REQUEST_METHOD']=="POST"){
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email= $_POST['email'];
    $password= USER::hashPassword($_POST['password']);
    $data = array(
      'email' => $email, 
      'password'=>$password
      );
    $alpha=$DB->tquery("select * from users where email=:email and password=:password limit 1",$data);
    if (!empty($alpha)) {
      if ($alpha[0]['active']==1) {
        session_name("connexion");
        $_SESSION['user']=$alpha[0];
        $_SESSION['authentificated']=true;
        $_SESSION['uncrypted_token']=uniqid();
        $_SESSION['token']=USER::hashPassword($_SESSION['uncrypted_token']);

        $_SESSION['alert_success']="Vous etes maintenant connecté !";
        unset($_SESSION['alert_error']);
        $beta=$DB->insert("update users set last_login=NOW() where email=:email",array('email' => $email ));
        header("location: ../index.php"); 
        
      }else{
        $_SESSION['alert_error']='Votre compte n\'est pas activé, veuillez vérifier dans vos mails...';
        unset($_SESSION['alert_success']);
      }
    }else{
      $_SESSION['alert_error']= "Veuillez vérifier votre email et/ou votre mot de passe...";
        unset($_SESSION['alert_success']);
    }
  }else{
    if (empty($_POST['email'])) {
      $erreur_email="Vous devez renseigner votre email...";
    }
    if (empty($_POST['password'])) {
      $erreur_password="Vous devez renseigner votre mot de passe...";
    }
  }

}/*else{
    $_SESSION['alert_error']= "Veuillez renseigner votre email et votre mot de passe...";
        unset($_SESSION['alert_success']);
  }*/
?>
  	<div id="page">
  		<div id="contenuPage">
  			<div id="boxArticles">
            <?php if (isset($_SESSION['alert_success'])): ?>
              <div class="alert_success"><?php echo $_SESSION['alert_success']; ?></div>
            <?php endif ?>
            <?php if (isset($_SESSION['alert_error'])): ?>
              <div class="alert_error"><?php echo $_SESSION['alert_error']; ?></div>
            <?php endif ?>
            <div id="login-signup">
              <h2>Connexion</h2>
               <form action="login.php" method="post">
              <p><label for ="email">Email</label></p>
              <p><input type="text" name="email" value='<?php echo isset($_POST['email'])?$_POST['email']: "" ?>'></p>
                <?php if (!empty($erreur_email)): ?>
                  <div class="error"><?php echo $erreur_email; ?></div>
                <?php endif ?>
              <p><label for ="password">Password</label></p>
              <p><input type="password" name="password" value='<?php echo isset($_POST['password'])?$_POST['password']: "" ?>'></p>
                <?php if (!empty($erreur_password)): ?>
                  <div class="error"><?php echo $erreur_password; ?></div>
                <?php endif ?>
              <p><a href="password.php"> mot de passe oublié? </a></p>
              <p><input type="submit" value="valider"></p>
            </form> <!-- fin div login -->
            </div>
  			</div>
  			<div id="boxComments">
          <div class="lastPosts">
            <h2>Les Derniers Articles </h2>
            <ul>
             <?php include "inc/lastPosts.php"; ?>
            </ul>
          </div> <!--  fin lastPosts -->

            <div class="lastVideos">
             <?php include "inc/lastVideos.php"; ?>
            </div>

  				<div id="widgetTwitter">
            <a class="twitter-timeline" href="https://twitter.com/moktarba" data-widget-id="338101359985434624">Tweets de @moktarba</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
            </script>
            <div class="fb-like-box" data-href="http://www.facebook.com/canalplus" data-width="292" data-height="600" data-show-faces="true" data-stream="true" data-show-border="true" data-header="true"></div>
            </div>
  				
  			</div><!-- boxComments -->
  		</div> <!-- fin contenuPage -->
  	</div><!-- fin page -->
    
    <div class="clearfix"></div>
        <?php include "footer.php"; ?>
    </div>
  </body>

  <!-- like box tweeter-->
 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- like box facebook-->


<!-- like button facebook-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  
</head>