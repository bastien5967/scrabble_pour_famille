// script.js

function callAPI(lesdonnees, action, retour) {
    return new Promise((resolve, reject) => {
        // Login example
        $.ajax({
            url: '/back/index.php?action=' + action + '&return=' + retour,
            type: 'POST',
            data: lesdonnees,
            dataType: 'json',
            success: function(response) {
                // console.log(response); // JSON response
                var retour = JSON.stringify(response);
                resolve(retour);
            },
            error: function(xhr, status, error) {
                console.error('Erreur :', error);
                console.error('xhr :', xhr);
                console.error('status :', status);
                reject(error);
            }
        });
    });
}

//.