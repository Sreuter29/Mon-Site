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

    for(let j = 0; j < items.length; j++ ) {
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
