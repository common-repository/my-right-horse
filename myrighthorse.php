<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * ------------------------------------------------------------------------------------------------
 *
 * Plugin Name:       My Right Horse
 * Plugin URI:        https://therighthorse.org/
 * Description:       Find your right horse the right way. Connecting good people to good horses.
 * Version:           1.7
 * Author:            My Right Horse
 * Author URI:        https://www.myrighthorse.org/
 * Text Domain:       myrighthorse
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /l10n
 *
 *
 */

// ------------------------------------------------------------------------------------------------
require_once plugin_dir_path( __FILE__ ) .'/myrighthorse-path.php';
// ------------------------------------------------------------------------------------------------
require_once(plugin_dir_path(__FILE__) . '/vendor/autoload.php');

use Rollbar\Rollbar;

$access_token = defined('ROLLBAR_TOKEN') ? ROLLBAR_TOKEN : '0e69c7c6cc95447282e41cd1cbd7e680';

$config = array('access_token' => $access_token);
Rollbar::init($config);

if( ! function_exists( 'cs_framework_init' ) && ! class_exists( 'CSFramework' ) ) {
  function cs_framework_init() {

    // active modules
    defined( 'CS_ACTIVE_FRAMEWORK' )   or  define( 'CS_ACTIVE_FRAMEWORK',   true  );
    defined( 'CS_ACTIVE_METABOX'   )   or  define( 'CS_ACTIVE_METABOX',     false  );
    defined( 'CS_ACTIVE_TAXONOMY'   )  or  define( 'CS_ACTIVE_TAXONOMY',    true  );
    defined( 'CS_ACTIVE_SHORTCODE' )   or  define( 'CS_ACTIVE_SHORTCODE',   true  );
    defined( 'CS_ACTIVE_CUSTOMIZE' )   or  define( 'CS_ACTIVE_CUSTOMIZE',   true  );
    defined( 'CS_ACTIVE_LIGHT_THEME' ) or  define( 'CS_ACTIVE_LIGHT_THEME', false );

    // helpers
    cs_locate_template( 'functions/deprecated.php'     );
    cs_locate_template( 'functions/fallback.php'       );
    cs_locate_template( 'functions/helpers.php'        );
    cs_locate_template( 'functions/actions.php'        );
    cs_locate_template( 'functions/enqueue.php'        );
    cs_locate_template( 'functions/sanitize.php'       );
    cs_locate_template( 'functions/validate.php'       );

    // classes
    cs_locate_template( 'classes/abstract.class.php'   );
    cs_locate_template( 'classes/options.class.php'    );
    cs_locate_template( 'classes/framework.class.php'  );
    cs_locate_template( 'classes/metabox.class.php'    );
    cs_locate_template( 'classes/taxonomy.class.php'   );
    cs_locate_template( 'classes/shortcode.class.php'  );
    cs_locate_template( 'classes/customize.class.php'  );

    // configs
    cs_locate_template( 'config/framework.config.php'  );
    cs_locate_template( 'config/metabox.config.php'    );
    cs_locate_template( 'config/taxonomy.config.php'   );
    cs_locate_template( 'config/shortcode.config.php'  );
    cs_locate_template( 'config/customize.config.php'  );

    // custom functions
    cs_locate_template( 'functions/custom_functions.php');

  }
  add_action( 'init', 'cs_framework_init', 10 );
}
