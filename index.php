<?php
include 'php/action_like.php';
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
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="Sonia Reuter | Passionnée par le développement web front-end et back-end. Vous cherchez un développeur web full stack à Nantes? Bienvenue mon site!">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/normalize.css">
  <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://kit.fontawesome.com/e0e29b4f97.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="jquery.lineProgressbar.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js" defer></script>
  <script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=es6%2CArray.isArray%2CArray.of%2CArray.from%2CArray.prototype.filter%2CArray.prototype.find%2CArray.prototype.findIndex%2CArray.prototype.forEach%2CArray.prototype.includes%2CArray.prototype.indexOf%2CArray.prototype.keys%2CArray.prototype.lastIndexOf%2CArray.prototype.map%2CArray.prototype.reduce%2CArray.prototype.some%2CArray.prototype.sort%2CDate.now%2CElement.prototype.after%2CElement.prototype.append%2CElement.prototype.before%2CElement.prototype.classList%2CElement.prototype.cloneNode%2CElement.prototype.nextElementSibling%2CElement.prototype.placeholder%2CElement.prototype.previousElementSibling%2CElement.prototype.remove%2CElement.prototype.replaceWith%2CElement.prototype.scroll%2CElement.prototype.scrollBy%2CElement.prototype.scrollIntoView%2CElement.prototype.toggleAttribute%2CHTMLDocument%2CJSON%2CMap%2CMath.trunc%2CNumber.isInteger%2CNumber.isFinite%2CNumber.isNaN%2CNumber.parseFloat%2CNumber.parseInt%2CObject.assign%2CObject.create%2CObject.keys%2CObject.values%2CPromise%2CPromise.prototype.finally%2CString.prototype.fontcolor%2CString.prototype.fontsize%2CString.prototype.includes%2CString.prototype.italics%2CString.prototype.link%2CString.prototype.replaceAll%2CString.prototype.trim%2CWindow%2CXMLHttpRequest%2Cdocument%2Cdocument.getElementsByClassName%2Cdocument.querySelector%2Cdocument.visibilityState%2Cfetch%2CgetComputedStyle%2CinnerHeight%2CinnerWidth%2CpageXOffset%2CpageYOffset%2CrequestAnimationFrame%2Cscroll%2CscrollBy%2CscrollIntoView%2CscrollX%2CscrollY%2Csmoothscroll%2Cviewport%2Cwindow.scroll%2Cwindow.scrollBy" defer></script>
  <script src="script.js" type="text/javascript" defer></script>
  <title>Sonia Reuter - Développeuse Web Full Stack</title>
