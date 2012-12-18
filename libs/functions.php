<?php
/**
 * Currencyr
 *
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.2
 */

/**
 * Do exchange conversion.
 *
 * @param mixed Could be a string, an array or a float
 * @param string $to Currency code
 * @param string $from Currency code (optional)
 *
 * @return string|bool A formatted result on success or FALSE on failure
 * @since 1.0.2
 */
function currencyr_exchange( $args = null )
{
    global $currencyr;

    $result = array();

    if ( func_num_args() == 1 && ( is_string( $args) || is_array( $args ) ) )
    {
        $defaults = array(
            'amount'    => false,
            'to'        => false,
            'from'      => $currencyr->base,
        );

        $r = wp_parse_args( $args, $defaults );
        if ( $r['amount'] && $r['to'] ) {
            $result = $currencyr->convert( $r['to'], $r['amount'], $r['from'] );
        }
    } else if ( func_num_args() >= 2 ) {
        $args = func_get_args();
        $result = $currencyr->convert( $args[1], $args[0], isset( $args[2] ) ? $args[2] : $currencyr->base );
    }

    if ( is_array( $result ) && !empty( $result ) ) {
        return number_format( (float) array_shift( $result ), $currencyr->precision, $currencyr->decimal, $currencyr->thousand );
    }

    return false;
}

/**
 * Proxy call to currencyr_exchange()
 *
 * @param mixed Could be a string, an array or a float
 * @param string $to Currency code
 * @param string $from Currency code (optional)
 *
 * @return string|bool A formatted result on success or FALSE on failure
 * @since 1.0.2
 */
function the_currencyr_exchange( $args = null )
{
    echo call_user_func_array( 'currencyr_exchange', func_get_args() );
}
