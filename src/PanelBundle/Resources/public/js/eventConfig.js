$(document).ready(function(){
    $('.eventConfig-addRow').click(function(e) {
        
        var tableHandler = $('#'+$(this).data('table'));
        var counter = tableHandler.find('tr').length;
        var newElement = tableHandler.data('prototype');
        
        newElement = newElement.replace(/__name__/g, counter);
		tableHandler.append(newElement);
        eventConfig_reloadButtons();
        
        $('#typeConfigDialog').on('hidden.bs.modal', function () {
            $('#typeConfigDialog .modal-body-content').html('');
        });
        
        var innerOrderVal = 0;
        tableHandler.find('.inputInnerOrder').each(function(){
            $(this).val(innerOrderVal);
            innerOrderVal++;
        });
        
        tableHandler.find('tr:last').find('input:first').focus();
        
        e.preventDefault();
        return false;
    });
    
    function eventConfig_reloadButtons() {
        $('.eventConfig-editableTable .remove').unbind().click(function(e){
            if(confirm(window.translations[$(this).data('message')])) {
                $(this).closest( "tr" ).remove();
            }
            e.preventDefault();
            return false;
        });
        $('.colorpicker-component').colorpicker({
            'format' : 'hex'
        });
        $('button.typeConfig').unbind().click(function(){
            var type = $(this).closest( "tr" ).find('.inputType').val();
            var name = $(this).closest( "tr" ).find('.inputParameterName').val();
            var typeConfig = $(this).closest( "tr" ).find('.inputTypeConfig').val();
            var routing = Routing.generate('panel_event_config_type_config', { type: type, output: 'html'});
            $('#typeConfigFieldID').val($(this).closest( "tr" ).find('.inputTypeConfig').attr('id'));
            $.post( routing, {
                data: typeConfig
            }, function( data ) {
                $('#typeConfigDialogType').val(data.type);
                $('#typeConfigDialog .modal-body-content').html(data.html);
                $('#typeConfigDialog .modal-title').html(name);
            }, 'json');
        });
        $( ".tbody-sortable").sortable({
            placeholder: '<tr class="placeholder"/>',
            handle: ".holder",
            stop: function() {
                var innerOrderVal = 0;
                $(this).find('.inputInnerOrder').each(function(){
                    $(this).val(innerOrderVal);
                    innerOrderVal++;
                });
            }
        });
    }
    eventConfig_reloadButtons();
    
    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }
});