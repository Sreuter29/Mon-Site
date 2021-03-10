<?php
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=tableau_dynamique;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}

if(isset($_GET['id']) AND !empty($_GET['id'])) {
  $getid = (int) htmlspecialchars($_GET['id']);
  $ins = $bdd->prepare('INSERT INTO likes (element_id) VALUES (?)');
  $ins->execute([$getid]);

  $like = $bdd->prepare('SELECT * FROM likes WHERE element_id = ?');
  $like->execute([$getid]);
  $likes = $like->rowCount();
  $like->closeCursor();

  if($likes < 999999999999){
    $ins2 = $bdd->prepare('UPDATE elements SET like_count = :likes WHERE id = :getid');
    $ins2->execute(["likes" => $likes, "getid" => $getid]);
  } else {
    $ins2 = $bdd->prepare('UPDATE elements SET like_count = :likes WHERE id = :getid');
    $ins2->execute(["likes" => +999999999999, "getid" => $getid]);
  }

  $likeToDisplay = $bdd->prepare('SELECT like_count FROM elements WHERE id = ?');
  $likeToDisplay->execute([$getid]);
  $likes = $likeToDisplay->fetch();
  $likeToDisplay->closeCursor();
  echo $likes['like_count'];
}

if(isset($_POST['idHtml']) AND !empty($_POST['idHtml'])) {
  $idHtml = $_POST['idHtml'];
  $likeToDisplay = $bdd->prepare('SELECT like_count FROM elements WHERE id = ?');
  $likeToDisplay->execute([$idHtml]);
  $likes = $likeToDisplay->fetch();
  $likeToDisplay->closeCursor();
  echo $likes['like_count'];
}
?>
