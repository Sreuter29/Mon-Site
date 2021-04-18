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
