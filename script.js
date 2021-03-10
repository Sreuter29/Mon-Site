// Animation soulignage des titres du menu au défilement

window.addEventListener("load", function(){

  // TIMELINE Animation
  const navigationMenus = document.querySelectorAll('nav ul a');
  const sections = document.querySelectorAll('section');

  const controller = new ScrollMagic.Controller()

  navigationMenus.forEach(menu => {
    for(i = 0; i < sections.length; i++){
      if(sections[i].getAttribute('data-anim') === menu.getAttribute('data-anim')){

        let tween1 = gsap.to(menu, {color: "#FF2020", opacity: 0.9, duration: 0.5})
        let scene = new ScrollMagic.Scene({
          triggerElement: sections[i],
          reverse: true
        })
        .setTween(tween1)
        // .addIndicators()
        .addTo(controller)
      }
    }
  })
  navigationMenus.forEach(menu => {
    if(menu.previousElementSibling) {
      var previousSibling = menu.previousElementSibling;
      for(i = 0; i < sections.length; i++){
        if(sections[i].getAttribute('data-anim') === menu.getAttribute('data-anim')){
          let tween2 = gsap.to(previousSibling, {color: "#000", duration: 0.5})
          let scene = new ScrollMagic.Scene({
            triggerElement: sections[i],
            reverse: true
          })
          .setTween(tween2)
          // .addIndicators()
          .addTo(controller)
        }
      }
    }
  })
});

// LOADER
const loader = document.querySelector('.loader');
const nav = document.querySelector('nav');
const body = document.querySelector('body');

if(!loader.classList.contains('fondu-out')) {
  nav.style.position = 'static';
  body.style.overflow = 'hidden';
}
window.addEventListener('load', () => {
  loader.classList.add('fondu-out');
  nav.style.position = 'fixed';
  body.style.overflow = 'visible';
  body.style.overflowX = 'hidden';
})

// Animation smooth bouton UP
window.addEventListener('load', function () {
  const upButton = document.querySelector('.up-button');
  upButton.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: "smooth"
    });
  });
});

// Animation smooth liens ancre (ex:menu)
$(document).ready(function() {
  $('a[href^="#"]').click(function() {
    cible = $(this).attr('href');
    if ($(cible).length >= 1) {
      hauteur = $(cible).offset().top;
    }
    $('html, body').animate({scrollTop:hauteur},2000);
    $('.navigationCheckbox').prop('checked', false);
    return false;
  })
});

//Bug chevron gauche du slider en max-width: 860px qui répond au menu burger caché - pb de zindex
const chevronLeft = document.querySelector('.fa-chevron-left');
if(document.querySelector('.navigationCheckbox').checked == false){
  chevronLeft.style.zIndex = "960";
}
function solve() {
  if(document.querySelector('.navigationCheckbox').checked == true){
    chevronLeft.style.zIndex = "1";
  }
}

// GRAND SLIDER
const items = document.querySelectorAll('.slider2 .slide');
const dots = document.querySelectorAll('.fa-circle');
const slide1 = document.querySelector('#slide1');
const slide3 = document.querySelector('#slide3');
const nbSlide = items.length;
const suivant = document.querySelector('.fa-chevron-right');
const precedent2 = document.querySelector('.fa-chevron-left');
let count = 0;

dots.forEach((element, i) => {
  element.addEventListener('click', (e) => {
    if(element.classList.contains('far')){
      return;
    } else {
      element.classList.remove('fas');
      element.classList.add('far');
    }

    for(var j = 0; j < items.length; j++ ) {
      if(items[j].classList.contains('active')){
        items[j].classList.remove('active');
      }
    }
    items[i].classList.add('active');

    index = element.getAttribute('data-position');
    count = index;
    for(x = 0; x < dots.length; x++){
      if(dots[x].getAttribute('data-position') != index){
        dots[x].classList.remove('far');
        dots[x].classList.add('fas');
      } else {
        dots[x].classList.remove('fas');
        dots[x].classList.add('far');
      }
    }

    if(slide1.classList.contains('active')){
      write1();
    }

    if(slide3.classList.contains('active')){
      write2();
    }
  });
});

