<?php
include "inc/includes.php";
  include "header.php";
  $posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");

  if ($_SERVER['REQUEST_METHOD']=='POST') {
    $validate= true;
    if (empty($_POST['message'])) {
    $erreur_message= "Veuillez écrire votre message svp... ";
    $validate=false;
    }elseif (strlen($_POST['message']) < 5) {
      $erreur_message=" Votre message doit contenir au moins 5 lettres...";
      $validate=false;
    }

    if (empty($_POST['sujet'])) {
        $erreur_sujet= "Veuillez écrire votre sujet svp... ";
        $validate=false;
    }
    if (empty($_POST['fonction'])) {
         $erreur_fonction= "Veuillez renseigner votre fonction svp... ";
         $validate=false;
    }
    if (empty($_POST['email'])) {
          $erreur_email= "Veuillez renseigner un email svp... ";
          $validate=false;
    }elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
      $erreur_email= "Veuillez renseigner un email valide svp... ";
      $validate=false;
    }

    if (empty($_POST['nom'])) {
          $erreur_nom= "Veuillez renseigner un nom svp... ";
          $validate=false;
    }


    if ($validate) {
      $mail_To= "bamoktar@gmail.com";
      $mail_Subject= "Au sujet du blog: ".$_POST["sujet"];
      $headers= "Reply-to: ".$_POST['email']."\n";
      $headers.= "De la Part de: ".$_POST['nom']."\n";
      $headers.="Sa fonction: ".$_POST['fonction']."\n";
      $mail_body="Bonjour, \n Voici le contenu du message: \n\n\n".nl2br(htmlspecialchars($_POST['message']));

      if (mail($mail_To, $mail_Subject, $mail_body,$headers)) {
       $_SESSION['alert_success']="Merci pour votre message!";
          unset($_POST);
        }else{
          $_SESSION['alert_error']="Echec lors de l'envoi de votre message, veuillezréessayez plus tard!";
        }
      }
 }
  


?>
  	<div id="page">
      <div id="contenuPage">
  			<div id="boxMaps">
  				<section id="maps">
            <!-- Carte Google -->
             <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=Square+Eug%C3%A8ne+Pottier,+%C3%89vry&amp;aq=&amp;sll=48.620329,2.445048&amp;sspn=0.00661,0.006759&amp;ie=UTF8&amp;hq=&amp;hnear=Square+Eug%C3%A8ne+Pottier,+91000+%C3%89vry,+Essonne,+%C3%8Ele-de-France&amp;ll=48.620329,2.445037&amp;spn=0.00661,0.006759&amp;t=m&amp;z=14&amp;output=embed"></iframe><br /><small><a href="https://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=Square+Eug%C3%A8ne+Pottier,+%C3%89vry&amp;aq=&amp;sll=48.620329,2.445048&amp;sspn=0.00661,0.006759&amp;ie=UTF8&amp;hq=&amp;hnear=Square+Eug%C3%A8ne+Pottier,+91000+%C3%89vry,+Essonne,+%C3%8Ele-de-France&amp;ll=48.620329,2.445037&amp;spn=0.00661,0.006759&amp;t=m&amp;z=14" style="color:#0000FF;text-align:left">Agrandir le plan</a></small>
          </section>

           <?php if (isset($_SESSION['alert_success'])): ?>
              <div class="alert_success"><?php echo $_SESSION['alert_success'];?></div>
              <?php unset($_SESSION['alert_success']); ?>
          <?php endif ?>
          <?php if (isset($_SESSION['alert_error'])): ?>
              <div class="alert_error"><?php echo $_SESSION['error'];?></div>
              <?php unset($_SESSION['alert_error']); ?>
          <?php endif ?>

          <section id="form">
            <form action="contact.php" id="contact" method="post">

            <p>
              <label for="nom">Nom:
              </label>
                <input name="nom" type="text" value="<?php echo isset($_POST["nom"])?$_POST["nom"]:"" ?>">
            </p>
            <?php if (!empty($erreur_nom)): ?>
                <div class="error"><?php echo $erreur_nom; ?></div>
            <?php endif ?>
            <p>
              <label for="email">Email:
              </label>
                <input name="email" type="text" value="<?php echo isset($_POST["email"])?$_POST["email"]:"" ?>">
            </p>
            <?php if (!empty($erreur_email)): ?>
                <div class="error"><?php echo $erreur_email; ?></div>
            <?php endif ?>
            <p>
              <label for="fonction">Fonction: 
              </label>
                <input name="fonction" type="text" value="<?php echo isset($_POST["fonction"])?$_POST["fonction"]:"" ?>">
            </p>
            <?php if (!empty($erreur_fonction)): ?>
                <div class="error"><?php echo $erreur_fonction; ?></div>
            <?php endif ?>
            <p>
              <label for="sujet">Sujet
              </label>
                <input name="sujet" type="text" value="<?php echo isset($_POST["sujet"])?$_POST["sujet"]:"" ?>">
            </p>
            <?php if (!empty($erreur_sujet)): ?>
                <div class="error"><?php echo $erreur_sujet; ?></div>
            <?php endif ?>
            <p>
              <label for="message">Message:
              </label>

                <textarea cols="30" rows="10" name="message" >
                  <?php echo isset($_POST['message'])?$_POST['message']:"" ?>
                </textarea>      
            </p>
                 
                <?php if (!empty($erreur_message)): ?>
                  <div class="error"><?php echo $erreur_message; ?></div>
                 <?php endif ?>

            <p>
              <input type="submit" value="valider">
            </p>
          </form >
          </section>
  			</div><!-- boxMaps -->
  			<div id="boxComments">
          <div class="lastPosts">
            <h2>Les Derniers Articles </h2>
            <ul>
             <?php include "inc/lastPosts.php"; ?>
            </ul>
          </div> <!--  fin lastPosts -->

            <div class="lastVideos">
              <h2>Quelques Videos</h2>
              <?php  include "inc/lastVideos.php"; ?>
             
            </div>

  				<div id="widgetTwitter">
            <a class="twitter-timeline" href="https://twitter.com/moktarba" data-widget-id="338101359985434624">Tweets de @moktarba</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
            </script>
            <div class="fb-like-box" data-href="http://www.facebook.com/moktarba" data-width="292" data-height="600" data-show-faces="true" data-stream="true" data-show-border="true" data-header="true"></div>
            </div>
  				
  			</div><!-- boxComments -->
      </div><!-- fin contenuPage -->
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-1.7.1.min.js"><\/script>')</script>
  
</head>