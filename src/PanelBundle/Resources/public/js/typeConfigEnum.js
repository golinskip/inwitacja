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
        $( "#enumRecordsTable").sortable({
            placeholder: '<tr class="placeholder"/>',
            handle: ".holder",
        });
    }
    enumRecordsReinitRows();
});