const showComments = document.getElementById("commentBtn");
const zoneComments = document.getElementById("part3");
const showTrailer = document.getElementById("trailerBtn");
const zoneTrailer = document.getElementById("part4");

showComments.addEventListener("click", () => {
  zoneComments.classList.toggle('hidden'); // Ajoute ou enleve la classe hidden
  zoneComments.classList.toggle('visible'); // Ajoute ou enleve la classe visible
});
showTrailer.addEventListener("click", () => {
  zoneTrailer.classList.toggle('hidden'); // Ajoute ou enleve la classe hidden
  zoneTrailer.classList.toggle('visible'); // Ajoute ou enleve la classe visible
});