<?php
  include "inc/includes.php";
  include "header.php"; 
  
   $posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");
  if ($_SERVER['REQUEST_METHOD']=="POST") {
     $validate=true;
    if (empty($_POST['pseudo'])) {
        $erreur_pseudo="Vous devez choisir un pseudo...";
        $validate=false;
    }elseif (!USER::pseudo_unique($DB,$_POST['pseudo'])) {
      $erreur_pseudo="Ce pseudo est déjà utilisé!";
       $validate=false;
    }
    if (empty($_POST['email'])) {
      $erreur_mail="Vous devez renseigner votre email!";
       $validate=false;
    }elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      $erreur_mail="Veuillez choisir un email valide...";   
       $validate=false; 
    }elseif (!USER::email_unique($DB,$_POST['email'])) {
      $erreur_mail="Cet email est déjà utilisé...";
       $validate=false;
    }

    if (empty($_POST['password'])) {
      $erreur_password="Vous devez chosir un mot de passe..."; 
       $validate=false;
    }elseif (strlen($_POST["password"])<7) {
         $erreur_password="Votre mot de passe doit comporter au moins 6 caractères...";
          $validate=false;
          
    }elseif (empty($_POST['confirm_password'])) {
      $erreur_confirm_password="Vous devez confirmer votre mot de passe...";
       $validate=false;
    }

    if ($validate) {
      $token= sha1(uniqid(rand()));
      $pseudo= htmlspecialchars($_POST['pseudo']);
      $email= htmlspecialchars($_POST['email']);
      $password= USER::hashPassword($_POST['password']);
      $data = array(
        'pseudo' =>  $pseudo,
        'email' =>  $email,
        'password' =>  $password,
        'token' =>  $token,
        'created_at'=>"NOW()"
        );
      $sql= "insert into users(username,email,password,token,created_at) values(:pseudo,:email,:password,:token,:created_at)";
      $req= $DB->insert($sql,$data);

      if ($req) {
      $mail_To=$_POST['email'];
      $mail_Subject= "Message de confirmation \n";
      $mail_Body='Votre compte vient d\'etre créé, Veuillez cliquer ici: http://www.moktarba.com/activate.php?token='.$token.'&email='.$_POST["email"].' pour activer votre compte! \n';
      $headers="From: www.moktarba.com \n";
      $headers.="Reply_to: moktarba@hotmail.fr \n";
      $headers.="MIME-Version: 1.0 \n";
      $headers.="Content-type=text/html; charset=utf8 \n";
      if (mail($mail_To, $mail_Subject, $mail_Body,$headers)) {
        $_SESSION['alert_success']="Merci d'avoir créé votre compte, Un email d'activation vous a été envoyé!,\n Veuillez vérifier vos ";
        unset($_POST);
        unset($_SESSION['alert_error']);
      }else{
        $_SESSION['alert_error']="Un problème est survenu lors de la crétion de votre compte\n Veillez réessayer plutard...";
        unset($_SESSION['alert_success']);
      }
    }
  }
}
  


?>
  	<div id="page">
  		<div id="contenuPage">
  			<div id="boxArticles">
            <div id="login-signup">

              <?php if (isset($_SESSION['alert_success'])): ?>
                <div class="alert_success"><?php echo $_SESSION['alert_success'] ?></div>
                <?php unset($_SESSION)?>
              <?php endif ?>
              <?php if (isset($_SESSION['alert_error'])): ?>
                <div class="alert_error"><?php echo $_SESSION['alert_error']; ?></div>
                <?php unset($_SESSION)?>
              <?php endif ?>
              <h2>Inscription</h2>
               <form action="signup.php" method="post">

              <p><label for ="pseudo">Pseudo</label></p>
              <p><input type='text' name= "pseudo" value="<?php echo isset($POST['pseudo'])?$_POST['pseudo']:'' ?>"></p>
              <?php if (!empty($erreur_pseudo)): ?>
                  <div class="error"><?php echo $erreur_pseudo; ?></div>
              <?php endif ?>
              
              <p><label for ="email">Email</label></p>
              <p><input type="email" name="email" value="<?php echo isset($POST['email'])?$_POST['email']:'' ?>"></p>
              <?php if (!empty($erreur_mail)): ?>
                <div class="error"><?php echo $erreur_mail; ?></div>
              <?php endif ?>
              <p><label for ="password">Password</label></p>
              <p><input type="password" name="password" value="<?php echo isset($POST['password'])?$_POST['password']:'' ?>"></p>
                <?php if (!empty($erreur_password)): ?>
                  <div class="error"><?php echo $erreur_password; ?></div>
                <?php endif ?>
              <p><label for ="confirm_password">Password</label></p>  
              <p><input type="password" name="confirm_password" value="<?php echo isset($POST['confirm_password'])?$_POST['confirm_password']:'' ?>"></p>
                <?php if (!empty($erreur_confirm_password)): ?>
                  <div class="error"><?php echo $erreur_confirm_password;?></div>
                <?php endif ?>

              <p><input type="submit" value="valider"></p>
            </form> <!-- fin div signup -->
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
              <h2>Quelques Videos</h2>
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