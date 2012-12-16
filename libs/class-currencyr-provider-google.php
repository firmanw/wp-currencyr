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
class Currencyr_Provider_Google extends Currencyr_Provider
{
    /**
     * Provider friendly name.
     *
     * @since 1.0
     */
    const Name = 'Google Finance';

    /**
     * Google currency converter URL.
     * 
     * (default value: 'http://www.google.com/finance/converter')
     * 
     * @var string
     * @since 1.0
     */
    protected $url = 'http://www.google.com/finance/converter';

    
    /**
     * Send a GET request to Google.
     * 
     * @param string $from Currency code.
     * @param string $to Currency code
     * @return float|bool A amount of result or FALSE on failure.
     * @link http://www.google.com/finance/converter
     * @since 1.0
     */
    protected function request( $from, $to )
    {
        $params = array(
            'a'    => 1,
            'from' => $from,
            'to'   => $to
        );

        $url = $this->url . '?' . http_build_query($params);

        $result = file_get_contents($url);

        if ( preg_match( '@<span\s+class=.*>([\d|.]+)\s+([A-Z]+)</span>\s*@', $result, $matches ) ) {
            return (float) $matches[1];
        }

        return false;
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
            if ( ( $res = $this->request( $this->currencyr->base, $code ) ) !== false ) {
                $result[ $code ] = $res;
            }
        }
        $result[ $this->currencyr->base ] = 1;

        return $result;
    }
}