function slideSuivante(){
  items[count].classList.remove('active');

  if(dots[count].classList.contains('far')){
    dots[count].classList.remove('far');
    dots[count].classList.add('fas');
  }

  if(count < nbSlide - 1){
    count++;
  } else {
    count = 0;
  }

  items[count].classList.add('active');
  dots[count].classList.remove('fas');
  dots[count].classList.add('far');

  if(slide1.classList.contains('active')){
    write1();
  }

  if(slide3.classList.contains('active')){
    write2();
  }
}
suivant.addEventListener('click', slideSuivante)

function slidePrecedente(){
  items[count].classList.remove('active');

  if(dots[count].classList.contains('far')){
    dots[count].classList.remove('far');
    dots[count].classList.add('fas');
  }

  if(count > 0){
    count--;
  } else {
    count = nbSlide - 1;
  }

  items[count].classList.add('active');
  dots[count].classList.remove('fas');
  dots[count].classList.add('far');

  if(slide1.classList.contains('active')){
    write1();
  }

  if(slide3.classList.contains('active')){
    write2();
  }

}
precedent2.addEventListener('click', slidePrecedente)

function keyPress(e){
  if(e.keyCode === 37){
    slidePrecedente();
  } else if(e.keyCode === 39){
    slideSuivante();
  }
}
document.addEventListener('keydown', keyPress)

//AGE ANNIVERSAIRE
const birthDay = Date.parse('July 11, 1989');
const now = Date.now();
const age = Math.floor((now - birthDay) / 31622400000);
document.querySelector("#age").textContent = age;

/**
* Anime un titre avec un effet d'apparition mot par mot de bas en haut
*
* @param {string} selector
**/
function animateTitle(selector) {
  const title = document.querySelector(selector);
  if (title === null) {
    console.error("Impossible de trouver l'élément" + selector);
    return;
  };

  const children = Array.from(title.childNodes);
  let elements = [];
  children.forEach(child => {
    if (child.nodeType === Node.TEXT_NODE) {
      const words = child.textContent.split(' ');
      let spans = words.map(wrapWord);
      elements = elements.concat(
        injectElementBetweenItems(spans, document.createTextNode(' '))
      )
    } else {
      elements.push(child);
    }
  });

  // Injecte les éléments dans title
  title.innerHTML = "";
  elements.forEach(el => {
    title.appendChild(el);
  });

  Array.from(title.querySelectorAll('span span')).forEach((span, i) => {
    span.style.animationDelay = (i * .4) + 's';
  });
};

/**
* Entoure le mot de deux <span>
*
* @param  {string} word
*/
function wrapWord(word) {
  const span = document.createElement('span');
  const span2 = document.createElement('span');
  span.appendChild(span2);
  span2.innerHTML = word;
  return span;
}


/**
* injectElementBetweenItems
*
* @param  {Node[]} arr
* @param  {Node} element élément à injecter entre chaque élément du tableau
* @return {Node[]}
*/
function injectElementBetweenItems (arr, element) {
  return arr.map((item, i) => {
    if(i === arr.length-1) {
      return [item]
    }
    return [item, element.cloneNode()]
  }).reduce((acc, pair) => {
    acc = acc.concat(pair);
    return acc;
  }, [])
}

animateTitle('.slideTitle')

// Animation d'écriture lettre par lettre
const writer1 = document.getElementById("writer1");
function write1() {
  new Typewriter(writer1, {
  })
  .changeDelay(35)
  .typeString('Salut, ')
  .pauseFor(300)
  .typeString("moi c'est Sonia.")
  .start()
}
window.addEventListener('load', () => {
  if(slide1.classList.contains('active')){
    write1();
  }
})

const writer2 = document.getElementById("writer2");
function write2() {
  new Typewriter(writer2, {
    deleteSpeed: 20
  })
  .changeDelay(40)
  .typeString("Pour moi le développement web c'est : ")
  .pauseFor(400)
  .typeString("trouver des solutions")
  .pauseFor(400)
  .deleteChars(21)
  .pauseFor(400)
  .typeString("se dépasser")
  .pauseFor(400)
  .deleteChars(11)
  .pauseFor(400)
  .typeString("apprendre sans cesse.")
  .start()
}

