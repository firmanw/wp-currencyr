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
 * Currencyr_Provider_OpenExchangeRates
 *
 * @extends    Currencyr_Provider
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */
class Currencyr_Provider_OpenExchangeRates extends Currencyr_Provider
{
    /**
     * Provider friendly name.
     *
     * @since 1.0
     */
    const Name = 'Open Exchange Rates';

    /**
     * Open Exchange Rates API Url.
     * 
     * (default value: 'http://openexchangerates.org/api/latest.json')
     * 
     * @var string
     * @since 1.0
     */
    protected $url = 'http://openexchangerates.org/api/latest.json';

    /**
     * Send a request to Open Exchange Rates.
     *
     * @return object
     * @link http://openexchangerates.org
     * @since 1.0
     */
    protected function request()
    {
        $params = array(
            'app_id'  => $this->currencyr->oxrapp_id
        );

        $url = $this->url . '?' . http_build_query($params);
        return json_decode( file_get_contents($url) );
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
        $response = $this->request();
        if ( isset( $response->error ) ) {
            return false;
        }

        $tmp = array( 'USD' => 1 );
        foreach( $response->rates as $code => $rate ) {
            $tmp[ $code ] = $rate;
        }

        if ( $this->currencyr->base != 'USD' && array_key_exists( $this->currencyr->base, $tmp ) ) {
            $base = $tmp[ $this->currencyr->base ];
            foreach( $tmp as $code => $rate ) {
                $result[ $code ] = ( 1 / $base ) * $rate;
            }
        } else {
            $result = $tmp;
        }

        $result[ $this->currencyr->base ] = 1;

        return $result;
    }
}
