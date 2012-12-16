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
 * Currencyr_Provider_FoxRate
 *
 * @extends    Currencyr_Provider
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */
class Currencyr_Provider_FoxRate extends Currencyr_Provider
{
    /**
     * Provider friendly name.
     *
     * @since 1.0
     */
    const Name = 'FoxRate';

    /**
     * FoxRate RPC Url.
     * 
     * (default value: 'http://foxrate.org/rpc/')
     * 
     * @var string
     * @since 1.0
     */
    protected $url = 'http://foxrate.org/rpc/';

    /**
     * Call FoxRate RPC method.
     * 
     * @param string $from Currency code.
     * @param string $to Currency code
     * @return object
     * @link http://foxrate.org/
     * @since 1.0
     */
    protected function request( $from, $to )
    {
        require_once ABSPATH . 'wp-includes/class-IXR.php';
        require_once ABSPATH . 'wp-includes/class-wp-http-ixr-client.php';
        $req = new WP_HTTP_IXR_Client( $this->url );
        if ( $req->query( 'foxrate.currencyConvert', $from, $to, 1 )  === false ) {
            return false;
        }

        return $req->message;
    }

    /**
     * Get the fetched exchange rates.
     * 
     * @abstract
     * @return array
     * @since 1.0
     */
    protected function rates()
    {
        include_once 'class-currencyr-iso.php';

        $result = array();
        foreach ( Currencyr_ISO::$currency as $code => $name ) {
            $response = $this->request( $this->currencyr->base, $code );
            if ( $response === false ) {
                return false;
            }

            if ( !empty( $response->params[0]['amount'] ) ) {
                $result[$code] = $response->params[0]['amount'];
            }
        }

        $result[ $this->currencyr->base ] = 1;
        return $result;
    }
}
