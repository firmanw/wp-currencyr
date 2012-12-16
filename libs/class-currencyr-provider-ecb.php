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
class Currencyr_Provider_ECB extends Currencyr_Provider
{
    /**
     * Provider friendly name.
     *
     * @since 1.0
     */
    const Name = 'European Central Bank';

    /**
     * ECB feed.
     * 
     * (default value: 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml')
     * 
     * @var string
     * @since 1.0
     */
    protected $url = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

    /**
     * Call FoxRate RPC method.
     * 
     * @link http://developer.yahoo.com/yql/console/
     * @access protected
     * @return object
     * @since 1.0
     */
    protected function request()
    {
        return simplexml_load_file( $this->url );
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

        $result = array();
        if ( $response ) {
            // The rates are based on Euro. 
            $tmp = array( 'EUR' => 1 );
            foreach( $response->Cube->Cube->Cube as $exchange ) {
                $tmp[ (string) $exchange['currency'] ] = (float) $exchange['rate'];
            }

            if ( $this->currencyr->base != 'EUR' && array_key_exists( $this->currencyr->base, $tmp ) ) {
                $base = $tmp[ $this->currencyr->base ];
                foreach( $tmp as $code => $rate ) {
                    $result[ $code ] = ( 1 / $base ) * $rate;
                }
            } else {
                $result = $tmp;
            }
        }

        return $result;
    }
}
