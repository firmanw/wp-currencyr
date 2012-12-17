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
 *
 * @extends    WP_Widget
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */
class Currencyr_Widget extends WP_Widget
{
    /**
     * Constructor
     *
     * @since 1.0
     */
    public function __construct()
    {
        parent::WP_Widget( Currencyr::Id, 'Currencyr', array( 'description' => __( 'Displays live currency rates and converter', Currencyr::Textdomain ) ) );

        wp_register_script('currencyr-widget', CURRENCYR_PLUGIN_URL . 'assets/js/currencyr-widget.js', array( 'jquery' ), CURRENCYR_VERSION );
        add_action( 'wp_print_scripts', array( $this, 'print_scripts' ), 99 );

        wp_register_style('currencyr-widget', CURRENCYR_PLUGIN_URL . 'assets/css/currencyr-widget.css', array(), CURRENCYR_VERSION );
        add_action( 'wp_print_styles', array( $this, 'print_styles' ), 1 );

        add_action('wp_ajax_currencyr_convert', array( $this, 'ajax_convert' ) );
        add_action('wp_ajax_nopriv_currencyr_convert', array( $this, 'ajax_convert' ) );
    }

    /**
     * print_scripts callback.
     *
     * @since 1.0
     */
    public function print_scripts()
    {
        global $currencyr;

        if ( is_active_widget(false, false, $this->id_base ) && !is_admin() ) {
            wp_enqueue_script( 'currencyr-widget' );

            // If currencyr script not loaded
            if ( !wp_script_is( 'currencyr-init' ) ) {
                wp_localize_script( 'currencyr-widget', 'currencyr_settings', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
            }

            $currencies = $currencyr->get_currencies();
            $symbols = array();
            foreach( $currencies as $code => $info ) {
                $symbols[$code] = $info['html'];
            }

            wp_localize_script( 'currencyr-widget', 'currencyr_symbols', $symbols );
        }
    }

    /**
     * print_styles callback.
     */
    public function print_styles()
    {
        if ( is_active_widget(false, false, $this->id_base ) && !is_admin() ) {
            wp_enqueue_style( 'currencyr-widget' );
        }
    }

    /**
     * Display the widget
     *
     * @since 1.0
     */
    public function widget( $args, $instance )
    {
        global $currencyr;

        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );

        echo $before_widget;

        if ( !empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        if ( $instance['rates'] ):
        ?>
        <div class="currency-rates">
          <p class="currency-updated"><?php echo $currencyr->updated; ?></p>
          <p class="currency-base">1 <?php echo $currencyr->base; ?></p>
          <ul>
            <?php
            $codes = preg_replace('/\s*,\s*/', '|', $instance['currency']);
            $res = $currencyr->convert( $codes );
            if ( !empty( $res ) ) {
                foreach( $res as $code => $rate ) {
                    printf('<li><span>%s</span> %s</li>', $code, number_format( $rate, 4, $currencyr->decimal, $currencyr->thousand ) );
                }
            }
            ?>
          </ul>
        </div>
        <?php
        endif; // Show rates

        if ( $instance['converter'] ):
            $currency = $currencyr->get_currencies();
        ?>
        <form class="currency-converter" method="get">
          <p><label for="<?php echo "{$widget_id}-currency-from"; ?>"><?php _e( 'From:', 'currencyr' ); ?></label>
          <select name="from" id="<?php echo "{$widget_id}-currency-from"; ?>" class="currency-from">
            <option value="">...</option>
            <?php
            foreach( $currency as $code => $name )
            {
                printf( '<option value="%1$s"%2$s>%1$s</option>' . "\n", $code, $code == $currencyr->base ? ' selected' : '' );
            }
            ?>
          </select></p>

          <p><label for="<?php echo "{$widget_id}-currency-to"; ?>"><?php _e( 'To:', 'currencyr' ); ?></label>
          <select name="to" id="<?php echo "{$widget_id}-currency-to"; ?>" class="currency-to">
            <option value="">...</option>
            <?php
            foreach( $currency as $code => $name )
            {
                printf( '<option value="%1$s"%2$s>%1$s</option>' . "\n", $code, $code == Currencyr::get_localcurrency() ? ' selected' : '' );
            }
            ?>
          </select></p>

          <p class="currency-amount-wrapper"><label for="<?php echo "{$widget_id}-currency-amount"; ?>" class="currency-amount-code"><?php echo $currency[$currencyr->base]['html']; ?></label>
          <input type="text" name="amount" id="<?php echo "{$widget_id}-currency-amount"; ?>" size="16" class="currency-amount" value="1"></p>
          <p class="currency-result-wrapper"><label for="<?php echo "{$widget_id}-currency-result"; ?>" class="currency-result-code">&nbsp;</label>
          <input type="text" id="<?php echo "{$widget_id}-currency-result"; ?>" size="16" class="currency-result" readonly></p>
          <p><input type="submit" value="Convert" class="currency-submit"></p>
        </form>
        <?php
        endif; // Show converter

        echo $after_widget;
    }

    /**
     * Update the widget instance.
     *
     * @since 1.0
     */
    public function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['rates'] = $new_instance['rates'];
        $instance['currency'] = strip_tags( $new_instance['currency'] );
        $instance['converter'] = $new_instance['converter'];
        return $instance;
    }

