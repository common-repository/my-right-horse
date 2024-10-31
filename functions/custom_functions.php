<?php

/**
 * Custom Shortcodes
 * @param  [type] $atts    [description]
 * @param  string $content [description]
 * @return [type]          [description]
 */
if ( ! function_exists( 'horse_listing_shortcode' ) ) {
  function horse_listing_shortcode( $atts, $content = '' ) {
    // PLACEHOLDER_RADIAL_WIKI

    $server = defined('MRH_SERVER') ? MRH_SERVER : 'www.myrighthorse.org';

    if( !is_admin() ) {
      wp_enqueue_script('plugin-axios', CS_URI .'/assets/js/axios.min.js', [], false, true);
      wp_enqueue_script('plugin-vue-js', CS_URI .'/assets/js/vue.min.js', [], false, true);
      wp_enqueue_script( 'myrighthorse-js',    CS_URI .'/dist/scripts/mrh-app.js', ['plugin-vue-js'], '1.0.0', true );
      wp_add_inline_script('myrighthorse-js', 'const mrhServer = "' . $server . '"', 'before');
      wp_enqueue_style( 'myrighthorse-css', CS_URI .'/dist/styles/mrh-app.css' );
    }

    $atts = shortcode_atts( array(
        'title' => ''
    ), $atts );

    ob_start();
    cs_locate_template( 'templates/shortcode-list.php' );
    return ob_get_clean();

    $output = $atts['title'] . '<br />' . $content;

    echo $output;
  }
  add_shortcode( 'horse_listing', 'horse_listing_shortcode' );
}

/**
 * Get a custom json result from the API
 */
if ( ! function_exists( 'mrh_list' ) ) {
  function mrh_list( $data ) {

    $token = cs_get_option('token');
    $server = defined('MRH_SERVER') ? MRH_SERVER : 'www.myrighthorse.org';
    $api_url = "https://$server/api/v1/listings";

    $horses = wp_remote_get($api_url, ['headers'=> ['Authorization'=>"TOKEN $token"]]);

    if( is_wp_error($horses) ) {
      return array( 'error' => $horses->get_error_messages() );
    }

    if( $response = json_decode($horses['body'], true) ) {
        if( isset( $response['error'] ) ) {
          return array( 'error' => 'error_when_retrieving_data' );
        }
        return $response;
      } else {
        return array( 'error' => 'something_went_wrong_when_retrieving_data' );
      }
  }
}

/**
 * Submit Contact Form
 */
if ( ! function_exists( 'submit_contact_form' ) ) {
  function submit_contact_form( WP_REST_Request $request ) {

    $first_name = sanitize_text_field( trim( $request['first_name' ] ) );
    $last_name = sanitize_text_field( trim( $request['last_name' ] ) );
    $contact_email = sanitize_email( trim( $request['contact_email' ] ) );
    $contact_phone = sanitize_text_field( trim( $request['contact_phone' ] ) );
    $state_of_residence = sanitize_text_field( trim( $request['state_of_residence' ] ) );
    $age = sanitize_text_field( trim( $request['age' ] ) );
    $horse_owner = sanitize_text_field( trim( $request['horse_owner' ] ) );
    $adoption_time_frame = sanitize_text_field( trim( $request['adoption_time_frame' ] ) );

    $errors = [];

    if( empty( $first_name ) ) {
      $errors['first_name'] = 'First Name is required';
    }

    if( empty( $last_name ) ) {
      $errors['last_name'] = 'Last Name is required';
    }

    if( empty( $contact_email ) ) {
      $errors['contact_email'] = 'Email is required';
    }

    if( empty( $contact_phone ) ) {
      $errors['contact_phone'] = 'Phone is required';
    }

    if (empty($state_of_residence)) {
        $errors['state_of_residence'] = 'State is required';
    }

    if (empty($age)) {
      $errors['age'] = 'Age is required';
    }

    if (empty($horse_owner)) {
      $errors['horse_owner'] = 'Age is required';
    }

    if (empty($adoption_time_frame)) {
      $errors['adoption_time_frame'] = 'Adoption time frame is required';
    }

    if( count( $errors ) ) {
      return new WP_Error( 'contact_form_errors', json_encode($errors), ['status'=> 422]);
    }

    $message = "Full name: {$first_name} {$last_name} . <br>";
    $message .= "Email: {$contact_email} . <br>";
    $message .= "Phone: {$contact_phone}";

    $headers = ['Content-Type: text/html; charset=UTF-8'];

    // wp_mail( 'jose@kley.co', 'Contact Form', $message, $headers );

    return $message;
  }
}

// register the endpoint
add_action( 'rest_api_init', function () {
  register_rest_route( 'mrh', '/horses/', [
          'methods' => 'GET',
          'callback' => __NAMESPACE__ . '\\mrh_list',
      ]
  );

  register_rest_route( 'mrh', '/submit-contact-form/', [
          'methods' => 'POST',
          'callback' => __NAMESPACE__ . '\\submit_contact_form',
      ]
  );
});
