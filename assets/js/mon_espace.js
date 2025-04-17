async function chargerImages() {
    const res = await fetch('afficher_image.php'); // Récupère l'image
    if (res.ok) {
        const blob = await res.blob(); // Convertit la réponse en Blob
        const url = URL.createObjectURL(blob); // Crée une URL temporaire pour l'image

        const ul = document.getElementById('pdp'); // Sélectionne l'élément où afficher l'image
        ul.innerHTML = ''; // Vide le contenu précédent

        const img = document.createElement('img'); // Crée une balise <img>
        img.src = url; // Définit la source de l'image
        img.alt = "Photo de profil"; // Ajoute un texte alternatif
        img.style.width = "150px"; // Optionnel : ajoute un style
        img.style.height = "150px";

        ul.appendChild(img); // Ajoute l'image à l'élément
    } else {
        console.error("Erreur lors du chargement de l'image");
    }
}