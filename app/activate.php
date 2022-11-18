<?php
  include "inc/includes.php";
  include "header.php";
   $posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");
if (!empty($_GET) && isset($_GET['token']) && isset($_GET['email'])) {
  $email=$_GET['email'];
  $token=$_GET['token'];
 
  $data = array(
    'email'=>$email, 
    'token'=>$token
    );
  $sql= "select email, token from users where email=:email and token=:token";
  $req= $DB->tquery($sql,$data);
  if ($req){
    $active=1;
    $q = array(
    'email'=>$email,
    'active'=> $active
    );
    
    $sql= "select email,active from users where email=:email and active=:active limit 1";
    $res=$DB->tquery($sql,$q);
    if($res){
      $_SESSION['alert_success']="Votre compte est déjà activé!";
    }else{
      $sql="update users set active=:active where email=:email";
      $result=$DB->insert($sql,$q);
          if ($result){
          $_SESSION['alert_success']="Votre compte est maintenant activé!";
          }else{
            $_SESSION['alert_error']="Il y'a eu une erreur lors de l'activation!";
          }
        }

  }else{
   $_SESSION['alert_error']="Ce compte n'existe pas!";;
  }
}else
header("location:index.php");
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
         </div>

  			<div id="boxComments">
          <div class="lastPosts">
            <h2> Les Derniers Articles </h2>
            <ul>
              <?php  include "inc/lastPosts.php";?>
              
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
            <div class="fb-like-box" data-href="https://www.facebook.com/moktarba" data-width="292" data-show-faces="true" data-stream="true" data-show-border="true" data-header="true"></div>
            </div>
  				
  			</div><!-- boxComments -->
  		</div> <!-- fin contenuPage -->
  	</div><!-- fin page -->
     
    
    <div class="clearfix"></div>
  	

    <?php include "footer.php"; ?>


  <!-- like box tweeter-->
 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!-- like button facebook-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  