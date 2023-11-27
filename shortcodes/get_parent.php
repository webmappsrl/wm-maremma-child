<?php

add_shortcode('wm_get_parent', 'wm_get_parent_maremma');

function wm_get_parent_maremma($atts)
{
    if (!is_admin()) {
        $parent = get_post_parent();
        if ($parent) {
            ob_start();
?>
            <h2 style="color:white;margin:0;"><?= esc_html($parent->post_title) ?></h2>
<?php
            echo ob_get_clean();
        }
    } else {
        return;
    }
}
