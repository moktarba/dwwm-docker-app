<?php
  include "inc/includes.php";
  include "header.php";
  $posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");


//if ($_SERVER['REQUEST_METHOD']=="POST" || $_SERVER['REQUEST_METHOD']=="GET") {
  if ($_SERVER['REQUEST_METHOD']=="POST") {
     $id=intval($_POST['id']);
    $validate= true;
    if (empty($_POST['pseudo'])) {
       $erreur_pseudo= "Veuillez entrer votre pseudo"; 
       $validate= false;
      } 

      if (USER::isLog($DB) && $_POST['pseudo']==$_SESSION['user']['pseudo']) {
        $erreur_pseudo= "";
        $validate=true;
      }
      elseif (!USER::pseudo_unique($DB,$_POST['pseudo'])  && !USER::isLog($DB)) {
        $erreur_pseudo= "Le pseudo est déja utilisé, ou vous n'etes pas connecté !";
        $validate= false;
      } 


      if (empty($_POST['email'])) {
        $erreur_email = "Veuillez donner votre email svp !";
        $validate= false;
      }
      elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreur_email= "Veuillez choisir un email valide !";
        $validate= false;
      }

      if (USER::isLog($DB) && $_POST['email']==$_SESSION['user']['email']) {
        $validate=true;
      }
      elseif (!USER::email_unique($DB,$_POST["email"])) {
        $erreur_email= "Veuillez vous connecter pour utiliser cet email!";
        $validate= false;
      }

      if (empty($_POST['commentaire'])) {
        $erreur_commentaire="Vous devez écrire un commentaire !";
        $validate= false;
      }elseif (strlen($_POST['commentaire'])<5) {
        $erreur_commentaire= "Votre commentaire doit comporter plus de 5 lettes !";
        $validate= false;
      }

      if ($validate) {
        if (USER::auth()) {
          $users_id= $_SESSION['user']['id'];
        }else
        $users_id=1;
        $data = array(
          "pseudo"=>htmlspecialchars(addslashes($_POST['pseudo'])), 
           "email" =>htmlspecialchars(addslashes($_POST['email'])),
           "commentaire" =>htmlspecialchars(addslashes($_POST['commentaire'])),
           "users_id"=>$users_id,
           "posts_id"=>$id
           );
        $sql= "insert into comments(text,pseudo,mail,users_id,posts_id,created_at) values(:commentaire,:pseudo,:email,:users_id,:posts_id,NOW())";
        $req= $DB->insert($sql,$data);
        if ($req) {
          $_SESSION['alert_success']="Merci pour votre commentaire!";
          unset($_POST);
        }else{
          $_SESSION['alert_error']="Echec lors de l'envoi de votre message, réessayez plus tard!";
        }
      }


  }

  if (isset($_GET['id'])) {
     $id= intval($_GET['id']);
    if (empty($_GET['id'])) {
     header("location:index.php");
     exit(); 
   }
   
    $post= $DB->query("select posts.id, posts.title, posts.description, posts.image,posts.created_at, posts.updated_at, users.username from posts
                      inner join users on users_id=users.id
                      where posts.id=$id");
     if(empty($post)){
       header("location:index.php");
       exit();
     }
     
    $post=$post[0];

    $comments =$DB->query("select comments.id, comments.text, comments.pseudo,comments.created_at, comments.posts_id, users.avatar from comments
                      left join users on users_id=users.id
                      where posts_id=$id order by created_at desc limit 4");

    $nbr_comments= count($comments);
  }
/*}else
  header("location:index.php");
  exit();*/
  
?>
    <div id="page">
      <div id="contenuPage">
        <div id="Post">
          <div id="article">
            <h2> <?php echo $post->title; ?></h2>
            <div id="thumbnail">
            <img src="<?php echo $post->image; ?>">
            </div>
            <div id="content"> 
              <div class="clearbox"></div>
              <span id="nbr_comments"><img src="img/message.png"><span><?php echo $nbr_comments; ?></span></span>     
             <span>Publié par <?php echo $post->username; ?> le <?php echo Texte::date_french($post->created_at); ?></span>   
             <p><?php echo $post->description; ?></p>

           </div> <!-- fin content -->    
          </div><!-- fin article -->  
          <div><!-- Placez cette balise où vous souhaitez faire apparaître le gadget bouton "Partager". -->
                  <div class="g-plus" data-action="share"></div>
                  <!-- Placez cette ballise après la dernière balise Partager. -->
                  <script type="text/javascript">
                    window.___gcfg = {lang: 'fr'};
                    (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                  </script>
               </div>
          <div class="commentaires">
            <h2>Laisser un commentaire</h2>
            <?php foreach ($comments as $comment): ?>
                <div class="commentaire">
              <div class="avatar"><img src="<?php echo isset($comment->avatar)?$comment->avatar:"img/avatar.png"; ?>">
              </div>
                <div class="author">
                  <?php echo $comment->pseudo; ?><span>publié le <?php echo Texte::date_french($comment->created_at); ?> à <?php echo Texte::date_french_time($comment->created_at) ?></span>
                </div>
                <div class="texte">
                <p> <?php echo $comment->text; ?></p></div>

            </div>
            <?php endforeach ?>

          <!--  Message de session -->
          <?php if (isset($_SESSION['alert_success'])): ?>
              <div class="alert_success"><?php echo $_SESSION['alert_success'];?></div>
              <?php unset($_SESSION['alert_success']); ?>
          <?php endif ?>
          <?php if (isset($_SESSION['alert_error'])): ?>
              <div class="alert_error"><?php echo $_SESSION['alert_error'];?></div>
              <?php unset($_SESSION['alert_error']); ?>
          <?php endif ?>

         <form action="posts.php?id=<?php echo $post->id; ?>" method="POST">
          <input type="hidden" name="id" value="<?php echo $post->id; ?>"> 
            <p>
              <label for="pseudo">Pseudo </label>
              <input type="text" name="pseudo" value="<?php echo isset($_POST['pseudo']) ? $_POST['pseudo'] : ""; ?>">
            </p>
            <?php if (!empty($erreur_pseudo)): ?>
              <div class="error"><?php echo $erreur_pseudo; ?></div>
            <?php endif ?>
            <p>
              <label for="email">Email </label>
              <input type="text" name="email" value='<?php echo isset($_POST["email"])? $_POST["email"] : "" ?>'>
            </p>
            <?php if (!empty($erreur_email)): ?>
             <div class="error"> <?php echo $erreur_email; ?> </div>
            <?php endif ?>
            
            <p>
              <label for="commentaire">Commentaire</label>
              <textarea name="commentaire" id="" cols="30" rows="10"><?php echo isset($_POST['commentaire'])?$_POST['commentaire']:""; ?></textarea>
              <?php if (!empty($erreur_commentaire)): ?>
              <div class="error"><?php echo $erreur_commentaire; ?></div>
            <?php endif ?>
            </p>
            
            <p>
              <input type="submit" value="Envoyer">
            </p>
          </form> 

          </div>

        </div><!-- fin Post -->
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
            <div class="fb-like-box" data-href="https://www.facebook.com/moktar.ba.94" data-width="292" data-show-faces="true" data-stream="true" data-show-border="true" data-header="true"></div>
            </div>

                <!-- Placez cette balise où vous souhaitez faire apparaître le gadget widget. -->
            <div class="g-person" data-href="//plus.google.com/117616779073939568796" data-rel="author"></div>

               <div>   <!-- Placez cette ballise après la dernière balise widget. -->
                  <script type="text/javascript">
                    window.___gcfg = {lang: 'fr'};

                    (function() {
                      var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                      po.src = 'https://apis.google.com/js/plusone.js';
                      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                  </script>
            </div>


            <script type="text/javascript">var viadeoWidgetsJsUrl = document.location.protocol+"//widgets.viadeo.com";(function(){var e = document.createElement('script'); e.type='text/javascript'; e.async = true;e.src = viadeoWidgetsJsUrl+'/js/viadeowidgets.js'; var s = document.getElementsByTagName('head')[0]; s.appendChild(e);})();</script><div class="viadeo-profile" data-user-id="ooxvwvrfIzjyhvqqEzybsoqiEc" data-partner-id="ooxvwvrfIzjyhvqqEzybsoqiEc" data-title="A propos" data-width="300" data-prof-exp="true"></div>
          
        </div><!-- boxComments -->
      </div>
    </div>
    
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
  </head>
