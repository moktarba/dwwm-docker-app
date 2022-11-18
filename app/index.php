<?php
  include "inc/includes.php";
  include "header.php";
 $posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");
$categorie=0;
$data= array();
  if (isset($_GET['categorie'])) {
   if ($_GET['categorie']>0 && $_GET["categorie"]<5) {
     $categorie= $_GET['categorie'];
     $data = array(
      'category_id' => $categorie,
      'css1'=>'1'
      );
     $data2 = array(
      'category_id' => $categorie,
      'css2'=>'2'
      );
     $data3 = array(
      'category_id' => $categorie,
      'css3'=>'3'
      );
     $cssMoyen= $DB->query("select id,title, description,image, categories_id, created_at from posts  where categories_id=:category_id and css=:css1",$data);
     $cssPetit= $DB->query("select id,title, description,image,categories_id, created_at from posts where categories_id=:category_id and css=:css2",$data2);
     $cssDouble= $DB->query("select id,title,title2, description,description2, image, image2,categories_id, created_at from posts where categories_id=:category_id and css=:css3",$data3);
    }
    else $categorie=1;
}
else{
      $css1= array('css1'=>'1'); $css2=array('css2'=>'2');$css3=array('css3'=>'3');
      $cssMoyen= $DB->query("select id,title, description,image, created_at from posts  where css=:css1 order by created_at desc limit 2",$css1);
      $cssPetit= $DB->query("select id,title, description,image, created_at from posts where css=:css2  order by created_at limit 2",$css2);
      $cssDouble= $DB->query("select id,title,title2, description,description2, image, image2, created_at from posts where css=:css3 order by created_at limit 2",$css3);
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
  			<div id="boxArticles">


       <?php if (isset($cssMoyen)): ?>
  			 <?php foreach ($cssMoyen as $post): ?>
             <!-- section petit moyenArticle-->
            <section class="moyenArticle">
             <h3><a href="posts.php?id=<?php echo $post->id; ?>"><?php echo $post->title ?> </h3></a>
             <div class="thumb-moyen"><a href="posts.php?id=<?php echo $post->id; ?>"><img src="<?php echo $post->image ?>"></a></div>
             <div class="content-moyen">
              <p><?php echo Texte::limit($post->description,350); ?> </p>
           </div></section>
         <?php endforeach ?>
       <?php endif ?>

       <?php if (isset($cssPetit)): ?>
          <?php foreach ($cssPetit as $post): ?>
              <section class="petitArticle">
            <div class="thumb-petit"><a href="posts.php?id=<?php echo $post->id ?>"><img src="<?php echo $post->image ?>"></a></div>
            <div class="content-petit">
              <h3><a href="posts.php?id=<?php echo $post->id ?>"><?php echo $post->title ?></h3></a>
              <p><?php echo Texte::limit($post->description,350); ?> </p>
            </div>
          </section>  
         <?php endforeach ?>
       <?php endif ?>
            <!-- section petit article-->
          
        <?php if (isset($cssDouble)): ?>
          <?php foreach ($cssDouble as $post): ?>
            <section class="doubleArticle">
              <div class="doubleArticleFirst">
                <a href="posts.php?id=<?php echo $post->id; ?>"><h3><?php echo $post->title; ?></h3></a>
            <div class="thumb-double"><a href="posts.php?id=<?php echo $post->id; ?>"><img src="<?php echo $post->image; ?>"></a></div>
            <div class="content-double">
              <p><?php echo Texte::limit($post->description,150); ?></p>
            </div><!-- fin content-double -->
            </div> <!-- fin doubleArticleFirst -->  

            <div class="doubleArticleSecond">
              <a href="posts.php?id=<?php echo $post->id; ?>"><h3><?php echo $post->title2 ?></h3></a>
            <div class="thumb-double"><a href="posts.php?id=<?php echo $post->id; ?>"><img src="<?php echo $post->image2; ?>"></a></div>
            <div class="content-double">   
             <p><?php echo Texte::limit($post->description2,150); ?></p>
            </div><!-- fin content-double -->
           </div><!-- fin doubleArticleSecond -->
          </section>   
         <?php endforeach ?>
        <?php endif ?>
  				
         <!-- <div id= "pagination">
             <ul>
              <li><a href="index.php" class="active">1</a></li>
              <li><a href="index.php">2</a></li>
            </ul>
          </div> -->
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
                    <!-- Les Réseaux sociaux -->
              			  	<div id="widgetTwitter">
                        <a class="twitter-timeline" href="https://twitter.com/moktarba" data-widget-id="338101359985434624">Tweets de @moktarba</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
                        </script>
                        <div class="fb-like-box" data-href="https://www.facebook.com/moktarba" data-width="292" data-show-faces="true" data-stream="true" data-show-border="true" data-header="true"></div>
                        </div>
                        <!-- Placez cette balise où vous souhaitez faire apparaître le gadget widget. -->
                        <div class="g-person" data-href="//plus.google.com/117616779073939568796" data-rel="author"></div>

            <!-- Placez cette ballise après la dernière balise widget. -->
                            <script type="text/javascript">
                              window.___gcfg = {lang: 'fr'};
                              (function() {
                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                po.src = 'https://apis.google.com/js/plusone.js';
                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                              })();
                            </script>
              				
                        <script type="text/javascript">var viadeoWidgetsJsUrl = document.location.protocol+"//widgets.viadeo.com";(function(){var e = document.createElement('script'); e.type='text/javascript'; e.async = true;e.src = viadeoWidgetsJsUrl+'/js/viadeowidgets.js'; var s = document.getElementsByTagName('head')[0]; s.appendChild(e);})();</script><div class="viadeo-profile" data-user-id="ooxvwvrfIzjyhvqqEzybsoqiEc" data-partner-id="ooxvwvrfIzjyhvqqEzybsoqiEc" data-title="A propos" data-width="300" data-prof-exp="true"></div>   
                        <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                   <!-- Fin des Réseaux sociaux -->
                   
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
  