// TIMELINE Animation
const allRondsEven = document.querySelectorAll('.rondEven');
const allRondsOdd = document.querySelectorAll('.rondOdd');
const allBoxesEven = document.querySelectorAll('.boxEven');
const allBoxesOdd = document.querySelectorAll('.boxOdd');

const controller = new ScrollMagic.Controller()

allBoxesEven.forEach(box => {
  for(i = 0; i < allRondsEven.length; i++){
    if(allRondsEven[i].getAttribute('data-anim') === box.getAttribute('data-anim')){
      let tween = gsap.from(box, {x: -150, opacity: 0, duration: 0.5})
      let scene = new ScrollMagic.Scene({
        triggerElement: box,
        reverse: false
      })
      .setTween(tween)
      // .addIndicators()
      .addTo(controller)
    }
  }
})

allBoxesOdd.forEach(box => {
  for(i = 0; i < allRondsOdd.length; i++){
    if(allRondsOdd[i].getAttribute('data-anim') === box.getAttribute('data-anim')){
      let tween = gsap.from(box, {x: 150, opacity: 0, duration: 0.5})
      let scene = new ScrollMagic.Scene({
        triggerElement: box,
        reverse: false
      })
      .setTween(tween)
      // .addIndicators()
      .addTo(controller)
    }
  }
})


// Competences
// Circles

$('svg.radial-progress').each(function( index, value ) {
  $(this).find($('circle.complete')).removeAttr('style' );
});

$(window).scroll(function(){
  $('svg.radial-progress').each(function( index, value ) {
    // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
    if (
      $(window).scrollTop() > $(this).offset().top - ($(window).height() * 0.75) &&
      $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0.25)
    ) {
      // Get percentage of progress
      percent = $(value).data('percentage');
      // Get radius of the svg's circle.complete
      radius = $(this).find($('circle.complete')).attr('r');
      // Get circumference (2πr)
      circumference = 2 * Math.PI * radius;
      // Get stroke-dashoffset value based on the percentage of the circumference
      strokeDashOffset = circumference - ((percent * circumference) / 100);
      // Transition progress for 1.25 seconds
      $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 1250);
    }
  });
}).trigger('scroll');

//Progress bar
(function($) {

  $('#nodeJs').LineProgressbar({
    percentage: 50,
    fillBackgroundColor: '#1abc9c',
    duration: 1250,
    height:'2rem',
    width:'100%',
    display: 'inline-block',
    radius: '0.3rem'
  });

  $('#mySql').LineProgressbar({
    percentage: 80,
    fillBackgroundColor: '#2ecc71',
    duration: 1250,
    height:'2rem',
    width:'100%',
    radius: '0.3rem'
  });

  $('#less').LineProgressbar({
    percentage: 80,
    fillBackgroundColor: '#9b59b6',
    duration: 1250,
    height:'2rem',
    width:'100%',
    radius: '0.3rem'
  });

  $('#vueJs').LineProgressbar({
    percentage: 50,
    fillBackgroundColor: '#34495e',
    duration: 1250,
    height:'2rem',
    width:'100%',
    radius: '0.3rem'
  });
})(jQuery);

// Animation like Coeur et gestion des likes

$(document).ready(function(){
  $(".fa-heart").each(function(){
    var heart = $(this);
    var idHtml = heart.parent().parent().parent().attr('id');
    var compteur = $(this).parent().next();
    $.ajax({
      url: "php/action_like.php",
      type: "POST",
      data : "idHtml=" + idHtml,
      success: function(data){
        compteur.text(data);
      },
      error: function(resultat, textStatus, errorThrown) {
        console.log("resultat: " + resultat + "Status error: " + textStatus + "Error: " + errorThrown);
        compteur.text("0");
      }
    });
  });

  $(".fa-heart").click(function(e){
    $(this).removeClass("far");
    $(this).addClass("fa");
    var idHtml = $(this).parent().parent().parent().attr('id');
    var compteur = $(this).parent().next();
    $.ajax({
      url: "php/action_like.php",
      type: "GET",
      data : "id=" + idHtml,
      success: function(data){
        compteur.text(data);
      },
      error: function(resultat, textStatus, errorThrown) {
        console.log("resultat: " + resultat + "Status error: " + textStatus + "Error: " + errorThrown);
        compteur.text("0");
      }
    });
  });
});

