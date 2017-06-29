jQuery(document).ready(function() {
	jQuery('.modal-form').on('shown.bs.modal', function () {        
		jQuery("input:first").focus();
	});
        $('#invitationsTable .remove').unbind().click(function(e){
            if(confirm(window.translations.removeQuestion)) {
                return true;
            }
            e.preventDefault();
            return false;
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
    
    function addInviataionFormReset() {
        
    }
});