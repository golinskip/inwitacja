 var stop = false;
$(document).ready(function() {
   
 
   
 
     var tabCarousel = setInterval(function() {
        var tabs = $('#tabs-home .nav.tabs > li'),
            active = tabs.filter('.active'),
            next = active.next('li'),
            toClick = next.length ? next.find('a') : tabs.eq(0).find('a');

        toClick.trigger('click');
    }, 5000);

    
});