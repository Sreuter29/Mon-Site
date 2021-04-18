// Animation soulignage des titres du menu au défilement

window.addEventListener("load", () =>{
  if (window.matchMedia("(min-width: 1082px)").matches) {
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
      if(menu.parentNode.previousElementSibling) {
        let previousSibling = menu.parentNode.previousElementSibling.childNodes[0];
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
  }

  // LOADER
  const loader = document.querySelector('.loader');
  const nav = document.querySelector('nav');
  const body = document.querySelector('body');

  if(!loader.classList.contains('fondu-out')) {
    nav.style.position = 'static';
    body.style.overflow = 'hidden';
  }

  loader.classList.add('fondu-out');
  nav.style.position = 'fixed';
  body.style.overflow = 'visible';
  body.style.overflowX = 'hidden';


  // Animation smooth bouton UP

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
