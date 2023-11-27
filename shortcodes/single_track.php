<?php
if (!is_admin()) {
    add_shortcode('wm_single_track', 'wm_single_track_maremma');
}

function wm_single_track_maremma($atts)
{

    if (defined('ICL_LANGUAGE_CODE')) {
        $language = ICL_LANGUAGE_CODE;
    } else {
        $language = 'it';
    }

    extract(shortcode_atts(array(
        'track_id' => '',
        'activity' => ''
    ), $atts));

    $geojson_url = "https://geohub.webmapp.it/api/app/elbrus/1/geojson/$track_id.geojson";
    $json_url = "https://geohub.webmapp.it/api/app/elbrus/1/geojson/$track_id.json";
    $track = json_decode(file_get_contents($json_url), TRUE);
    // $mapping_tickets = json_decode(file_get_contents(get_stylesheet_directory_uri() . '/assets/track_ticket_mapping.json'), TRUE);
    $mapping_tickets = json_decode(file_get_contents('http://parco-maremma.local/wp-content/themes/wm-maremma-child/assets/track_ticket_mapping.json'), TRUE);
    $description = $track['description'][$language];
    $title = $track['name'][$language];
    $featured_image = $track['image']['sizes']['1440x500'];
    $gallery = $track['imageGallery'];
    $gpx = $track['gpx'];

    $mapping = array();
    // mapping the tickets section
    foreach ($mapping_tickets as $track => $info) {
        if (strtolower($track) == strtolower($track_id . '_' . $language)) {
            $mapping = $info;
        }
    }
    ob_start();
?>

    <section class="l-section wpb_row height_small wm_track_breadcrumb_section">
        <div class="l-section-h i-cf">
            <div class="pm-breadcrumb-yoast">
                <div class="wpb_wrapper">
                    <?php echo do_shortcode('[wpseo_breadcrumb]'); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="l-section wpb_row height_small with_img with_overlay wm_track_header_section">

        <div class="l-section-img loaded" style="background-image: url(<?= $featured_image ?>);background-repeat: no-repeat;">
        </div>
        <div class="l-section-overlay" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.3) 100%)"></div>
        <div class="l-section-h i-cf wm_track_header_wrapper">
            <h3 class="align_left wm_track_header_taxonomy">
                <?= (($language == 'it') ? __('Percorsi', 'wm-child-maremma') . ' ' : '') . $activity ?></h3>
            <h1 class="align_left wm_track_header_title">
                <?= $title ?></h1>
        </div>
    </section>
    <div class="wm_track_body_section">
        <div class="wm_track_body_map_wrapper">
            <div class="wm_track_body_map_title">
                <h2><?= __('Map', 'wm-child-maremma'); ?></h2>
                <p><?= __('Explore routes and points of interest', 'wm-child-maremma'); ?></p>
            </div>
            <div class="wm_track_body_map">
                <?php
                echo do_shortcode('[wm-embedmaps geojson_url="' . $geojson_url . '" height="500px" lang="' . $language . '" related_poi_click_behaviour="open" show_related_pois="true" fullscreen="true"  hide_taxonomy_filters="true"]');
                ?>
            </div>
        </div>
        <div class="wm_track_body_sidebar_wrapper">
            <div class="wm_track_body_map_details">
                <p class="track_sidebar_label"><?= __('Tecnical info', 'wm-child-maremma') ?></p>
                <?php
                echo do_shortcode('[wm-embedmaps-technical-info feature_id="' . $track_id . '-' . $track_id . '" config="ele_from,ele_to,ele_max,ele_min,distance,duration_forward,ascent,descent,difficulty,scale"]');
                ?>
            </div>
            <div class="wm_track_body_map_elevation">
                <p class="track_sidebar_label"><?= __('Elevation chart', 'wm-child-maremma') ?></p>
                <?php
                echo do_shortcode('[wm-embedmaps-elevation-chart feature_id="' . $track_id . '-' . $track_id . '"]');
                ?>
            </div>
            <div class="wm_track_body_download">
                <a class="w-btn us-btn-style_5 icon_atleft" href="<?= $gpx ?>"><i class="fal fa-arrow-to-bottom"></i><span class="w-btn-label"><?= __('Download GPX', 'wm-child-maremma') ?></span></a>
            </div>
        </div>
        <div class="wm_track_body_content_wrapper">
            <?php
            if (!empty($mapping)) {
            ?><div class="wm_track_body_ticket">
                    <p class="ticket_text"><strong> <?= $mapping['description'] ?></strong></p><?php
                                                                                                if (array_key_exists('calendar', $mapping)) {
                                                                                                ?><div class="single_track_ticket_btn">
                            <a class="w-btn us-btn-style_1" href="<?= $mapping['calendar'] ?>"><span class="w-btn-label"><?= __('Go to calendar', 'wm-child-maremma') ?></span></a>
                        </div><?php
                                                                                                }
                                                                                                if (array_key_exists('purchase', $mapping)) {
                                ?><div class="single_track_ticket_btn">
                            <a class="w-btn us-btn-style_1" href="<?= $mapping['purchase'] ?>"><span class="w-btn-label"><?= __('Purchase online', 'wm-child-maremma') ?></span></a>
                        </div><?php
                                                                                                }
                                                                                                if (array_key_exists('subscription', $mapping)) {
                                ?>
                        <a class="single_track_ticket_link" href="<?= $mapping['subscription'] ?>"><span class="w-btn-label"><?= __('Subscription and promotions', 'wm-child-maremma') ?></span></a>
                    <?php
                                                                                                }
                    ?>
                </div><?php
                    }
                        ?>
            <?php if ($description) { ?>
                <div class="wm_track_body_description">
                    <p class="track_description_label"><?= __('The path', 'wm-child-maremma') ?></p>
                    <?php echo $description; ?>
                </div>
            <?php } ?>
            <div class="wm_track_body_gallery">

                <div class="w-grid type_carousel layout_7769 cols_2" id="us_grid_1">
                    <div class="w-grid-list owl-carousel navstyle_3 navpos_outside owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <?php
                                $count = 6;
                                foreach ($gallery as $image) { ?>
                                    <div class="owl-item">
                                        <article class="w-grid-item post-7348 attachment type-attachment status-inherit hentry" data-id="7348">
                                            <div class="w-grid-item-h">
                                                <a class="w-grid-item-anchor" href="<?= $image['url'] ?>" ref="magnificPopupGrid" title=""></a>
                                                <div class="w-post-elm post_image usg_post_image_1 has_ratio">
                                                    <div style="padding-bottom:75.0000%"></div><a href="<?= $image['url'] ?>" ref="magnificPopup" aria-label=""><img src="<?= $image['sizes']['400x200'] ?>" class="attachment-full size-full" alt="" loading="lazy"></a>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php }; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php

    return ob_get_clean();
}
