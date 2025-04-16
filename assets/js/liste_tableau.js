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
    <button class="supprimer" data-id="${p.id}">supprimer</button>
    `;
    ul.appendChild(li);
  });
  const li = document.createElement('li');
    li.innerHTML = `
      <input type="text" id="projet" name="projet" placeholder="nouveau projet" required>
      <button id="enregistrer" data-annee="${annee}">Enregistrer</button>`;
    ul.appendChild(li);
    
    document.getElementById('enregistrer').addEventListener('click', async (e) => {
    const projet = document.getElementById('projet').value;
    const annee = e.target.getAttribute('data-annee');
    if (projet) {
        await enregistrerProjet(annee, projet);
        chargerProjets(annee); 
    }
    });

    ul.addEventListener('click', async (e) => {
      if (e.target && e.target.classList.contains('supprimer')) {
        const id = e.target.getAttribute('data-id');
        await supprimerProjet(id);
        chargerProjets(annee); 
      }
    });
}


async function enregistrerProjet(annee, projet) {
  const res = await fetch('suppr_enr.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ action: 'enregistrer', annee, projet })
  });
  const data = await res.json();
}

async function supprimerProjet(id) {
  const res = await fetch('supp_enr.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ action: 'supprimer', id })
  });
  const data = await res.json();
}
  
chargerAnnees();