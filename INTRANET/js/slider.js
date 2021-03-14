let indice = 1;
muestraSlider(indice);

function avanzaSlide(n) {
  muestraSlider((indice += n));
}

function posicionSlide(n) {
  muestraSlider((indice = n));
}

setInterval(function tiempo() {
  muestraSlider((indice += 1));
}, 4000);

function muestraSlider(n) {
  let i;
  let slider = document.getElementsByClassName("miSlider");
  let barras = document.getElementsByClassName("barra");

  if (n > slider.length) {
    indice = 1;
  }
  if (n < 1) {
    indice = slider.length;
  }
  for (i = 0; i < slider.length; i++) {
    slider[i].style.display = "none";
  }
  for (i = 0; i < barras.length; i++) {
    barras[i].className = barras[i].className.replace(" active", "");
  }

  slider[indice - 1].style.display = "block";
  barras[indice - 1].className += " active";
}
