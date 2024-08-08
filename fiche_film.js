const showComments = document.getElementById("commentBtn");
const zoneComments = document.getElementById("part3");
showComments.addEventListener("click", () => {
    if (zoneComments.style.display === "none") {
        zoneComments.style.display = "block";
      } else {
        zoneComments.style.display = "none";
      }
    });