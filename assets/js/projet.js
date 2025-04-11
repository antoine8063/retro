async function chargerpostit() {
    const resc1 = await fetch('obtenir_post-it.php?projet=' + encodeURIComponent(projet) + '&colonne=1');
    const postitc1 = await resc1.json();
    const resc2 = await fetch('obtenir_post-it.php?projet=' + encodeURIComponent(projet) + '&colonne=2');
    const postitc2 = await resc2.json();
    const ulc1 = document.getElementById('colonne1');
    const ulc2 = document.getElementById('colonne2');
    
    
    ulc1.innerHTML = '';
    postitc1.forEach(p => {
        console.log(p.contenu);
      const li = document.createElement('li');
      li.textContent = p.contenu;
      ulc1.appendChild(li);
    });
    ulc2.innerHTML = '';
    postitc2.forEach(p => {
        console.log(p.contenu);
      const li = document.createElement('li');
      li.textContent = p.contenu;
      ulc2.appendChild(li);
    });
    

  }
  chargerpostit();