// Animation like Coeur et gestion des likes
$(document).ready(function() {
  $(".fa-heart").each(function() {
    let heart = $(this);
    let idHtml = heart.parent().parent().attr('id');
    let compteur = $(this).next();
    $.ajax({
      url: "./action_like.php",
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

  $(".fa-heart").click(function(e) {
    e.preventDefault();
    $(this).removeClass("far");
    $(this).addClass("fa");
    let idHtml = $(this).parent().parent().attr('id');
    let compteur = $(this).next();
    $.ajax({
      url: "./action_like.php",
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
window.addEventListener("load", () =>
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

// GRISER les boutons réalisation non survolés
$(function() {
  $(".buttons button").mouseenter(function() {
    $(this).siblings().fadeTo(350, 0.4);
  })
  $(".buttons button").mouseleave(function() {
    $(this).siblings().fadeTo(250, 1);
  });
});
