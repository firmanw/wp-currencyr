<?php
/**
 * Currencyr
 *
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */

/**
 * Currencyr_Widget
 */
require_once CURRENCYR_LIBS . '/abstract-currencyr-provider.php';

/**
 * Currencyr_Widget
 */
require_once CURRENCYR_LIBS . '/class-currencyr-widget.php';

/**
 * Currencyr class.
 *
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */
class Currencyr
{
    const Id = 'currencyr';
    const Slug = 'currencyr';
    const Textdomain = 'currencyr';

    /**
     * Currency exchange service providers.
     *
     * @var array
     * @since 1.0
     */
    protected $providers = array();


    /**
     * Default settings
     *
     * @var array
     * @since 1.0
     */
    protected $settings = array(
        'provider'              => 'yahoo',
        'oxrapp_id'             => '',
        'base'                  => 'USD',
        'update'                => 'twicedaily',
        'shortcode_separator'   => ' / ',
        'amount_selector'       => '.amount',
        'inline_converter'      => 'on',
        'follow_plugin'         => false,
        'thousand'              => ',',
        'decimal'               => '.',
        'precision'             => 2
    );


    /**
     * List of created WordPress pages returned by add_menu_page() and add_submenu_page().
     *
     * @var array
     * @since 1.0
     */
    protected $pages = array();


    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->providers = $this->get_providers();

        add_action( 'plugins_loaded', array( $this, 'update' ) );
        add_action( 'init', array( $this, 'init' ) );

        add_action( 'wp_print_styles', array( $this, 'print_styles' ) );
        add_action( 'wp_print_scripts', array( $this, 'print_scripts' ) );

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_head', array( $this, 'admin_head' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );

        add_action( 'currencyr_update_rates', array( $this, 'update_rates' ) );

        add_action( 'wp_ajax_nopriv_currencyr_data', array( $this, 'json_data' ) );
        add_action( 'wp_ajax_currencyr_data', array( $this, 'json_data' ) );

        add_action( 'widgets_init', create_function( '', 'register_widget("Currencyr_Widget");' ) );

