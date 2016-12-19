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