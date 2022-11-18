
<?php /*$posts= $DB->query("select id,title, description, image, created_at from posts order by created_at limit 3 ");*/
?>

<?php foreach ($posts as $post): ?>
                  <li><div class="thumbLastPosts"><a href="posts.php?id=<?php echo $post->id ?>"><img src="<?php echo $post->image ?>"></a></div>
                <div class="content">
                  <a href="posts.php?id=<?php echo $post->id ?>"><h3><?php echo $post->title ?></h3></a>
                  <p><?php echo Texte::limit($post->description,85); ?></p>
                </div>
              </li>
              <?php endforeach ?>