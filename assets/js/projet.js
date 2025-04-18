async function chargerpostit() {
    const resc1 = await fetch('obtenir_post-it.php?projet=' + encodeURIComponent(projet) + '&colonne=1');
    const postitc1 = await resc1.json();
    const resc2 = await fetch('obtenir_post-it.php?projet=' + encodeURIComponent(projet) + '&colonne=2');
    const postitc2 = await resc2.json();
    const ulc1 = document.getElementById('colonne1');
    const ulc2 = document.getElementById('colonne2');
    
    
    ulc1.innerHTML = '';
    postitc1.forEach(p => {
      const li = document.createElement('li');
      li.innerHTML += `
      <div type='text'> ${p.expediteur}: ${p.contenu}</div>
      <button class="supprimer" data-id="${p.id}">supprimer</button>`;
      ulc1.appendChild(li);
    });
    ulc2.innerHTML = '';
    postitc2.forEach(p => {
      const li = document.createElement('li');
      li.innerHTML += `
      <div type='text'> ${p.expediteur}: ${p.contenu}</div>
      <button class="supprimer" data-id="${p.id}">supprimer</button>`;
      ulc2.appendChild(li);
    });
    ulc1.addEventListener('click', async (e) => {
        if (e.target && e.target.classList.contains('supprimer')) {
          const id = e.target.getAttribute('data-id');
          await supprimerPostit(id);
          chargerpostit(); // Recharger les projets après suppression
        }
      });
    
      ulc2.addEventListener('click', async (e) => {
        if (e.target && e.target.classList.contains('supprimer')) {
          const id = e.target.getAttribute('data-id');
          await supprimerPostit(id);
          chargerpostit(); // Recharger les projets après suppression
        }
      });
    
  };


  document.getElementById('ajout_postit').addEventListener('click', async (e) => {
    const contenu = document.getElementById('contenu').value;
    const colonne = document.getElementById('colonne').value;
    const anonyme = document.getElementById('anonyme').checked ? 'anonyme' : '';
    if (contenu) {
        await enregistrerPostit(contenu, colonne, anonyme);
        chargerpostit();
        document.getElementById('contenu').value='';
    }
    });


async function enregistrerPostit(contenu, colonne, anonyme) {
    const res = await fetch('nouveau_post-it.php?contenu=' + encodeURIComponent(contenu) + '&colonne=' + encodeURIComponent(colonne) + '&anonyme=' + encodeURIComponent(anonyme));
    const data = await res.json();
    console.log(data);
  }



async function supprimerPostit(id) {
    const res = await fetch('supprimer_post-it.php?id=' + encodeURIComponent(id));
  }
  chargerpostit();