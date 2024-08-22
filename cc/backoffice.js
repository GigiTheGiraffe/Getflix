const tables = document.querySelectorAll('.switch');
const buttons = document.querySelectorAll('a');
function showTable(tableId) {
  // Cache toutes les tables
  tables.forEach((table) => {
    table.classList.add('hide');
  });
  // Affiche la table sélectionnée
  document.querySelector(tableId).classList.remove('hide');
}

function addBorderRadiusIfCondition (element, condition, borderRadius) {
  if (element.innerText == condition) {
   element.style.borderRadius = borderRadius;
  }
}

// Ajoute un écouteur d'événement pour chaque soustitres
buttons.forEach((title => {
  title.addEventListener('click', () => {
    // Pas recharger la page
    buttons.forEach((element) => {
      element.style.backgroundColor = "white";
    });
    title.style.backgroundColor = "#FCBF49";
    addBorderRadiusIfCondition(title, "Users", "5px 0 0 0");
    addBorderRadiusIfCondition(title, "Comments", "0 5px 0 0")
    // Récupère l'ID de la table cible
    const targetTable = title.getAttribute('href');
    // Affiche la table cible
    showTable(targetTable);
  });
}));

// Affiche la première table par défaut
showTable('#users');