async function chargerAnnees() {
  const res = await fetch('obtenir_annees.php');
  const annees = await res.json();

  const ul = document.getElementById('annees');
  ul.innerHTML = '';
  annees.forEach(annee => {
    const li = document.createElement('li');
    li.textContent = annee;
    li.onclick = () => chargerProjets(annee);
    ul.appendChild(li);
  });
}
async function chargerProjets(annee) {
  const res = await fetch('obtenir_projets.php?annee=' + encodeURIComponent(annee));
  const projets = await res.json();

  const ul = document.getElementById('projets');
  ul.innerHTML = '';
  projets.forEach(p => {
    const li = document.createElement('li');
    li.innerHTML = 
    `
    <a href="projet.php?id=${p.id}">${p.projet}</a>
    <form method="POST" action="liste_tableau.php"> 
    <input type="hidden" name="id" value="${p.id}">
    <button type="submit" name="supprimer">supprimer</button>
    </form>
    `;
    ul.appendChild(li);
  });
  const li = document.createElement('li');
    li.innerHTML = `<form method="POST" action="liste_tableau.php">
      <input type="hidden" name="annee" value="${annee}">
      <input type="text" id="projet" name="projet" placeholder="nouveau projet" required>
      <button type="submit" name="enregistrer">Enregistrer</button>
    </form>`;
    ul.appendChild(li);
}

  
chargerAnnees();