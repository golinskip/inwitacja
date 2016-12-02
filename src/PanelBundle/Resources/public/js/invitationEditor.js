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