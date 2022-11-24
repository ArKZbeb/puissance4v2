// faire une fonction qui refresh la page automatiquement toutes les 5 secondes

function refreshPage(){
    window.location.reload();
}
setTimeout('refreshPage()', 20000);
console.log('refresh');