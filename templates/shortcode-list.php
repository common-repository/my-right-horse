<?php
    $grid_layout = cs_get_option('grid_layout');
    $number_of_columns = isset($grid_layout['grid_columns']) ? $grid_layout['grid_columns'] : 2;
    $enable_pagination = 'false';
    if (isset($grid_layout['enable_pagination'])) {
        $enable_pagination = $grid_layout['enable_pagination'] == 1 ? 'true' : 'false';
    }
    $per_page = isset($grid_layout['results_per_page']) ? $grid_layout['results_per_page'] : 12;

    $card_style = cs_get_option('card_style');
    $theme = isset($card_style['theme']) ? $card_style['theme'] : 'light-theme';
    $information_displayed = isset($card_style['information_displayed']) ? $card_style['information_displayed'] : ['name', 'breed', 'gender', 'age', 'share_btn', 'learn_more_btn'];

    $button_style = cs_get_option('button_style');
    $button_types = isset($button_style['button_types']) ? $button_style['button_types'] : 'solid-rectangular';
    $button_color = isset($button_style['button_color']) ? $button_style['button_color'] : 'rgba(231, 126, 59, 1)';
    $contact_button_label = isset($button_style['contact_button_label']) ? $button_style['contact_button_label'] : 'Email';
    $contact_email_address = isset($button_style['contact_email_address']) ? $button_style['contact_email_address'] : '';
    $detail_button_label = isset($button_style['detail_button_label']) ? $button_style['detail_button_label'] : 'Contact Us';

    $lightbox_options = cs_get_option('lightbox_options');
    $enable_lightbox = 'false';
    if (isset($lightbox_options['enable_lightbox'])) {
        $enable_lightbox = $lightbox_options['enable_lightbox'] == 1 ? 'true' : 'false';
    }

    $enable_contact_form_modal = 'false';
    if (isset($lightbox_options['enable_contact_form_modal'])) {
        $enable_contact_form_modal = $lightbox_options['enable_contact_form_modal'] == 1 ? 'true' : 'false';
    }

    $filter_options = cs_get_option('filter_options');

    $enable_filtering = 'false';
    if (isset($filter_options['enable_filtering'])) {
        $enable_filtering = $filter_options['enable_filtering'] == 1 ? 'true' : 'false';
    }
    $filters = isset($filter_options['filters']) ? $filter_options['filters'] : ['breed', 'gender', 'age', 'name', 'oldest_first'];

    $enable_name_search = 'false';
    if (isset($filter_options['enable_name_search'])) {
        $enable_name_search = $filter_options['enable_name_search'] == 1 ? 'true' : 'false';
    }

    $oldest_first = 'false';
    if (isset($filter_options['oldest_first'])) {
        $oldest_first = $filter_options['oldest_first'] == 1 ? 'true' : 'false';
    }
?>
<section class="mrh-wrapper"
    data-number-of-columns="<?php echo $number_of_columns; ?>"
    data-enable-pagination="<?php echo $enable_pagination; ?>"
    data-per-page="<?php echo $per_page; ?>"
    data-theme="<?php echo $theme; ?>"
    data-information-displayed='<?php echo json_encode($information_displayed); ?>'
    data-button-types="<?php echo $button_types; ?>"
    data-button-color="<?php echo $button_color; ?>"
    data-contact-button-label="<?php echo $contact_button_label; ?>"
    data-contact-email-address="<?php echo $contact_email_address; ?>"
    data-detail-button-label="<?php echo $detail_button_label; ?>"
    data-enable-lightbox="<?php echo $enable_lightbox; ?>"
    data-enable-contact-form-modal="<?php echo $enable_contact_form_modal; ?>"
    data-enable-filtering="<?php echo $enable_filtering; ?>"
    data-filters='<?php echo json_encode($filters); ?>'
    data-enable-name-search="<?php echo $enable_name_search; ?>"
    data-oldest-first="<?php echo $oldest_first; ?>"
>
    <div id="mrh"></div>
</section>
