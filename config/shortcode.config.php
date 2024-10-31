<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// SHORTCODE GENERATOR OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options       = array();

// -----------------------------------------
// Basic Shortcode Examples                -
// -----------------------------------------
$options[]     = array(
  'title'      => 'Basic Shortcode Examples',
  'shortcodes' => array(

    // begin: shortcode
    array(
      'name'      => 'horse_listing',
      'title'     => 'Horse Listing',
      'fields'    => array(

        // shortcode option field
        array(
          'id'    => 'grid_columns',
          'type'  => 'select',
          'title' => 'Number of Columns',
          'options' => array(
            '2'   => '2',
            '3'    => '3',
            '4'    => '4'
          )
        ),

        array(
          'id'          => 'information_displayed',
          'type'        => 'checkbox',
          'title'       => '',
          'desc'        => 'Select the information you want displayed on the card.',
          'class'       => 'horizontal',
          'options'     => array(
            'name'            => 'Name',
            'breed'           => 'Breed',
            'gender'          => 'Gender',
            'age'             => 'Age',
            'height'          => 'Height',
            'time_remaining'  => 'Time Remaining',
            'share_btn'       => 'Share Button',
            'learn_more_btn'  => 'Learn More Button',
          ),
          'default'    => array( 'name', 'breed', 'gender', 'age', 'share_btn', 'learn_more_btn' )
        ),

      ),
    ),
    // end: shortcode

  ),
);

CSFramework_Shortcode_Manager::instance( $options );
