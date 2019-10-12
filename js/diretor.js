$(document).ready(() => {
    $('#usuarios').DataTable({			
        "ajax": "processa.php",
        "columns": [
            { "data": "id_usuario" },
            { "data": "nome" },
            { "data": "email" },
            { "data": "tipo" },
        ]
    });
});
