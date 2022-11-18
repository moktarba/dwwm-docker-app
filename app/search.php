<?php
  include "inc/includes.php";
  include "header.php";
$posts= $DB->query("select id, title, image, description from posts limit 3");
  if (isset($_GET['q'])) {
   
     $search= '%'.strtolower($_GET['q']).'%';
     $data = array(
      'search' => $search,
      );
    
     $cssMoyen= $DB->query("select id,title,title2, description, description2, image, created_at from posts  where LOWER(title) like :search or LOWER(title2) like :search or LOWER(description) like :search or LOWER(description2) like :search and css=1",$data);
    $cssPetit= $DB->query("select id,title,title2, description, description2, image, created_at from posts  where LOWER(title) like :search or LOWER(title2) like :search or LOWER(description) like :search or LOWER(description2) like :search and css=2",$data);
    $cssDouble= $DB->query("select id,title,title2, description, description2, image, created_at from posts  where LOWER(title) like :search or LOWER(title2) like :search or LOWER(description) like :search or LOWER(description2) like :search and css=3",$data);

}

?>

  	<div id="page">
  		<div id="contenuPage">
  			<div id="boxArticles">
     <?php if (empty($cssMoyen)): ?>
          <div id="contenuPage">
            <h3>Résultats Recherche:</h3>
            <p>Aucun Résultat suite à votre recherche du mot: <?php echo "<b>".$search."</b>"; ?></p>
          </div>
        <?php else: ?>
       
  			 <?php foreach ($cssMoyen as $post): ?>
             <!-- section petit moyenArticle-->
            <section class="moyenArticle">
             <h3><?php echo $post->title ?> </h3>
             <div class="thumb-moyen"><a href="posts.php?id=<?php echo $post->id; ?>"><img src="<?php echo $post->image ?>"></a></div>
             <div class="content-moyen">
              <p><?php echo Texte::limit($post->description,350); ?> </p>
           </div></section>
         <?php endforeach ?>      
      <?php endif ?>
  				

  			</div>
  			<div id="boxComments">
          <div class="lastPosts">
            <h2> Les Derniers Articles </h2>
            <ul>
              <?php foreach ($posts as $post): ?>
                  <a href="posts.php?id=<?php echo $post->id ?>"><li><div class="thumbLastPosts"><img src="<?php echo $post->image ?>"></div>
                <div class="content">
                  <h3><?php echo $post->title ?></h3>
                  <p><?php echo Texte::limit($post->description,75); ?></p>
                </div>
              </li></a>
              <?php endforeach ?>
              
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
  