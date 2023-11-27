(function ($) {
    
    $( window ).on( "load", function() { 

        // modifies the homepage first slider dots to numbers
        $('.owl-dots button').each(function(index,element) {
            index++;
            index = '0'+index;
            $(element).html(index)
        });

    })
})(jQuery);

function pmmenumobile() {
    jQuery( ".pm-mobile-vertical-menu" ).toggleClass('grid-hidden');
}