    /**
     * Display the widget settings form.
     *
     * @since 1.0
     */
    public function form( $instance )
    {
        if ( $instance && array_key_exists( 'title', $instance ) ) $title = esc_attr( $instance['title'] );
        else $title = '';
        if ( $instance && array_key_exists( 'rates', $instance ) ) $rates = $instance['rates'];
        else $rates = true;
        if ( $instance && array_key_exists( 'currency', $instance ) ) $currency = esc_attr( $instance['currency'] );
        else $currency = '';
        if ( $instance && array_key_exists( 'converter', $instance ) ) $converter = $instance['converter'];
        else $converter = true;
   
        ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
        </p>
        <p>
          <input type="checkbox" id="<?php echo $this->get_field_id( 'rates' ); ?>" name="<?php echo $this->get_field_name( 'rates' ); ?>" <?php echo $rates ? 'checked' : '' ?>>
          <label for="<?php echo $this->get_field_id('rates'); ?>"><?php _e( 'Show rates', 'currencyr' ); ?></label> 
        </p>
        <p>
          <label><?php _e( 'Currency List:', 'currencyr' ); ?></label>
          <textarea class="widefat" id="<?php echo $this->get_field_id( 'currency' ); ?>" name="<?php echo $this->get_field_name( 'currency' ); ?>"><?php echo $currency; ?></textarea>
          <small>Currency codes, separated by commas.</small>
        </p>
        <p>
          <input type="checkbox" id="<?php echo $this->get_field_id( 'converter' ); ?>" name="<?php echo $this->get_field_name( 'converter' ); ?>" <?php echo $converter ? 'checked' : '' ?>>
          <label for="<?php echo $this->get_field_id('converter'); ?>"><?php _e( 'Show converter', 'currencyr' ); ?></label> 
        </p>
        <?php
    }

    /**
     * Ajaxified call for currency conversion.
     *
     * @since 1.0
     */
    public function ajax_convert()
    {
        global $currencyr;

        $res = $currencyr->convert( $_GET['to'], $_GET['amount'], $_GET['from'] );

        if ( isset( $res[ $_GET['to'] ] ) ) {
            $res = array(
                'amount'  => number_format( $res[ $_GET['to'] ], $currencyr->precision, $currencyr->decimal, $currencyr->thousand ),
                'code'    =>  $_GET['to'],
                'html'    => $_GET['to']
            );

            include_once 'class-currencyr-iso.php';
            if ( array_key_exists( $_GET['to'] , Currencyr_ISO::$currency ) && array_key_exists( 'html' , Currencyr_ISO::$currency[$_GET['to']] ) ) {
                $res['html'] = Currencyr_ISO::$currency[$_GET['to']]['html'];
            }
            echo json_encode( $res );
        } else {
            echo json_encode( false );
        }

        exit;
    }
}
