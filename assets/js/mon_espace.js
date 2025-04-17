async function chargerImages() {
    const res = await fetch('afficher_image.php');
    if (res.ok) {
        const blob = await res.blob();
        const url = URL.createObjectURL(blob); 

        const ul = document.getElementById('pdp'); 
        ul.innerHTML = ''; 

        const img = document.createElement('img');
        img.src = url; 
        img.alt = "Photo de profil"; 
        img.style.width = "150px"; 
        img.style.height = "150px";

        ul.appendChild(img); 
    } else {
        console.error("Erreur lors du chargement de l'image");
    }
}