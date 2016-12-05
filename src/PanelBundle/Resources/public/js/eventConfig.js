$(document).ready(function(){
    $('.eventConfig-addRow').click(function(e) {
        
        var tableHandler = $('#'+$(this).data('table'));
        var counter = tableHandler.find('tr').length;
        var newElement = tableHandler.data('prototype');
        
        newElement = newElement.replace(/__name__/g, counter);
		tableHandler.append(newElement);
        
        e.preventDefault();
        return false;
    });
});