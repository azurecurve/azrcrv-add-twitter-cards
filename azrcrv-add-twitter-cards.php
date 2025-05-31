<?php
/**
 * ------------------------------------------------------------------------------
 * Plugin Name:		Add Twitter Cards
 * Description:		Add Twitter Cards to attach rich photos to Tweets, helping to drive traffic to your website.
 * Version:			2.0.5
 * Requires CP:		1.0
 * Requires PHP:	7.4
 * Author:			azurecurve
 * Author URI:		https://development.azurecurve.co.uk/classicpress-plugins/
 * Plugin URI:		https://development.azurecurve.co.uk/classicpress-plugins/add-twitter-cards/
 * Donate link:		https://development.azurecurve.co.uk/support-development/
 * Text Domain:		add-twitter-cards
 * Domain Path:		/assets/languages
 * License:			GPLv2 or later
 * License URI:		http://www.gnu.org/licenses/gpl-2.0.html
 * ------------------------------------------------------------------------------
 */

/**
 * Declare the Namespace.
 */
namespace azurecurve\AddTwitterCards;

/**
 * Define constants.
 */
const DEVELOPER_SHORTNAME = 'azurecurve';
const DEVELOPER_NAME      = DEVELOPER_SHORTNAME . ' | Development';
const DEVELOPER_URL_RAW   = 'https://development.azurecurve.co.uk/classicpress-plugins/';
const DEVELOPER_URL       = '<a href="' . DEVELOPER_URL_RAW . '">' . DEVELOPER_NAME . '</a>';

const PLUGIN_NAME       = 'Add Twitter Cards';
const PLUGIN_SHORT_SLUG = 'add-twitter-cards';
const PLUGIN_SLUG       = 'azrcrv-' . PLUGIN_SHORT_SLUG;
const PLUGIN_HYPHEN     = 'azrcrv-atc';
const PLUGIN_UNDERSCORE = 'azrcrv_atc';
const PLUGIN_FILE       = __FILE__;

/**
 * Prevent direct access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Include plugin Menu Client.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/azurecurve-menu-populate.php';
require_once dirname( PLUGIN_FILE ) . '/includes/azurecurve-menu-display.php';

/**
 * Include Update Client.
 */
require_once dirname( PLUGIN_FILE ) . '/libraries/updateclient/UpdateClient.class.php';

/**
 * Include setup of registration activation hook, actions, filters and shortcodes.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/setup.php';

/**
 * Load styles functions.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/functions-styles.php';

/**
 * Load scripts functions.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/functions-scripts.php';

/**
 * Load menu functions.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/functions-menu.php';

/**
 * Load language functions.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/functions-language.php';

/**
 * Load plugin image functions.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/functions-plugin-images.php';

/**
 * Load settings functions.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/functions-settings.php';

/**
 * Load plugin functionality.
 */
require_once dirname( PLUGIN_FILE ) . '/includes/plugin-functionality.php';
