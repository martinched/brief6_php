/*-------------Toggle function-------------------------------------------------- */

function toggleFilter() {
    console.log("Inside the function");
    let section = document.getElementById('collapseFilter');
    section.classList.toggle('hidden');
}

/*--------------Confirm delete-------------------------------------------------- */

function confirmDelete(favoriId){
    if (confirm("Confirmez-vous la suppresion définitive de ce registre?")){
        window.location.href = "delete.php?id_favori=" + favoriId;
    }
}

/*--------------Completer champs, condition pour la création ou modification de favoris */

function completerChamps() {
    alert("Tous les champs sont obligatoires pour la création ou la mise à jour d'un favori.");
}