        add_filter( 'contextual_help', array( $this, 'contextual_help' ) , 10, 3 );
        add_filter( 'plugin_action_links_' . CURRENCYR_PLUGIN_BASENAME, array( $this, 'plugin_action_links' ) );
        add_shortcode( self::Id, array( $this, 'shortcode' ) );
    }

    /**
     * Magic function to access settings and essential variables.
     *
     * @param string $name
     * @return mixed
     * @since 1.0
     */
    public function __get( $name )
    {
        if ( $name == 'updated') {
          if ( ( $uptime = get_transient( self::Id . '_updated' ) ) !== false ) {
              return date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $uptime );
          }
        }

        $commerce = self::get_active_commerce();
        if ( $name == 'base' && in_array( $this->follow_plugin, $commerce ) ) {
            $base = null;
            switch ( $this->follow_plugin )
            {
                case 'woocommerce':
                    $base = self::get_woocommerce_currency();
                break;
                case 'wp-e-commerce':
                    $base = self::get_wpcommerce_currency();
                break;
                case 'shopp':
                    $base = self::get_shopp_currency();
                break;
                case 'easy-digital-downloads':
                    $base = self::get_edd_currency();
                break;
            }

            if ( !is_null( $base ) ) {
                return $base;
            }
        }


        if ( array_key_exists( $name, $this->settings ) ) {
            return $this->settings[$name];
        }

        return null;
    }


    /**
     * Plugin activation
     *
     * @return void
     * @since 1.0
     */
    public function activate()
    {
        global $wpdb;

        // Install a database table
        $sql = 'CREATE TABLE `' . $wpdb->prefix . CURRENCYR_DBTABLE . '` (
                  `currency_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                  `code` varchar(255) NOT NULL,
                  `rate` float NOT NULL DEFAULT \'0\',
                  `provider` varchar(255) NOT NULL DEFAULT \'custom\',
                  `name` text,
                  `symbol` varchar(255),
                  `html` varchar(255),
                  PRIMARY KEY (`currency_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;';

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );

        add_option( 'currencyr_db_version', CURRENCYR_VERSION );

        // Set the schedule
        $this->set_schedule();
    }


    /**
     * Plugin deactivation
     *
     * @return void
     * @since 1.0
     */
    public function deactivate()
    {
        global $wpdb;

        // Drop the database table
        $sql = 'DROP TABLE `' . $wpdb->prefix . CURRENCYR_DBTABLE . '`';
        $wpdb->query( $sql );

        // Delete the options
        delete_option( 'currencyr_db_version' );
        delete_option( 'currencyr_settings' );

        // Delete transient
        delete_transient( self::Id . '_updated' );

        // Delete cron schedule
        wp_clear_scheduled_hook( 'currencyr_update_rates' );
    }


    /**
     * Update function
     *
     * @return void
     * @since 1.0
     */
    public function update()
    {
        // Nothing at this moment
    }

    /**
     * Add settings link into plugin page.
     *
     * @param array $actions Currency links.
     * @return array
     */
    public function plugin_action_links( $actions )
    {
        array_unshift($actions, sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=' . self::Id ), __( 'Settings', self::Textdomain ) ) );
        return $actions;
    }

    /**
     * Initialization
     *
     * @return void
     * @since 1.0
     */
    public function init()
    {
        load_plugin_textdomain( self::Textdomain, false, dirname( CURRENCYR_PLUGIN_BASENAME ) . '/languages/' );

        wp_register_style( 'currencyr-core', CURRENCYR_PLUGIN_ASSETS . '/css/currencyr.css', array(), CURRENCYR_VERSION );
        wp_register_style( 'currencyr', CURRENCYR_PLUGIN_ASSETS . '/css/themes/light/light.css', array( 'currencyr-core' ), CURRENCYR_VERSION );

        wp_register_script( 'currencyr', CURRENCYR_PLUGIN_ASSETS . '/js/currencyr.min.js', array( 'jquery' ), CURRENCYR_VERSION );
        wp_register_script( 'currencyr-init', CURRENCYR_PLUGIN_ASSETS . '/js/init.js', array( 'jquery', 'currencyr' ), CURRENCYR_VERSION );

        wp_register_script( 'currencyr-admin', CURRENCYR_PLUGIN_ASSETS . '/js/admin.js', array( 'jquery' ), CURRENCYR_VERSION );

        $options = get_option( self::Id . '_settings' );
        if ( !empty( $options ) ) {
            $this->settings = array_merge( $this->settings, $options );
        }
    }

    /**
     * print_styles callback.
     *
     * @return void
     * @since 1.0
     */
    public function print_styles()
    {
        if ( !is_admin() ) {
            wp_enqueue_style( 'currencyr' );
        }
    }

    /**
     * print_scripts callback.
     *
     * @return void
     * @since 1.0
     */
    public function print_scripts()
    {
        if ( is_admin() ) {
            wp_enqueue_script( 'currencyr-admin' );
        } else {
            wp_enqueue_script( 'currencyr' );
            wp_enqueue_script( 'currencyr-init' );
            wp_localize_script( 'currencyr-init', 'currencyr_settings', array(
                'ajaxurl'   => admin_url( 'admin-ajax.php' ),
                'selector'  => $this->amount_selector,
                'currency'  => $this->get_localcurrency(),
                'thousand'  => $this->thousand,
                'decimal'   => $this->decimal,
                'precision' => $this->precision
            ) );
        }
    }

    /**
     * Wrapper function to add_settings_field.
     *
     * @since 1.0
     */
    protected function add_setting( $field, $title )
    {
        add_settings_field(
            $field,
            $title,
            array(&$this, "setting_{$field}"),
            self::Slug,
            self::Id,
            array( 'label_for' => self::setting_input_id( $field ) )
        );
    }

    /**
     * Get input id
     *
     * @return string
     * @since 1.0
     */
    protected static function setting_input_id( $field )
    {
        return self::Id . "-settings-{$field}";
    }

    /**
     * Get input name
     *
     * @return string
     * @since 1.0
     */
    protected static function setting_input_name( $field )
    {
        return self::Id . "_settings[{$field}]";
    }

    /**
     * admin_init callback.
     *
     * @return void
     * @since 1.0
     */
    public function admin_init()
    {
        register_setting( self::Slug, self::Id . '_settings', array( $this, 'sanitize_input' ) );

        add_settings_section( self::Id, '', array(&$this, 'section_callback'), self::Slug );

        $this->add_setting( 'base', __( 'Base Currency', self::Textdomain ) );
        $this->add_setting( 'provider', __( 'Provider', self::Textdomain ) );
        $this->add_setting( 'oxrapp_id', __( 'Open Exchange Rates App ID', self::Textdomain ) );
        $this->add_setting( 'update', __( 'Update Rates', self::Textdomain ) );
        $this->add_setting( 'inline_converter', __( 'Currencyr for jQuery', self::Textdomain ) );
        $this->add_setting( 'amount_selector', __( 'Amount Selector', self::Textdomain ) );
        $this->add_setting( 'thousand', __( 'Thousand Separator', self::Textdomain ) );
        $this->add_setting( 'decimal', __( 'Decimal Point Separator', self::Textdomain ) );
        $this->add_setting( 'precision', __( 'Decimal Places', self::Textdomain ) );
        $this->add_setting( 'shortcode_separator', __( 'Multiple Separator', self::Textdomain ) );

        add_action('wp_ajax_currencyr_update', array( $this, 'ajax_update_rates' ) );
    }

    /**
     * Output css for admin icon.
     *
     * @since 1.0
     */
    public function admin_head()
    {
    ?>
    <style type="text/css" id="currencyr-menu-css">
        /* Admin Menu - 16px
           Use only if you put your plugin or option page in the top level via add_menu_page()
        */
        #toplevel_page_<?php echo self::Id; ?> .wp-menu-image {
            background: url(<?php echo CURRENCYR_PLUGIN_ASSETS ?>/images/menuicon-sprite.png) no-repeat 6px 6px;
        }
        /* We need to hide the generic.png img element inserted by default */
        #toplevel_page_<?php echo self::Id; ?> .wp-menu-image img {
            display: none;
        }
        #toplevel_page_<?php echo self::Id; ?>:hover .wp-menu-image, #toplevel_page_currencyr.wp-has-current-submenu .wp-menu-image {
            background-position: 6px -26px;
        }

        /* Option Screen - 32px */
        #icon-options-<?php echo self::Id; ?>.icon32 {
            background: url(<?php echo CURRENCYR_PLUGIN_ASSETS ?>/images/pageicon32.png) no-repeat left top;
        }

        @media
        only screen and (-webkit-min-device-pixel-ratio: 1.5),
        only screen and (   min--moz-device-pixel-ratio: 1.5),
        only screen and (     -o-min-device-pixel-ratio: 3/2),
        only screen and (        min-device-pixel-ratio: 1.5),
        only screen and (            min-resolution: 1.5dppx) {
            /* Admin Menu - 16px @2x
               Use only if you put your plugin or option page in the top level via add_menu_page()
            */
            #toplevel_page_<?php echo self::Id; ?> .wp-menu-image {
                background-image: url('<?php echo CURRENCYR_PLUGIN_ASSETS; ?>/images/menuicon-sprite-2x.png') !important;
                -webkit-background-size: 16px 48px;
                -moz-background-size: 16px 48px;
                background-size: 16px 48px;
            }

            /* Option Screen - 32px @2x */
            #icon-options-<?php echo self::Id; ?>.icon32 {
                background-image: url('<?php echo CURRENCYR_PLUGIN_ASSETS; ?>/images/pageicon32-2x.png') !important;
                -webkit-background-size: 32px 32px;
                -moz-background-size: 32px 32px;
                background-size: 32px 32px;
            }
        }
    </style>
    <?php
    }


    /**
     * admin_menu callback.
     *
     * @return void
     * @since 1.0
     */
    public function admin_menu()
    {
        $this->pages['top'] = add_menu_page( __( 'Currencyr Settings', self::Textdomain ), __( 'Currencyr', self::Textdomain ), 'manage_options', self::Slug, array( $this, 'settings_page'), 'div' );
        $this->pages['settings'] = add_submenu_page( self::Slug, __( 'Currencyr Settings', self::Textdomain ), __( 'Settings', self::Textdomain ), 'manage_options', self::Slug, array( $this, 'settings_page' ) );
        // $this->pages['currencies'] = add_submenu_page( self::Slug, __( 'Currencies', self::Textdomain ), __( 'Currencies', self::Textdomain ), 'manage_options', self::Slug . '_currencies', array( $this, 'currencies_page' ) );
    }


    /**
     * contextual_help callback.
     *
     * @param string $contextual_help
     * @param string $screen_id
     * @param object $screen
     * @return void
     * @since 1.0
     */
    public function contextual_help( $contextual_help, $screen_id, $screen )
    {
        if ( isset( $this->pages['settings'] ) && $screen_id == $this->pages['settings'] ) {
            $screen->add_help_tab( array(
                'id'      => 'overview',
                'title'   => 'Overview',
                'content' =>
                  '<p>This is screen where you can configure the Currencyr settings.</p>
                  <p>Currencyr is able to use WooCommerce, WP-eCommerce, Shopp and Easy Digital Downloads <em>currency</em> setting,
                  the checkbox/radio will appear once one or more of those plugin activated.</p>'
            ) );
        }
    }


    /**
     * section_callback callback.
     *
     * @return void
     * @since 1.0
     */
    public function section_callback()
    {
        // do nothing
    }


    /**
     * provider setting input callback.
     *
     * @return void
     * @since 1.0
     */
    public function setting_provider()
    {
        asort( $this->providers );

        printf( '<select name="%s" id="%s">', self::setting_input_name( 'provider' ), self::setting_input_id( 'provider' ) );
        foreach( $this->providers as $id => $name ) {
            echo '<option value="' . $id . '"' . ( $this->settings['provider'] == $id ? ' selected="selected"': '' ) . '>' . $name . '</option>';
        }
        echo '</select>';
    }

    /**
     * base setting input callback.
     *
     * @return void
     * @since 1.0
     */
    public function setting_base()
    {
        include_once 'class-currencyr-iso.php';

        $commerce = self::get_active_commerce();
        $input_type = 'checkbox';
        if ( count( $commerce ) > 1 ) {
            $input_type = 'radio';
        }

        if ( in_array( 'woocommerce', $commerce ) )
        {
            $currency = self::get_woocommerce_currency();
            printf( '<label><input type="%s" name="%s" id="%s" value="woocommerce" %s> %s (%s)</label><br>' . "\n",
                $input_type,
                self::setting_input_name( 'follow_plugin' ),
                self::setting_input_id( 'follow_plugin' ),
                $this->settings['follow_plugin'] == 'woocommerce' ? 'checked="checked"' : '',
                __( 'Use WooCommerce Currency', self::Textdomain ),
                !is_null( $currency ) ? $currency : __( 'NOT SET', self::Textdomain )
            );
        }

        if ( in_array( 'wp-e-commerce', $commerce ) )
        {
            $currency = self::get_wpcommerce_currency();
            printf( '<label><input type="%s" name="%s" id="%s" value="wp-e-commerce" %s> %s (%s)</label><br>' . "\n",
                $input_type,
                self::setting_input_name( 'follow_plugin' ),
                self::setting_input_id( 'follow_plugin' ),
                $this->settings['follow_plugin'] == 'wp-e-commerce' ? 'checked="checked"' : '',
                __( 'Use WP e-Commerce Currency', self::Textdomain ),
                !is_null( $currency ) ? $currency : __( 'NOT SET', self::Textdomain )
            );
        }

        if ( in_array( 'shopp', $commerce ) )
        {
            $currency = self::get_shopp_currency();
            printf( '<label><input type="%s" name="%s" id="%s" value="shopp" %s> %s (%s)</label><br>' . "\n",
                $input_type,
                self::setting_input_name( 'follow_plugin' ),
                self::setting_input_id( 'follow_plugin' ),
                $this->settings['follow_plugin'] == 'shopp' ? 'checked="checked"' : '',
                __( 'Use Shopp Currency', self::Textdomain ),
                !is_null( $currency ) ? $currency : __( 'NOT SET', self::Textdomain )
            );
        }

        if ( in_array( 'easy-digital-downloads', $commerce ) )
        {
            $currency = self::get_edd_currency();
            printf( '<label><input type="%s" name="%s" id="%s" value="easy-digital-downloads" %s> %s (%s)</label><br>' . "\n",
                $input_type,
                self::setting_input_name( 'follow_plugin' ),
                self::setting_input_id( 'follow_plugin' ),
                $this->settings['follow_plugin'] == 'easy-digital-downloads' ? 'checked="checked"' : '',
                __( 'Use Easy Digital Downloads Currency', self::Textdomain ),
                !is_null( $currency ) ? $currency : __( 'NOT SET', self::Textdomain )
            );
        }

        printf( '<select name="%s" id="%s">' . "\n", self::setting_input_name( 'base' ), self::setting_input_id( 'base' ) );
        foreach( Currencyr_ISO::$currency as $code => $info ) {
            echo '<option value="' . $code . '"' . ( $this->settings['base'] == $code ? ' selected="selected"': '' ) . '>' . "{$info['name']} ({$code})" . '</option>' . "\n";
        }
        echo '</select>' . "\n";
    }

    /**
     * update setting input callback.
     *
     * @return void
     * @since 1.0
     */
    public function setting_update()
    {
        $schedules = wp_get_schedules();
        $options = array();
        foreach ( $schedules as $key => $info ) {
            $options[$key] = $info['display'];
        }

        $updated = 'Never';
        if ( ( $uptime = get_transient(self::Id . '_updated') ) !== false ) {
            $updated = date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $uptime );
        }

        printf( '<select name="%s" id="%s">', self::setting_input_name( 'update' ), self::setting_input_id( 'update' ) );
        foreach( $options as $value => $text ) {
            printf( '<option value="%s"%s>%s</option>', $value, $this->settings['update'] == $value ? ' selected="selected"': '', $text );
        }
        echo '</select>';
        printf( '<input type="button" value="%s" class="button" id="%s">', __( 'Update', self::Textdomain ), self::Slug . '-update' );
        printf( '<p class="description">%s <strong>%s</strong></p>', __( 'The length of time to update the exchange rates.<br>', self::Textdomain ), sprintf( __( 'Last update: <span id="%s">%s</span>', self::Textdomain ), self::Slug . '-updated', $updated ) );
    }

    /**
     * shortcode setting input callback.
     *
     * @since  1.0
     */
    public function setting_shortcode_separator()
    {
        printf( '<input type="text" style="width: 3em;" name="%s" id="%s" value="%s">',
            self::setting_input_name( 'shortcode_separator' ),
            self::setting_input_id( 'shortcode_separator' ),
            esc_html( $this->settings['shortcode_separator'] )
        );
        printf( '<p class="description">%s</p>', __( 'The separator of multiple currency of shortcode output.', self::Textdomain ) );
    }

    /**
     * Open Exchange APP ID setting input callback.
     *
     * @since  1.0
     */
    public function setting_oxrapp_id()
    {
        printf( '<input type="text" class="regular-text" name="%s" id="%s" value="%s"> %s',
            self::setting_input_name( 'oxrapp_id' ),
            self::setting_input_id( 'oxrapp_id' ),
            $this->settings['oxrapp_id'], __( '(If you choose Open Exchange Rates)', self::Textdomain )
        );
        printf( '<p class="description">%s</p>', __( 'The App ID to access <a href="http://openexchangerates.org/">Open Exchange Rates</a> API service. <a href="https://openexchangerates.org/signup">Sign up</a> to get yours.', self::Textdomain ) );
    }

    /**
     * Amount jQuery Selector setting input callback.
     *
     * @since  1.0
     */
    public function setting_amount_selector()
    {
        printf( '<input type="text" class="regular-text" name="%s" id="%s" value="%s">',
            self::setting_input_name( 'amount_selector' ),
            self::setting_input_id( 'amount_selector' ),
            $this->settings['amount_selector']
        );
        printf( '<p class="description">%s</p>', __( 'The <a href="http://api.jquery.com/category/selectors/">jQuery Selector</a> match amount. Requires by Currencyr for jQuery.', self::Textdomain ) );
    }

    /**
     * Inline converter setting input callback.
     *
     * @since  1.0
     */
    public function setting_inline_converter()
    {
        printf( '<label for="%2$s"><input type="checkbox" name="%1$s" id="%2$s"%3$s> %4$s</label>',
            self::setting_input_name( 'inline_converter' ),
            self::setting_input_id( 'inline_converter_enable' ),
            $this->settings['inline_converter'] == 'on' ? ' checked="checked"' : '',
            __( 'Enable', self::Textdomain )
        );
    }

    /**
     * Thousand separator
     *
     * @since  1.0
     */
    public function setting_thousand( $args )
    {
        printf( '<input type="text" style="width: 3em;" name="%s" id="%s" value="%s">',
            self::setting_input_name( 'thousand' ),
            self::setting_input_id( 'thousand' ),
            $this->settings['thousand']
        );
    }

    /**
     * Decimal point separator
     *
     * @since  1.0
     */
    public function setting_decimal()
    {
        printf( '<input type="text" style="width: 3em;" name="%s" id="%s" value="%s">',
            self::setting_input_name( 'decimal' ),
            self::setting_input_id( 'decimal' ),
            $this->settings['decimal']
        );
    }

    /**
     * Decimal places
     *
     * @since  1.0
     */
    public function setting_precision()
    {
        printf( '<input type="text" style="width: 3em;" name="%s" id="%s" value="%s">',
            self::setting_input_name( 'precision' ),
            self::setting_input_id( 'precision' ),
            $this->settings['precision']
        );
    }

    /**
     * Settings page callback.
     *
     * @return void
     * @since 1.0
     */
    public function settings_page()
    {
    ?>
        <div class="wrap">
          <div id="icon-options-<?php echo self::Id; ?>" class="icon32"></div>
          <h2><?php _e( 'Currencyr Settings', self::Textdomain ); ?></h2>

          <?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ) : ?>
          <div id="message" class="updated below-h2">
            <p><strong><?php _e( 'Settings saved.', self::Textdomain ); ?></strong></p>
          </div>
          <?php endif; ?>

          <?php if ( !get_transient(self::Id . '_updated') ): ?>
          <div class="error">
            <p>Currencyr just activated, please select the Provider and click Update to initialize the cache.</p>
          </div>
          <?php endif; ?>

          <form action="options.php" method="post">
            <?php settings_fields( self::Slug ); ?>
            <?php do_settings_sections( self::Slug ); ?>
            <p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes', self::Textdomain ); ?>" /></p>
          </form>
        </div>
    <?php
    }

    /**
     * Currencies page callback.
     *
     * @return void
     * @since 1.0
     */
    public function currencies_page()
    {
        // Not implemented yet
    }

    /**
     * shortcode callback.
     *
     * @param mixed $atts
     * @return void
     * @since 1.0
     */
    public function shortcode( $atts )
    {
        extract( shortcode_atts( array(
            'amount'    => 1,
            'from'      => 'usd',
            'to'        => 'usd',
            'provider'  => $this->settings['provider']
        ), $atts ) );

        $amount = (float) $amount;

        $res = $this->convert( $to, $amount, $from, $provider );
        $out = array();
        foreach( $res as $s => $a ) {
            $out[] = sprintf( '%s %s', number_format( $a, $this->precision, $this->decimal, $this->thousand ), strtoupper($s) );
        }

        return implode( $this->settings['shortcode_separator'], $out );
    }

    /**
     * sanitize_input callback.
     *
     * @return void
     * @since 1.0
     */
    public function sanitize_input($input)
    {
        $changed = false;
        if ( $input['base'] != $this->settings['base'] || $input['provider'] != $this->settings['provider']) {
            $changed = true;
        }

        if ( $changed ) {
            $this->settings = array_merge( $this->settings, $input );
            $this->update_rates();
        }

        $this->set_schedule( $input['update'] );

        return $input;
    }

    /**
     * Set WP Cron schedule.
     *
     * @param integer $interval Interval in second. (optional) (default: null)
     * @since 1.0
     */
    public function set_schedule( $interval = null )
    {
        if ( !wp_next_scheduled( 'currencyr_update_rates' ) ) {
            wp_schedule_event( time(), $this->settings['update'], 'currencyr_update_rates' );
        } else if ( $interval !== null && $interval != wp_get_schedule( 'currencyr_update_rates' ) && $interval != false ) {
            // Reschedule event according the give interval
            wp_clear_scheduled_hook( 'currencyr_update_rates' );
            wp_schedule_event( time(), $interval, 'currencyr_update_rates' );
        }
    }

    /**
     * Get available providers.
     *
     * @return array
     * @since 1.0
     */
    protected function get_providers()
    {
        $providers = array();
        if ( $handle = opendir( dirname(__FILE__ ) ) ) {
            while ( false !== ( $entry = readdir( $handle ) ) ) {
                if ($entry != "." && $entry != ".." && preg_match( '/class-currencyr-provider-(\w+)\.php/', $entry, $matches ) ) {
                    include_once dirname( __FILE__ ) . "/$matches[0]";

                    $class = "currencyr_provider_{$matches[1]}";
                    if ( class_exists( $class ) ) {
                        $providers[ $matches[1] ] = eval( "return currencyr_provider_{$matches[1]}::Name;" );
                    }
                }
            }
            closedir($handle);
        }

        return $providers;
    }

    /**
     * Get available currencies.
     *
     * @return array()
     * @since 1.0
     */
    public function get_currencies()
    {
        global $wpdb;

        $sql = 'SELECT * FROM ' . $wpdb->prefix . CURRENCYR_DBTABLE . ' WHERE provider = %s OR provider = %s ORDER BY code';
        $res = $wpdb->get_results( $wpdb->prepare( $sql, array( $this->settings['provider'], 'custom' ) ) );

        include_once 'class-currencyr-iso.php';

        $results = array();
        foreach ( $res as $row ) {
            $results[$row->code] = array(
              'name'    => $row->name,
              'symbol'  => $row->symbol,
              'html'    => $row->html
            );

            if ( empty( $row->name ) && array_key_exists( $row->code, Currencyr_ISO::$currency ) ) {
                $results[$row->code]['name'] = Currencyr_ISO::$currency[$row->code]['name'];
            }

            if ( empty( $row->symbol ) && Currencyr_ISO::symbol( $row->code ) ) {
                $results[$row->code]['symbol'] = Currencyr_ISO::symbol( $row->code );
            }

            if ( empty( $row->html ) && Currencyr_ISO::html( $row->code ) ) {
                $results[$row->code]['html'] = Currencyr_ISO::html( $row->code );
            }
        }

        return $results;
    }

    /**
     * Convert the currency.
     *
     * @param string $to Currency code. Use commas separator for multiple.
     * @param float $amount Amount (optional) (default: 1)
     * @param string $from From currency code. Use the base setting if omitted. (optional) (default: null)
     * @param string $provider Provider. Use the provider setting if omitted. (optional) (default: null)
     * @return array
     * @since 1.0
     */
    public function convert($to, $amount = 1, $from = null, $provider = null )
    {
        global $wpdb;

        if ( $from === null || empty($from) ) {
            $from = $this->base;
        }

        if ( $provider === null || empty($provider) ) {
            $provider = $this->provider;
        }

        $target = $currencies = preg_split('/[\s\|]+/', $to);
        if ( !in_array( $from, $currencies ) ) {
            $currencies[] = $from;
        }

        $from = strtoupper( $from );
        array_walk( $target, create_function( '&$item,$key', '$item = strtoupper( $item );' ) );
        array_walk( $currencies, create_function( '&$item,$key', '$item = strtoupper( $item );' ) );

        $result = array();

        $sql = 'SELECT * FROM ' . $wpdb->prefix . CURRENCYR_DBTABLE . ' WHERE code IN ("' . implode( '", "', $currencies ) . '") AND (provider= %s OR provider = %s)';
        $res = $wpdb->get_results( $wpdb->prepare( $sql, array( $this->settings['provider'], 'custom' ) ) );
        if ( $res ) {
            $rates = array();
            foreach( $res as $row ) {
                $rates[$row->code] = $row->rate;
            }

            foreach( $target as $code ) {
                if ( !array_key_exists( $code, $rates ) ) {
                    continue;
                }

                if ( $from == $this->base ) {
                    $result[$code] = $amount * $rates[$code];
                } else {
                    $result[$code] = $amount * ( ( 1 / $rates[$from] ) * $rates[$code] );
                }
            }
        }

        return $result;
    }

    /**
     * Update the exchange rates.
     *
     * @return string Formatted time of last updated.
     * @since 1.0
     */
    public function update_rates()
    {
        require_once dirname(__FILE__) . "/abstract-currencyr-provider.php";
        require_once dirname(__FILE__) . "/class-currencyr-provider-{$this->settings['provider']}.php";
        $class = "currencyr_provider_{$this->settings['provider']}";
        $currency = new $class( $this );

        $res = $currency->update();
        $updated = current_time('timestamp');
        $timeout = wp_next_scheduled( 'currencyr_update_rates' );

        set_transient( self::Id . '_updated', $updated, $timeout );

        return date( get_option('date_format') . ' ' . get_option('time_format'), $updated );
    }

    /**
     * Ajaxified of update exchange rates function.
     *
     * @see Currencyr_Lite::update_rates()
     * @since 1.0
     */
    public function ajax_update_rates()
    {
        echo json_encode ( $this->update_rates() );
        exit;
    }

    /**
     * Returns the currency data in JSON
     *
     * @return string
     * @since 1.0
     */
    public function json_data()
    {
        $currency = array(
            'currencies' => array(),
            'rates'      => array(),
            'base'       => $this->base
        );

        include_once 'class-currencyr-iso.php';

        foreach( Currencyr_ISO::$currency as $code => $info ) {
            $currency[ 'currencies' ][ $code ] = $info[ 'name' ];
        }

        $currency[ 'rates' ] = $this->get_rates();

        echo json_encode( $currency );
        exit;
    }

    /**
     * Get the exchange rates.
     *
     * @return array
     * @since 1.0
     */
    public function get_rates()
    {
        global $wpdb;

        $sql = 'SELECT * FROM ' . $wpdb->prefix . CURRENCYR_DBTABLE . ' WHERE provider= %s OR provider = %s';
        $res = $wpdb->get_results( $wpdb->prepare( $sql, array( $this->settings['provider'], 'custom' ) ) );

        $rates = array();
        if ( $res ) {
            foreach( $res as $row ) {
                $rates[ $row->code ] = $row->rate;
            }
        }

        return $rates;
    }

    /**
     * Get an instance of ip2c.
     *
     * @return object
     * @since 1.0
     */
    protected static function ip2c()
    {
        require_once 'ip2c/ip2c.php';
        $ip2c = new ip2country( dirname(__FILE__) . '/ip2c/ip-to-country.bin' );
        return $ip2c;
    }

    /**
     * Get local currency according the current detected IP.
     *
     * @return string|bool A currency code or FALSE on failure.
     * @since 1.0
     */
    public static function get_localcurrency()
    {
        $ip2c = self::ip2c();
        $res = $ip2c->get_country( $_SERVER['REMOTE_ADDR'] );
        if ( !$res ) {
            return false;
        }

        include_once 'class-currencyr-iso.php';

        return Currencyr_ISO::currency( $res['id2'] );
    }

    /**
     * Get active commerce plugins.
     *
     * @return array
     * @since 1.0
     */
    public static function get_active_commerce()
    {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        $commerce = array();
        if ( is_plugin_active('woocommerce/woocommerce.php') ) {
            $commerce[] = 'woocommerce';
        }
        if ( is_plugin_active( 'wp-e-commerce/wp-shopping-cart.php' ) ) {
            $commerce[] = 'wp-e-commerce';
        }
        if ( is_plugin_active( 'shopp/Shopp.php' ) ) {
            $commerce[] = 'shopp';
        }
        if ( is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ) ) {
            $commerce[] = 'easy-digital-downloads';
        }

        return $commerce;
    }

    /**
     * Get WooCommerce currency setting.
     *
     * @return string|null
     * @since 1.0
     */
    public static function get_woocommerce_currency()
    {
        return strtoupper( get_option( 'woocommerce_currency' ) );
    }

    /**
     * Get WP e-Commerce currency setting.
     *
     * @return string|null
     * @since 1.0
     */
    public static function get_wpcommerce_currency()
    {
        global $wpdb;

        $id = get_option( 'currency_type' );
        if ( $id ) {
            return $wpdb->get_var( $wpdb->prepare( 'SELECT code FROM ' . WPSC_TABLE_CURRENCY_LIST . ' WHERE id = %d', $id ) );
        }
    }

    /**
     * Get Shopp currency setting.
     *
     * @return string|null
     * @since 1.0
     */
    public static function get_shopp_currency()
    {
        $setting = shopp_setting('base_operations');
        if ( $setting ) {
            return $setting['currency']['code'];
        }
    }

    /**
     * Get Easy Digital Downloads settings.
     *
     * @return string|null
     * @since 1.0
     */
    public static function get_edd_currency()
    {
        $setting = get_option( 'edd_settings_general' );
        if ( $setting ) {
            return $setting['currency'];
        }
    }

}
