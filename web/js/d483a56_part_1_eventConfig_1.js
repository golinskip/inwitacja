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