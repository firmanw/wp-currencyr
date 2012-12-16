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
 * Currencyr_Provider_Yahoo
 *
 * @extends    Currencyr_Provider
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */
class Currencyr_Provider_Yahoo extends Currencyr_Provider
{
    /**
     * Provider friendly name.
     *
     * @since 1.0
     */
    const Name = 'Yahoo! Finance';

    /**
     * Yahoo! currency exchange url.
     * 
     * (default value: 'http://query.yahooapis.com/v1/public/yql')
     * 
     * @var string
     * @since 1.0
     */
    protected $url = 'http://query.yahooapis.com/v1/public/yql';

    /**
     * Send a request to Yahoo! via YQL.
     * 
     * @return object
     * @link http://developer.yahoo.com/yql/console/
     * @since 1.0
     */
    protected function request()
    {
        $params = array(
            'q'       => 'select * from yahoo.finance.xchange where pair in ',
            'env'     => 'store://datatables.org/alltableswithkeys',
            'format'  => 'json'
        );

        include_once 'class-currencyr-iso.php';

        $pairs = array();
        foreach( Currencyr_ISO::$currency as $code => $info ) {
            $code = strtolower($code);
            $pairs[] = "\"{$this->currencyr->base}{$code}\"";
        }
        
        $params['q'] .= '(' . implode(',', $pairs) . ')';

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
        $rates = $response->query->results->rate;

        $result = array();
        foreach( $rates as $info ) {
            $code = substr($info->id, 3);
            $rate = (float) $info->Rate;
            if ( !empty( $rate ) ) {
                $result[$code] = $rate;
            }
        }
        $result[ $this->currencyr->base ] = 1;

        return $result;
    }
}