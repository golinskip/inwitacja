$(document).ready(function(){
    $('#typeConfigDialog .save-button').unbind().click(function(){
        var routing = Routing.generate('panel_event_config_type_config', { type: $('#typeConfigDialogType').val(), output: 'value'});
        var Data = $('#typeConfigDialog form').serialize();
        $.post( routing, Data, function( data ) {
            $('#'+$('#typeConfigFieldID').val()).val(data.value);
            $('#typeConfigDialog').modal('hide')
        }, 'json');
    });
});