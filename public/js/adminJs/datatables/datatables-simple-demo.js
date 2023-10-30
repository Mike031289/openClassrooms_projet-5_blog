window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                perPage: "Sélection de posts par page",     // The label for page display

                info: "Affichage des posts {start} à {end} sur un total de {rows} posts", // Modify the datatable-info label
                placeholder: "Recherche", //Modiy The label for search area
            }
        });
    }
});