</head>
<body>
  <!-- Loader -->
  <div class="loader">
    <i class="fa fa-spinner fa-10x fa-pulse"></i>
  </div>
  <header>
    <nav>
      <input type="checkbox" class="navigationCheckbox" id="navi" onclick="solve()">
      <label for="navi" class="navigationBtn">
        <span class="navigationIcon">&nbsp;</span>
      </label>
      <div class="navigationBg">&nbsp;</div>
      <div class="nav">
        <ul class="menu">
          <a href="#a-propos" class="notbigger" data-anim="6"><li>A Propos</li></a>
          <a href="#competences" class="notbigger" data-anim="7"><li>Compétences</li></a>
          <a href="#parcours" class="notbigger" data-anim="8"><li>Parcours</li></a>
          <a href="#realisations" class="notbigger" data-anim="9"><li>Réalisations</li></a>
          <a href="#contact" class="notbigger" data-anim="10"><li>Contact</li></a>
        </ul>
      </div>
    </nav>
  </header>
  <main>
    <section id="a-propos" data-anim="6">
      <!-- A PROPOS -->
      <div class="container">
        <div class="slider2">
          <!-- SLIDE 1 -->
          <div class="slide active" id="slide1">
            <div class="sliders">
              <div class="moi"></div>
              <div class="aside">
                <p id="writer1">Salut, moi c'est Sonia.</p>
                <p>Je vis à Nantes et j'ai <span id="age"></span> ans.</p>
                <div class="carrousel">
                  <div class="preText">Je suis une développeuse web</div>
                  <div class="changeHidden">
                    <div class="contenant">
                      <div class="element">passionnée</div>
                      <div class="element">créative</div>
                      <div class="element">full stack</div>
                      <div class="element">passionnée</div>
                    </div>
                  </div>
                </div>
                <p class="slideTitle">Mon leitmotiv: développer un site web responsive et le rendre unique<br><br>Bienvenue!</p>
              </div>
            </div>
          </div>
          <!-- SLIDE 2 -->
          <div class="slide" id="slide2">
            <div class="sliders">
              <div class="moi"></div>
              <div class="aside">
                <p>Quand je ne suis pas en train de coder j'aime :</p>
                <ul class="fa-ul">
                  <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>jouer avec mes chats</li><br>
                  <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>faire des randonnées en roller, parfois tomber, me relever</li><br>
                  <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>faire des virées à vélo avec mes amis</li><br>
                  <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>cuisiner des plats vegans, et en réussir certains</li>
                </ul>
                <div>
                  <q>Il n'y a qu'une façon d'échouer, c'est d'abandonner avant d'avoir réussi</q>
                  <cite> Georges Clémenceau</cite>
                </div>
              </div>
            </div>
          </div>
          <!-- SLIDE 3 -->
          <div class="slide" id="slide3">
            <div class="sliders">
              <div class="moi"></div>
              <div class="aside">
                <p id="writer2">Pour moi le développement web c'est : trouver des solutions, se dépasser, apprendre sans cesse.<br>
                </p>
                <p>Mon site est responsive et respecte les standards du web.</p>
                <p>Je suis disponible pour d'autres projets de création de site web.</p>
                <p>Visitez <a href="https://linkedin.com/in/sonia-reuter-127490a3" target="_blank">mon profil Linkedln</a> ou <a href="#contact">contactez-moi</a> pour plus de détails.</p>
              </div>
            </div>
          </div>
        </div>
        <i class="fas fa-chevron-left"></i>
        <i class="fas fa-chevron-right"></i>
        <div class="cont-btn">
          <i class="far fa-circle" data-position="0"></i>
          <i class="fas fa-circle" data-position="1"></i>
          <i class="fas fa-circle" data-position="2"></i>
        </div>
      </div>
      <!-- BOUTON DOWN -->
      <div class="stageContainer">
        <div class="stage">
          <div class="box-down bounce">
            <a href="#competences"><i class="fas fa-chevron-down"></i></a>
          </div>
        </div>
      </div>
    </section>
    <section id="competences" data-anim="7">
      <!-- COMPETENCES -->
      <h2>Compétences</h2>
      <div class="circle">
        <div>
          <svg class="radial-progress" data-percentage="100" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">100%</text>
          </svg>
          <p class="lang">Html</p>
        </div>
        <div>
          <svg class="radial-progress" data-percentage="95" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">95%</text>
          </svg>
          <p class="lang">Css3</p>
        </div>
        <div>
          <svg class="radial-progress" data-percentage="70" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">70%</text>
          </svg>
          <p class="lang">Javascript</p>
        </div>
        <div>
          <svg class="radial-progress" data-percentage="85" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">85%</text>
          </svg>
          <p class="lang">Jquery</p>
        </div>
        <div>
          <svg class="radial-progress" data-percentage="60" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">60%</text>
          </svg>
          <p class="lang">Php</p>
        </div>
        <div>
          <svg class="radial-progress" data-percentage="75" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">75%</text>
          </svg>
          <p class="lang">Git</p>
        </div>
      </div>
      <div class="progbar">
        <div class="flex-bar">
          <div id="nodeJs"></div>
          <p>NodeJs</p>
        </div>
        <div class="flex-bar">
          <div id="mySql"></div>
          <p>MySQL</p>
        </div>
        <div class="flex-bar">
          <div id="less"></div>
          <p>Less</p>
        </div>
        <div class="flex-bar">
          <div id="vueJs"></div>
          <p>VueJS</p>
        </div>
      </div>

      <!-- BOUTON UP -->
      <i class="fas fa-chevron-circle-up up-button"></i>
    </section>
    <section id="parcours" data-anim="8">
      <!-- PARCOURS -->
      <h2>Parcours</h2>
      <div class="box-timeline">
        <div class="ligne"></div>
        <div class="rondEven r1" data-anim="1"><i class="fas fa-user-graduate"></i></div>
        <div class="rondOdd r2" data-anim="2"><i class="fas fa-graduation-cap"></i></div>
        <div class="rondEven r3" data-anim="3"><i class="fas fa-laptop-house"></i></div>
        <div class="rondOdd r4" data-anim="4"><i class="fas fa-laptop-code"></i></div>
        <div class="rondEven r5" data-anim="5"><i class="fas fa-user-tie"></i></div>

        <div class="boxEven b1" data-anim="1">
          <time datetime="2015">2015</time>
          <h3>Maîtrise LEA Anglais – Allemand orientée Commerce International – Nantes</h3>
          <p>Marketing, Gestion de projet et rédaction d’un cahier des charges, Typologie des Consommateurs et Comportements d’achat</p>
        </div>
        <div class="boxOdd b2" data-anim="2">
          <time datetime="2018">2018</time>
          <h3>Formation "Développeur intégrateur en réalisation d’applications Web" - 3W Academy – Nantes</h3>
          <p>HTML5, CSS3, Javascript, PHP</p>
        </div>
        <div class="boxEven b3" data-anim="3">
          <time datetime="2018">2018 jusqu'à aujourd'hui</time>
          <h3>Autoformation en continu - Openclassroom - FreeCodeCamp</h3>
          <p>Modules : Responsive web design, SASS, JS, Jquery, PHP, MySQL, NodeJS, ExpressJS, Git</p>
        </div>
        <div class="boxOdd b4" data-anim="4">
          <time datetime="2019">2019</time>
          <h3>Formation POEI "Développeur interface embarquée" - Ecole Centrale de Nantes</h3>
          <p>Javascript, NodeJS, VueJS, ExpressJs, Grunt, Git</p>
        </div>
        <div class="boxEven b5" data-anim="5">
          <time datetime="2019">2019</time>
          <h3>"Développeur d'Application Embarquée" - Wiztivi- Carquefou</h3>
          <p>Développement d’applications pour les TV connectées et Set-Top box.</p>
          <p>Projet Vodafone: Développement d'une application embarquée pour Box TV en mode Agile</p>
          <ul class="fa-ul">
            <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>Maintenance corrective de l’application</li>
            <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>Analyse de traces réseaux</li>
            <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>Code review</li>
            <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>Tests unitaires et de non-régression</li>
            <li><span class="fa-li"><i class="fas fa-map-pin"></i></span>Découpage des spécifications en user stories et estimation des tâches (poker planning)</li>
          </ul>
          <p>Less, Javascript, NodeJS, Grunt, Jira,<br> Confluence, Gerrit, Wireshark</p>
        </div>
      </div>
    </section>
    <section id="realisations" data-anim="9">
      <!-- REALISATIONS -->
      <h2>Réalisations</h2>
      <form class="buttons" action="#realisations" method="post">
        <button name="all" class="draw">TOUT</button>
        <button name="css" class="draw">Css</button>
        <button name="js" class="draw">Javascript</button>
        <button name="jquery" class="draw">Jquery</button>
        <button name="php" class="draw">Php</button>
        <button name="sql" class="draw">Sql</button>
      </form>
      <div class="portefolio">
        <?php
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['php']) || isset($_POST['sql']) || isset($_POST['all']))
        echo
        '<a href="restaurant/" target="_blank">
          <div id="1" class="divMaj">
            <div class="div1">
              <img src="img/restaurant.png" alt="Site Restaurant">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>PHP</div>
                <div>SQL</div>
              </div>
            </div>
            <h6>Site Restaurant</h6>
            <div class="anotation">
              <a href="#1"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['php']) || isset($_POST['sql']) || isset($_POST['all'])) echo'
        <a href="tableau_dynamique/" target="_blank">
          <div id="2" class="divMaj">
            <div class="div1">
              <img src="img/tableauDynamique.png" alt="Tableau Dynamique">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>PHP</div>
                <div>SQL</div>
              </div>
            </div>
            <h6>Tableau Dynamique</h6>
            <div class="anotation">
              <a href="#2"><i class="far fa-heart"></i></a>
              <span class="compteur"><span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['php']) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="todolist/" target="_blank">
          <div id="3" class="divMaj">
            <div class="div1">
              <img src="img/todolist.png" alt="To Do List">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>PHP</div>
              </div>
            </div>
            <h6>To Do List</h6>
            <div class="anotation">
                <a href="#3"><i class="far fa-heart"></i></a>
              <span class="compteur"><span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['php']) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="traducteur/" target="_blank">
          <div id="4" class="divMaj">
            <div class="div1">
              <img src="img/traducteur.png" alt="Traducteur">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>PHP</div>
              </div>
            </div>
            <h6>Traducteur</h6>
            <div class="anotation">
            <a href="#4"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['php']) || isset($_POST['jquery']) || isset($_POST['css']) || isset($_POST['all']))
        echo'
        <a href="ajax/" target="_blank">
          <div id="5" class="divMaj">
            <div class="div1">
              <img src="img/ajax.png" alt="Réalisation Ajax">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JQUERY</div>
                <div>PHP</div>
                <div>AJAX</div>
              </div>
            </div>
            <h6>Réalisation Ajax</h6>
            <div class="anotation">
              <a href="#5"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['sql']) || isset($_POST['php']) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a class="css php sql" href="blog/" target="_blank">
          <div id="6" class="divMaj">
            <div class="div1">
              <img src="img/blog.png" alt="Blog 1">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>PHP</div>
                <div>SQL</div>
              </div>
            </div>
            <h6>Blog 1</h6>
            <div class="anotation">
              <a href="#6"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['sql']) || isset($_POST['php']) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="blog2/" target="_blank">
          <div id="7" class="divMaj">
            <div class="div1">
              <img src="img/blog2.png" alt="Blog 2">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>PHP</div>
                <div>SQL</div>
              </div>
            </div>
            <h6>Blog 2</h6>
            <div class="anotation">
              <a href="#7"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['sql']) || isset($_POST['php']) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="bonsDeCommande/" target="_blank">
          <div id="8" class="divMaj">
            <div class="div1">
              <img src="img/bonsDeCommande.png" alt="Bons De Commande">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>PHP</div>
                <div>SQL</div>
              </div>
            </div>
            <h6>Bons De Commande</h6>
            <div class="anotation">
              <a href="#8"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['sql']) || isset($_POST['php']) || isset($_POST['all'])) echo'
        <a href="chat/" target="_blank">
          <div id="9" class="divMaj">
            <div class="div1">
              <img src="img/chat.png" alt="Mini Chat">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>PHP</div>
                <div>SQL</div>
              </div>
            </div>
            <h6>Mini Chat</h6>
            <div class="anotation">
              <a href="#9"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['sql']) || isset($_POST['php']) || isset($_POST['all'])) echo'
        <a href="espace_membres/" target="_blank">
          <div id="10" class="divMaj">
            <div class="div1">
              <img src="img/espaceMembres.png" alt="Espace Membres">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>PHP</div>
                <div>SQL</div>
              </div>
            </div>
            <h6>Espace Membres</h6>
            <div class="anotation">
              <a href="#10"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['php']) || isset($_POST['all'])) echo'
        <a href="glace/" target="_blank">
          <div id="11" class="divMaj">
            <div class="div1">
              <img src="img/glace.png" alt="Composition de glaçe">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>PHP</div>
              </div>
            </div>
            <h6>Compose ta glaçe !</h6>
            <div class="anotation">
              <a href="#11"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['php']) || isset($_POST['all'])) echo'
        <a href="livre_dor/" target="_blank">
          <div id="12" class="divMaj">
            <div class="div1">
              <img src="img/livreDor.png" alt="Livre d\'or">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>PHP</div>
              </div>
            </div>
            <h6>Livre d\'or</h6>
            <div class="anotation">
              <a href="#12"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['js']) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="parallax/" target="_blank">
          <div id="13" class="divMaj">
            <div class="div1">
              <img src="img/parallax.png" alt="Intégration parallax">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
              </div>
            </div>
            <h6>Intégration Parallax</h6>
            <div class="anotation">
              <a href="#13"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="Zozor/" target="_blank">
          <div id="14" class="divMaj">
            <div class="div1">
              <img src="img/zozor.png" alt="Intégration Zozor">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
              </div>
            </div>
            <h6>Intégration Zozor</h6>
            <div class="anotation">
              <a href="#14"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="Wolf_Gang/" target="_blank">
          <div id="15" class="divMaj">
            <div class="div1">
              <img src="img/wolfGang.png" alt="Intégration Wolf Gang">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Intégration Wolf Gang</h6>
            <div class="anotation">
              <a href="#15"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="MindGeek/" target="_blank">
          <div id="16" class="divMaj">
            <div class="div1">
              <img src="img/mindGeek.png" alt="Intégration Mind Geek">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
              </div>
            </div>
            <h6>Intégration Mind Geek</h6>
            <div class="anotation">
              <a href="#16"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="Cup_of_tea/" target="_blank">
          <div id="17" class="divMaj">
            <div class="div1">
              <img src="img/cupOfTea.png" alt="Intégration Cup of tea">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Intégration Cup of tea</h6>
            <div class="anotation">
              <a href="#17"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="miseEnPage/" target="_blank">
          <div id="18" class="divMaj">
            <div class="div1">
              <img src="img/miseEnPage.png" alt="Mise en forme d\'une page">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Change la mise en forme d\'une page web!</h6>
            <div class="anotation">
              <a href="#18"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="rechercheFiltree/" target="_blank">
          <div id="19" class="divMaj">
            <div class="div1">
              <img src="img/rechercheFiltree.png" alt="Filtre de recherche">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Filtre de recherche</h6>
            <div class="anotation">
              <a href="#19"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a href="conversion/" target="_blank">
          <div id="20" class="divMaj">
            <div class="div1">
              <img src="img/conversion.png" alt="Application de conversion">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
              </div>
            </div>
            <h6>Application de conversion</h6>
            <div class="anotation">
              <a href="#20"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="carnetDadresse/" target="_blank">
          <div id="21" class="divMaj">
            <div class="div1">
              <img src="img/carnetDadresse.png" alt="Carnet D\'adresse">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Carnet D\'adresse</h6>
            <div class="anotation">
              <a href="#21"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['jquery']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a href="drag_n_drop/" target="_blank">
          <div id="22" class="divMaj">
            <div class="div1">
              <img src="img/dragNdrop.png" alt="Drag\'n Drop">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Différents Drag\'n Drop!</h6>
            <div class="anotation">
              <a href="#22"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a href="applicationMeteo/" target="_blank">
          <div id="23" class="divMaj">
            <div class="div1">
              <img src="img/applicationMeteo.png" alt="Application météo">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
              </div>
            </div>
            <h6>Application météo</h6>
            <div class="anotation">
              <a href="#23"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a href="github/" target="_blank">
          <div id="24" class="divMaj">
            <div class="div1">
              <img src="img/github.png" alt="Github">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>AJAX</div>
              </div>
            </div>
            <h6>Recherche Github</h6>
            <div class="anotation">
              <a href="#24"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a href="ardoiseMagique/" target="_blank">
          <div id="25" class="divMaj">
            <div class="div1">
              <img src="img/ardoiseMagique.png" alt="Ardoise Magique">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
              </div>
            </div>
            <h6>Ardoise Magique</h6>
            <div class="anotation">
              <a href="#25"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="mini_jeux/" target="_blank">
          <div id="26" class="divMaj">
            <div class="div1">
              <img src="img/miniJeux.png" alt="Mini Jeux">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Mini Jeux</h6>
            <div class="anotation">
              <a href="#26"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="mini_jeux2/" target="_blank">
          <div id="27" class="divMaj">
            <div class="div1">
              <img src="img/miniJeux2.png" alt="Mini Jeux 2">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Mini Jeux 2</h6>
            <div class="anotation">
              <a href="#27"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a href="scrollInfini/" target="_blank">
          <div id="28" class="divMaj">
            <div class="div1">
              <img src="img/scrollInfini.png" alt="Scroll infini">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
              </div>
            </div>
            <h6>Scroll infini</h6>
            <div class="anotation">
              <a href="#28"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="animations_css/" target="_blank">
          <div id="29" class="divMaj">
            <div class="div1">
              <img src="img/animationsCss.png" alt="Animations CSS">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
              </div>
            </div>
            <h6>Animations CSS</h6>
            <div class="anotation">
              <a href="#29"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="animations_css2/" target="_blank">
          <div id="30" class="divMaj">
            <div class="div1">
              <img src="img/animationsCss2.png" alt="Animations CSS bis">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
              </div>
            </div>
            <h6>Animations CSS bis</h6>
            <div class="anotation">
              <a href="#30"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="animations_js_jquery/" target="_blank">
          <div id="31" class="divMaj">
            <div class="div1">
              <img src="img/animationsJs.png" alt="Animations JS et Jquery">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Animations JS et JQUERY</h6>
            <div class="anotation">
              <a href="#31"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a href="diaporamas/" target="_blank">
          <div id="32" class="divMaj">
            <div class="div1">
              <img src="img/diaporamas.png" alt="Diaporamas">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
              </div>
            </div>
            <h6>Diaporamas</h6>
            <div class="anotation">
              <a href="#32"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['jquery']) || isset($_POST['all'])) echo'
        <a href="questionnaires/" target="_blank">
          <div id="33" class="divMaj">
            <div class="div1">
              <img src="img/questionnaires.png" alt="Questionnaires">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
                <div>JQUERY</div>
              </div>
            </div>
            <h6>Questionnaires - Formulaires</h6>
            <div class="anotation">
              <a href="#33"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="loaders/" target="_blank">
          <div id="34" class="divMaj">
            <div class="div1">
              <img src="img/loaders.png" alt="Divers loaders">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
              </div>
            </div>
            <h6>Loaders</h6>
            <div class="anotation">
              <a href="#34"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a href="menus/" target="_blank">
          <div id="35" class="divMaj" id="35">
            <div class="div1">
              <img src="img/menus.png" alt="Divers Menus">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
              </div>
            </div>
            <h6>Menus</h6>
            <div class="anotation">
              <a href="#35"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['js']) || isset($_POST['all'])) echo'
        <a class="css js" href="buttons/" target="_blank">
          <div id="36" class="divMaj">
            <div class="div1">
              <img src="img/buttons.png" alt="Divers Boutons">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>CSS</div>
                <div>JS</div>
              </div>
            </div>
            <h6>Boutons</h6>
            <div class="anotation">
              <a href="#36"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>';
        if(((empty($_POST)) || isset($_POST['button'])) || isset($_POST['css']) || isset($_POST['all'])) echo'
        <a class="css" href="neomorphism/" target="_blank">
        <div id="37" class="divMaj">
            <div class="div1">
              <img src="img/neomorphism.png" alt="Néomorphisme">
            </div>
            <div class="div2">
              <i class="far fa-eye"></i>
              <div class="flex-lang">
                <div>HTML</div>
                <div>CSS</div>
              </div>
            </div>
            <h6>Néomorphisme</h6>
            <div class="anotation">
              <a href="#37"><i class="far fa-heart"></i></a>
              <span class="compteur"></span>
            </div>
          </div>
        </a>'?>
      </div>
    </section>
    <section id="contact" data-anim="10">
      <!-- CONTACT -->
      <h2>Contact</h2>
      <div class="contact-grid">
        <div class="fadeInAnim contact-flex">
          <div class="info-flex">
            <h3>Pour me contacter directement:</h3>
            <address>
              <div class="envelope">
                <i class="fas fa-envelope"></i>
                <a href="mailto:sonia.reuter.pro@gmail.com">sonia.reuter.pro@gmail.com</a>
              </div>
              <div class="phone">
                <i class="fas fa-phone"></i>
                <a href="tel:+133661127279">(+33)6 61 13 72 79</a>
              </div>
              <div class="marker">
                <i class="fas fa-map-marker-alt"></i>
                <p>Sonia Reuter Nantes - Centre</p>
              </div>
            </address>
          </div>
          <div class="media-flex">
            <h3>Pour me suivre:</h3>
            <div class="social-media">
              <a href="https://linkedin.com/in/sonia-reuter-127490a3" target="_blank" class="bigIcon"><i class="fab fa-linkedin-in"></i></a>
              <a href="https://github.com/Sreuter29?tab=repositories" target="_blank" class="bigIcon"><i class="fab fa-github"></i></a>
            </div>
          </div>
        </div>
        <div class="fadeInAnim">
          <form action="index.php#contact" method="post">
            <div class="grid-form">
              <h3 id="question">Vous voulez que l'on travaille ensemble ou vous avez une question?</h3>
              <input type="text" name="nom" id="nom" placeholder='<?= isset($nomInfo) ? $nomInfo : "Nom";?>' required>
              <input type="email" name="email" id="email" placeholder="<?= isset($emailInfo) ? $emailInfo : 'E-mail';?>" required  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
              <input type="text" name="objet" id="objet" placeholder="<?= isset($objetInfo) ? $objetInfo : 'Objet';?>" required>
              <textarea name="message" placeholder="<?= isset($messageInfo) ? $messageInfo : 'Votre message';?>" cols="8" rows="11" required><?= isset($messageRetour) ? $messageRetour : null; ?></textarea>

              <button name="button" class="send-button">
               <span class="text">Envoyer</span>
                <span class="icon-wrapper">
                  <span class="icon-1 far fa-paper-plane"></span>
                  <span class="icon-2 fas fa-check"></span>
                  <span class="icon-3 fas fa-exclamation-circle"></span>
                </span>
              </button>
            </div>
          </form>
        </div>
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2710.1674526744723!2d-1.5604041848622365!3d47.21330572305741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4805eea879ba9903%3A0x3cf25db597d1c078!2sPlace%20du%20Commerce%2C%2044036%20Nantes!5e0!3m2!1sfr!2sfr!4v1588932102045!5m2!1sfr!2sfr" width="auto" height="100%" frameborder="0" style="border:0;" allowfullscreen="false" aria-hidden="false"></iframe>
        </div>
      </div>
    </section>
  </main>
</body>
</html>
