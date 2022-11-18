<?php
  include "inc/includes.php";
  include "header.php";
  if (USER::isLog($DB)){
    $id= $_SESSION['user']['id'];
    $posts= $DB->query("select posts.id, posts.title, posts.image, posts.description, posts.created_at, posts.users_id from posts
                        inner join users on posts.users_id=users.id
                        where posts.users_id=$id
                        order by created_at desc");

    $nbr_posts= count($posts);

    $comments= $DB->query("select comments.id, comments.text, comments.created_at, comments.users_id from comments 
                          inner join users on comments.users_id= users.id
                          where comments.users_id=$id
                          order by created_at desc");
    $nbr_comments= count($comments);
  }
?>
  	<div id="page">
      <!--  Message de session -->
                    <?php if (isset($_SESSION['alert_success'])): ?>
                        <div class="alert_success"><?php echo $_SESSION['alert_success'];?></div>
                        <?php unset($_SESSION['alert_success']); ?>
                    <?php endif ?>
                    <?php if (isset($_SESSION['alert_error'])): ?>
                        <div class="alert_error"><?php echo $_SESSION['alert_error'];?></div>
                        <?php unset($_SESSION['alert_error']); ?>
                    <?php endif ?>
                    
  		<div id="contenuPage">
  			<div id="Post">
          <div id="article">
           
  				  <div id="box_name">
              <div id="thumb"><img src="<?php echo isset($_SESSION['user']['avatar'])?$_SESSION['user']['avatar']:"img/avatar.png"; ?>"></div>
              <div id="infos">
                <h4>BONJOUR <?php echo strtoupper($_SESSION['user']['username']); ?></h4>
                <p> Inscrit depuis le <?php echo Texte:: date_french($_SESSION['user']['created_at']); ?> avec (<?php echo $nbr_posts; ?>) posts, (<?php echo $nbr_comments; ?>)commentaires</p>
              </div>
            </div>
            <div id="box_infos">
                <h4>Vos Informations</h4>
               
                  <span id="nom">Nom: <strong><?php echo $_SESSION['user']['lastname'];?></strong></span>  
                <span id="prenom">Prénom: <strong><?php echo $_SESSION['user']['name']; ?></strong></span>
                <span id="mail">Email: <strong><?php echo $_SESSION['user']['email'] ?></strong> </span> 
                <p>
                    <?php echo $_SESSION['user']['bio']; ?>
                </p>    
                <span id="connex">date de la dernière connexion: le <?php echo Texte::date_french_time($_SESSION['user']['last_login']); ?></span>  
           
                              
              </div>

              <!-- Début last_posts -->  
              <div id="last_posts">
             <h2>MES DERNIERS ARTICLES</h2>
              <?php foreach ($posts as $post): ?>
           <a href="posts.php?id=<?php echo $post->id; ?>"><div class="lastArticles">
                 <div class="thumb"><img src="<?php echo $post->image; ?>"></div>
              <div class="last_content">
                <h4><?php echo $post->title; ?></h4>
                 <p>
                    <?php echo Texte::limit($post->description, 70); ?>
                </p>    
              </div>
            </div></a>
              <?php endforeach ?>
           </div>
          </div><!-- fin article -->  
  			</div><!-- fin Post -->


  			 <div id="boxComments_compte">
          <div class="box_modif">
            <h2> Modifications </h2>
            <ul>
                <li ><a href="profil.php">Modifier mon profil</a></li>
                <li href= "#"></li>
                <li></li>
            </ul>
              
              
            </ul>
          </div> <!--  fin lastPosts -->

            <div class="lastComments">
              <h2>Vos Derniers comentaires</h2>
              <?php foreach ($comments as $comment): ?>
                <p>&quot;<?php echo $comment->text; ?>&quot;</p>
              <?php endforeach ?>    
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

          
        </div><!-- boxComments_compte -->
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