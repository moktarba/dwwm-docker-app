<?php
  include "inc/includes.php";
  include "header.php";
 if (USER::isLog($DB)){
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $validate= true;

      

      if (empty($_POST['email'])) {
        $email= $_SESSION['user']['email'];
      }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $validate=false;
        $error_email= "Veuillez renseigner un email valide...";
      }else $email = $_POST['email'];

      if (empty($_POST['password'])) {
        $password = $_SESSION['user']['password'];
      }elseif (empty($_POST['confirm_password'])) {
         $error_confirm_password= "Veuillez confirmer votre mot de passe...";
         $validate=false;
      }
      elseif ($_POST['confirm_password'] != $_POST['password']) {
        $validate= false;
       $error_confirm_password= "Le mot de passe de confirmation est différente...";
      }
      else{
        $password = USER::hashPassword($_POST['password']);
        $validate= true;
      }

    if (!empty($_FILES['avatar']['name']) && $validate) {
      $extensions= array('.png','.jpg','.jpeg','.gif');
      $extension = strchr($_FILES['avatar']['name'],'.');

      $dossier = UPLOAD;
      if (!in_array($extension, $extensions)) {
        $validate= false;
        $error_avatar= "Vous devez choisir un format de fichier parmi(png,jpeg,jpg,gif,'JPEG','JPG')";
      }else{
        $avatar= $dossier.md5($_FILES['avatar']['name'])."$extension";
        
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar)) {
                $validate= false;
                $_SESSION['alert_error']= "Un problème est survenu lors du téléchargement du fichier...";
        }
      }
    }else{
      $avatar = $_SESSION['user']['avatar'];
    }

    if (!empty($_POST['nom'])) {
        $nom= $_POST['nom'];
        $validate=true;
      }else{
        $nom= $_SESSION['user']['lastname'];
      }

      if(!empty($_POST['prenom'])){
        $prenom = $_POST['prenom'];
        $validate = true;
      }else{
        $prenom= $_SESSION['user']['name'];
      }

      if(!empty($_POST['bio'])){
        $bio = $_POST['bio'];
      }else{
        $bio= $_SESSION['user']['bio'];
      }

    if ($validate) {
      $data = array('id' => $_SESSION['user']['id'],
                    'nom' => $nom,
                    'prenom'=> $prenom,
                    'bio'=> $bio,
                    'email' => $email,
                    'password'=> $password,
                    'avatar'  => $avatar
                    );
      $inc = $DB->insert('update users set name =:prenom, lastname=:nom, bio=:bio, email=:email, password=:password, avatar=:avatar, updated_at =NOW() where id=:id',$data);
      if($inc){
        $_SESSION['alert_success']= "Vous avez réussi la mise à jour de votre profil";
        $_SESSION['user'] = array_merge($_SESSION['user'],$data);
        header("location: compte.php");
      }else{
        $_SESSION['alert_error'] = "Un problème est survenu lors de la mise à jour";
      }header("location: ../index.php");
      exit();
    } 
  } 
}
   else{
    header("location: login.php");
   $_SESSION["alert_error"]= "Cet espace est réservé aux abonnés...";
    exit();
  }
     ?>
 
  	<div id="page">
  		<div id="contenuPage">
          <div id="article">
           
  				  <div id="box_profil">
              <div id="thumb"><img src="<?php echo isset($_SESSION['user']['avatar'])?$_SESSION['user']['avatar']:"img/avatar.png"; ?>"></div>
              <div id="infos">
                <h4>BONJOUR <?php echo strtoupper($_SESSION['user']['username']); ?></h4>
                <p> Inscrit depuis le <?php echo Texte::date_french($_SESSION['user']['created_at']) ?></p>
                <p>Role: <?php echo $_SESSION['user']['rule'] ?></p>
                <p>Username: <?php echo $_SESSION['user']['username'] ?></p>
              </div>
            </div>
            <div id="box_modif">
                <h4>Modifier mon profil</h4>

                            <!--  Message de session -->
                    <?php if (isset($_SESSION['alert_success'])): ?>
                        <div class="alert_success"><?php echo $_SESSION['alert_success'];?></div>
                        <?php unset($_SESSION['alert_success']); ?>
                    <?php endif ?>
                    <?php if (isset($_SESSION['alert_error'])): ?>
                        <div class="alert_error"><?php echo $_SESSION['alert_error'];?></div>
                        <?php unset($_SESSION['alert_error']); ?>
                    <?php endif ?>
       
                  <form action = "profil.php" method= "POST" enctype = "multipart/form-data">
                    <input type="hidden" name ="id" value= "<?php echo $_SESSION['user']['id']; ?>">
                    <p>
                      <label for="nom" >Nom:</label>
                      <input type = "text" name = "nom" value="<?php echo $_SESSION['user']['lastname'] ?>">
                     
                    </p>

                    <p>
                      <label for= "prenom">Prénom:</label>
                      <input type = "text" name = "prenom" value="<?php echo $_SESSION['user']['name'] ?>">
                    </p>

                    <p>
                      <label for="email">Email:</label>
                      <input type = "email" name = "email" value="<?php echo $_SESSION['user']['email'] ?>">
                    </p>
                     <?php if (!empty($error_email)): ?>
                        <div class= "error"><?php echo $error_email; ?></div>
                      <?php endif ?>

                    <p>
                      <label for="password">Mot de passe:</label>
                     <input type = "password" name = "password">
                    </p>
                     

                    <p>
                      <label for="confirm_password">Confirmer mot de passe:</label>
                      <input type = "password" name = "confirm_password">
                    </p>
                     <?php if (!empty($error_confirm_password)): ?>
                        <div class= "error"><?php echo $error_confirm_password; ?></div>
                      <?php endif ?>

                    <p>
                      <label for= "bio"></label>
                      <textarea cols=30 rows=15 name="bio"><?php echo $_SESSION['user']['bio'] ?></textarea>
                    </p>
                     <?php if (!empty($error_avatar)): ?>
                       <div class= "error"><?php echo $error_avatar; ?></div>
                      <?php endif ?>
                    <p>
                     <label for= "avatar">avatar:</label>
                     <input type = "file" name = "avatar">
                    </p>

                    <p>
                     <input type="submit" name= "valider">
                    </p>
                    
                  </form>
                   
              
          </div><!-- fin box_profil -->
  			</div><!-- fin article -->  
        </div> <!-- fin contenuPage -->
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