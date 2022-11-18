<?php
  include "inc/includes.php";
  include "header.php"; 
  
   $posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");
  if ($_SERVER['REQUEST_METHOD']=="POST") {
   if (!empty($_POST['email'])) {
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $erreur_mail="Veuillez donner un email valide...";
      }
      else{
            $email=$_POST['email'];
            $sql= "select * from users where email=:email";
            $req=$DB->tquery($sql,array('email' => $email ));
            if(!empty($req)){
            if ($req[0]['active']==1) {
            $password= USER::generate(8);
            $mail_To=$email;
            $mail_Subject= "Un nouveau mot de passe \n";
            $mail_Body='Vous avez demandé un nouveau mot de passe, veuillez le trouver ci-après: '.$password;
            $headers="From: www.abratkom.com \n";
            $headers.="Reply_to: moktarba@hotmail.fr \n";
            $headers.="MIME-Version: 1.0 \n";
            $headers.="Content-type=text/html; charset=utf8 \n";

            if (mail($mail_To,$mail_Subject,$mail_Body,$headers)) {
              $pass= USER::hashPassword($password);
              $gamma= $DB->insert('update users set password=:pass,updated_at=NOW() where email=:email', array('email' => $email,'pass'=>$pass ));
              if($gamma) {
                $_SESSION['alert_success']= 'Un nouveau mot de passe vous a été envoyé avec succès !';
                unset($_SESSION['alert_error']);
              }
              else{ 
                $_SESSION['alert_error']='Un problème est survenu lors de l\'enregistrement du mot de passe';
                unset($_SESSION['alert_success']);
              }

            }
            else{
              $_SESSION['alert_error']="Un problème est survenu lors de l'envoi du mail...";
              unset($_SESSION['alert_success']);
            }
          }
          else{
            $_SESSION['alert_error']= "Votre compte est inactif, veuillez vérifier vos mails...";
            unset($_SESSION['alert_success']);
          }
        }
        else{
          $_SESSION['alert_error']= "Votre email ne figure pas dans la base données...";
            unset($_SESSION['alert_success']);
        }
      }
   }
   else{
    $erreur_mail="Veuiilez renseigner votre email...";
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
              <h2>mot de passe ? </h2>
               <form action="password.php" method="post">
              <p><label for ="email">Email</label></p>
              <p><input type="email" name="email" value="<?php echo isset($POST['email'])?$_POST['email']:'' ?>"></p>
              <?php if (!empty($erreur_mail)): ?>
                <div class="error"><?php echo $erreur_mail; ?></div>
              <?php endif ?>
            
              <p><input type="submit" value="envoyer"></p>
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