// Animation envoi formulaire de contact (shake + avion)
$(function() {
  let $sendBtn = $('.send-button'),
  $iWrapper = $('.icon-wrapper'),
  $i1 = $('.icon-1'),
  $i2 = $('.icon-2'),
  $i3 = $('.icon-3');

  function animationEvent() {
    let t,
    el = document.createElement('fakeelement');

    let animations = {
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
      $('form').find('input:invalid,textarea:invalid').each(function() {
        let $this = $(this).addClass('addShakeKeyFrame');
        setTimeout(() => {
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
