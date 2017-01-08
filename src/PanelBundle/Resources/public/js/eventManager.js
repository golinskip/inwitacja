$(document).ready(function(){
    $('.event-remover').click(function(e){
        if(!confirm(window.translations.removeEvent)) {
            e.preventDefault();
            return false;
        }
    });
});