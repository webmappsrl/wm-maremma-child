function availableDates(date) {
    return [false,"","unAvailable"];
}


function addfowllowingZeros(num, size) {
    var s = num+"";
    while (s.length < size) s = s + '0';
    return s;
}

jQuery(document).ready(function () {
    jQuery('.wm-weekends-tab').one('click',function(){
        // jQuery('.wm-weekdays-tab .tribe-events-c-view-selector__list-item.tribe-events-c-view-selector__list-item--week > a').click();
        if (next_weekend) {
            var weekendInt = parseInt(addfowllowingZeros(next_weekend,13));
            setTimeout(function(){ 
                jQuery('.wm-weekends-tab .tribe-common-h3').click()
                jQuery('.wm-weekends-tab [data-date="'+weekendInt+'"]').click()
            }, 500);
        }
    })
    // jQuery('td').click(function(){
    //     evID = jQuery(this).closest('tr').attr("val");
    //     console.log('weekend')
    // })
    // tribe.events.views.datepicker.options.beforeShowDay = (date) => { console.log(date); return date.getDay()===1}
    // if ( 
    //     'function' === typeof jQuery
    //     && 'function' === typeof jQuery.fn.bootstrapDatepicker
    // ) {
    //     jQuery.fn.bootstrapDatepicker.defaults.beforeShowDay = [false,"","unAvailable"];
    //     console.log('weekend')
    // }
    
});