$(document).ready(function(){
    $('#typeConfigDialog .save-button').unbind().click(function(){
        var routing = Routing.generate('panel_event_config_type_config', { type: $('#typeConfigDialogType').val(), output: 'value'});
        alert($('#typeConfigDialogType').val());
        var Data = $('#typeConfigDialog form').serialize();
        $.post( routing, Data, function( data ) {
            console.log(data);
        }, 'json');
    });
});