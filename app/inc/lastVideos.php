<?php
 $videos= $DB->query('select * from videos order by artist limit 5 ');
?>
<?php foreach ($videos as $video): ?>
                <div class="video">
                <iframe width="150" height="110" src="<?php echo $video->link ?>" frameborder="0" allowfullscreen></iframe>
                <div class="content">
                <h3>Artiste:</h3><h4><?php echo $video->artist; ?></h4>
                <h3>Album:</h3><h4><?php echo strtoupper($video->album); ?></h4>
                <h3>Titre:</h3><p><?php echo $video->title; ?></p>
                </div>
              </div>  
              <?php endforeach ?>