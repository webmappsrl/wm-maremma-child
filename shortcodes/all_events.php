<?php 

add_shortcode( 'wm_all_events', 'wm_all_events_maremma' );
  
function wm_all_events_maremma() { 
    $next_weekend_Ymd = get_next_weekend();
    $today_date = date('Y-m-d',strtotime('today'));

    $label_weekend = __('In Weekend', 'wm-child-maremma');
    $label_weekdays = __('During the week', 'wm-child-maremma');
    $label_h1 = __('Events calendar', 'wm-child-maremma');
    $label_h2 = __('The events', 'wm-child-maremma');

    ob_start();
    ?>
    
        <h1><?= $label_h1 ?></h1>
        
        <?php
        echo do_shortcode('
        [vc_tta_tabs title_font="" layout="modern"]
            [vc_tta_section tab_id="1621850076777-ef8de0b7-53b9" title="'.$label_weekdays.'" el_class="wm-weekdays-tab" date="'.$today_date.'"]
                [vc_column_text]
                    [tribe_events view="week"]
                [/vc_column_text]
            [/vc_tta_section]
            [vc_tta_section tab_id="1621850076790-dccf88b8-9b29" el_class="wm-weekends-tab" title="'.$label_weekend.'"]
                [vc_column_text]
                    [tribe_events view="day"]
                [/vc_column_text]
            [/vc_tta_section]
        [/vc_tta_tabs]');
        ?>
        
    <script src="/wp-content/themes/wm-maremma-child/js/all-events.js"></script>
    <script>
        var next_weekend = <?= $next_weekend_Ymd ?>
    </script>
<?php


    echo ob_get_clean();
}