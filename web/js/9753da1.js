$(document).ready(function(){
    
    $('#typeConfigDialog .save-button').unbind().click(function(){
        
        var routing = Routing.generate('panel_event_config_type_config', { type: $('#typeConfigDialogType').val(), output: 'value'});
        
        var Data = $('#typeConfigDialog form').serialize();
        
        $.post( routing, Data, function( data ) {
            
            if(data.status === 'success') {
                $('#'+$('#typeConfigFieldID').val()).val(data.value);
                $('#typeConfigDialog').modal('hide');
            } else {
                $('#typeConfigDialog .modal-body-content').html(data.html);
            }
            
        }, 'json');
        
    });
    
});
$(document).ready(function(){
    $('#addEnumRedord').click(function(e){
        var counter = 0;
        $('#enumRecordsTable tr').each(function(){
            var curData = parseInt($(this).data('index'));
            if(curData >= counter) {
                counter = curData+1;
            }
        });
        
        var newElement = $('#enumRecordsTable').data('prototype');
        newElement = newElement.replace(/__name__/g, counter);
		$('#enumRecordsTable').append(newElement);
        $('#edit_invitation_form_person_'+counter+'_innerOrder').val(counter);
        $('#enumRecordsTable tr:last input:first').focus();
        enumRecordsReinitRows();
        e.preventDefault();
        return false;
    });
    
    function enumRecordsReinitRows() {
        $( "#enumRecordsTable .remove").unbind().click(function(e){
            $(this).closest( "tr" ).remove();
            e.preventDefault();
            return false;
        });
        $("#enumRecordsTable .is_default").click(function(){
            if(!$('#enum_form_multichoice').prop('checked')) {
                $("#enumRecordsTable .is_default").each(function(){
                   $(this).prop('checked', false);
                });
                $(this).prop('checked', true);
            }
        });
        $('#enum_form_multichoice').change(function(){
            if(!$(this).is(':checked')) {
                var one = false;
                $("#enumRecordsTable .is_default").each(function(){
                    if($(this).is(':checked') == true) {
                        if(one) $(this).prop('checked', false);
                        one = true;
                    }
                });
            }
        });
        $( "#enumRecordsTable").sortable({
            placeholder: '<tr class="placeholder"/>',
            handle: ".holder"
        });
    }
    enumRecordsReinitRows();
});