// Fade in Réalisations
window.addEventListener("load", function()
{
  const buttons = document.querySelectorAll('.buttons button');
  const paraph = document.querySelector('.b5').lastElementChild;
  const realisations = document.querySelector('.portefolio');
  const TL = gsap.timeline({paused:true});

  let tween = TL.staggerFrom(buttons, 0.2, {opacity: 0, ease: "power1.easeInOut"}, 0.3)
  let scene = new ScrollMagic.Scene({
    triggerElement: paraph,
    reverse: false
  })
  .setTween(tween)
  // .addIndicators()
  .addTo(controller)
});

// Fade in Contact
window.addEventListener("load", function()
{
  const lastRealisation = document.querySelector('.portefolio').lastElementChild;
  const lastHeart = lastRealisation.querySelector('.fa-heart');
  const contactElements = document.querySelectorAll ('.fadeInAnim');
  const TL2 = gsap.timeline({paused:true});
  let tween2 = TL2.staggerFrom(contactElements, 0.5, {transform: "scale(0)", ease: "power2.easeInOut"}, 0.5)
  let scene2 = new ScrollMagic.Scene({
    triggerElement: lastHeart,
    reverse: false
  })
  .setTween(tween2)
  // .addIndicators()
  .addTo(controller)
});

// Animation envoi formulaire de contact (shake + avion)
$(() => {
  var $sendBtn = $('.send-button'),
  $iWrapper = $('.icon-wrapper'),
  $i1 = $('.icon-1'),
  $i2 = $('.icon-2'),
  $i3 = $('.icon-3');

  function animationEvent() {
    var t,
    el = document.createElement('fakeelement');

    var animations = {
      animation: 'animationend',
      OAnimation: 'oAnimationEnd',
      MozAnimation: 'animationend',
      WebkitAnimation: 'webkitAnimationEnd'
    };

    for (t in animations) {
      if (el.style[t] !== undefined) {
        return animations[t];
      }
    }
  }

  $sendBtn.on('click', e => {
    if($('form').find('input:invalid,textarea:invalid').length){
      $('form').find('input:invalid,textarea:invalid').each(function(){
        var $this = $(this).addClass('addShakeKeyFrame');
        setTimeout(function () {
          $this.removeClass("addShakeKeyFrame");
        },2100);
      })
      $iWrapper.css('color', '#f61a14');
      $iWrapper.addClass('icon2-wrapper-animation');
      $sendBtn.addClass('clicked');
      $i1.delay(900);
      $i1.fadeTo(300, 0);
      $i2.fadeTo(300, 0);
      $i3.delay(900);
      $i3.fadeTo(300, 1);
    } else {
      $iWrapper.css('color', '#66bb6a');
      $iWrapper.addClass('icon-wrapper-animation');
      $sendBtn.addClass('clicked');
      $i1.delay(900);
      $i1.fadeTo(300, 0);
      $i3.fadeTo(300, 0);
      $i2.delay(900);
      $i2.fadeTo(300, 1);
    }
  });

  $sendBtn.on(animationEvent(), e => {
    $sendBtn.removeClass('clicked');
  });

  $iWrapper.on(animationEvent(), e => {
    if (e.originalEvent.animationName == 'icon-animation') {
      $iWrapper.removeClass('icon-wrapper-animation');
      $iWrapper.removeClass('icon2-wrapper-animation');
      setTimeout(reset, 1200);
    }
  });

  function reset() {
    $i1.fadeTo(250, 1);
    $i2.fadeTo(250, 0);
    $i3.fadeTo(250, 0);
    $iWrapper.css('color', 'rgba(255, 32, 32, 1)');
  }
});

// GRISER les boutons réalisation non survolés
$(() => {
  $(".buttons button").mouseenter(function() {
    $(this).siblings().fadeTo(350, 0.4);
  })
  $(".buttons button").mouseleave(function() {
    $(this).siblings().fadeTo(250, 1);
  });
});
