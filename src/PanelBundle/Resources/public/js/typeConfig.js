$(document).ready(function(){
    $('#typeConfigDialog .save-button').unbind().click(function(){
        alert($('#typeConfigDialog form').serialize());
    });
});