<?php
include('action_like.php');

// Traitement Formulaire
if(isset($_POST['button'])) {
  sleep(2);
  $nom = strip_tags($_POST['nom']);
  $email =  htmlspecialchars($_POST['email']);
  $objet = htmlspecialchars($_POST['objet']);
  $message = htmlspecialchars($_POST['message']);
  // (Windows uniquement) Lorsque PHP discute directement avec un serveur SMTP, si un point est trouvé en début de ligne, il sera supprimé. Pour éviter ce comportement, remplacez ces occurrences par un double point.
  $message = str_replace("\n.", "\n..", $message);
  // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
  $message = wordwrap($message, 70, "\r\n");
  $email_to = "sonia.reuter.pro@gmail.com";
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,4}$/';
  $string_exp = "/^[A-Za-z0-9 .'-]+$/";
  $nomInfo = null;
  $emailInfo = null;
  $objetInfo = null;
  $messageInfo = null;
  $messageRetour = null;

  if(!empty($nom) && !empty($email) && !empty($objet) && !empty($message)) {
    if(!preg_match($string_exp,$nom)) {
      $nomInfo = 'Le nom entré est invalide.';
    }
    if(!preg_match($email_exp,$email)) {
      $emailInfo = 'L\'adresse e-mail est invalide.';
    }
    if(strlen($objet) < 2) {
      $objetInfo = 'L\'objet que vous avez entré ne semble pas être valide.';
    }
    if(strlen($message) < 2) {
      $messageInfo = 'Le message que vous avez entré ne semble pas être valide.';
    }
    if(!isset($messageInfo) && !isset($nomInfo) && !isset($emailInfo) && !isset($objetInfo)) {
      $email_message = "Nom: ".$nom."\n";
      $email_message .= "Objet: ".$objet."\n";
      $email_message .= "Email: ".$email."\n";
      $email_message .= "Message: ".$message."\n";

      $headers = 'From: '.$email."\r\n".
      'Reply-To: '.$email."\r\n" .
      'X-Mailer: PHP/' . phpversion();
      $retour = mail($email_to, $objet, $email_message, $headers);
      if($retour) {
        $messageRetour = 'Votre message a bien été envoyé.';
      } else {
        $messageRetour = "L'envoi de votre message a échoué". error_get_last()['message'];
      }
    }
  }
}

require('view.php');
?>
