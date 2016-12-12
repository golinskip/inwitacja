$(document).ready(function(){
    $('.eventConfig-addRow').click(function(e) {
        
        var tableHandler = $('#'+$(this).data('table'));
        var counter = tableHandler.find('tr').length;
        var newElement = tableHandler.data('prototype');
        
        newElement = newElement.replace(/__name__/g, counter);
		tableHandler.append(newElement);
        eventConfig_reloadButtons();
        
        e.preventDefault();
        return false;
    });
    
    function eventConfig_reloadButtons() {
        $('.eventConfig-editableTable .remove').unbind().click(function(){
            if(confirm(window.translations.removeQuestion)) {
                $(this).closest( "tr" ).remove();
            }
            e.preventDefault();
            return false;
        });
        
        $('.colorpicker').colorpicker();
    }
    eventConfig_reloadButtons();
});

$(document).ready(function(){
    $('#invitationEditorAddPerson').click(function(e){
        var counter = 0;
        var max_inner_order = 0;
        $('#invitationEditorPersonTable tr').each(function(){
            var curData = parseInt($(this).data('index'));
            if(curData >= counter) {
                counter = curData+1;
            }
        });
        
        var newElement = $('#invitationEditorPersonTable').data('prototype');
        newElement = newElement.replace(/__name__/g, counter);
		$('#invitationEditorPersonTable').append(newElement);
        $('#edit_invitation_form_person_'+counter+'_innerOrder').val(counter);
        $('#invitationEditorPersonTable tr:last input:first').focus();
        reinitRows();
        e.preventDefault();
        return false;
    });
    
    function reinitRows() {
        $( "#invitationEditorPersonTable .remove").unbind().click(function(){
            if(confirm(window.translations.removeQuestion)) {
                //$('#personTrash').val($('#personTrash').val()+','+);
                $(this).closest( "tr" ).remove();
            }
            e.preventDefault();
            return false;
        });
        $( "#invitationEditorPersonTable").sortable({
            placeholder: '<tr class="placeholder"/>',
            handle: ".holder",
            stop: function() {
                var innerOrderVal = 0;
                $('#invitationEditorPersonTable .inputInnerOrder').each(function(){
                    $(this).val(innerOrderVal);
                    innerOrderVal++;
                });
            }
        });
        $( "#invitationEditorPersonTable" ).disableSelection();
    }
    reinitRows();
});
jQuery(document).ready(function() {
	jQuery('.modal-form').on('shown.bs.modal', function () {        
		jQuery("input:first").focus();
	});
	function fieldDuplicator() {
		jQuery('.input-duplicatable').unbind().keyup(function(){
			if(jQuery(this).parent().is(':last-child') && jQuery(this).val() !== '') {
                var counter = jQuery(this).parent().parent().children().length;
                var newElement = jQuery(this).parent().parent().attr('data-prototype');
                newElement = newElement.replace(/__name__/g, counter);
				jQuery(this).parent().parent().append(newElement);
				fieldDuplicator();
			}
		});
	}
	fieldDuplicator();
    
    $('tr[data-href]').click(function(){
        document.location = $(this).data('href');
    });
    
    function addInviataionFormReset() {
        
    }
});