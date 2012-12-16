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
 * Currencyr_Provider
 *
 * @abstract
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */
abstract class Currencyr_Provider
{
    
    /**
     * An instance of Currencyr
     * 
     * @var Currencyr
     * @since 1.0
     */
    protected $currencyr;

    
    /**
     * Constructor.
     * 
     * @param array $settings Plugin settings.
     * @since 1.0
     */
    public function __construct( Currencyr $currencyr )
    {
        $this->currencyr = $currencyr;
    }

    
    /**
     * Update database table of currency exchange rates.
     * 
     * @return bool
     * @since 1.0
     */
    public function update()
    {
        global $wpdb;

        $provider = strtolower( str_replace( 'Currencyr_Provider_', '', get_class($this) ) );
        $rates = $this->rates();

        if ( !empty($rates) ) {
            foreach ( $rates as $code => $rate ) {
                $data = array(
                    'code'      => $code,
                    'rate'      => $rate,
                    'provider'  => $provider
                );
  
                $col = $wpdb->get_col('SELECT 1 FROM ' . $wpdb->prefix . CURRENCYR_DBTABLE . " WHERE code='{$code}' AND provider='{$provider}'");
                if ( empty($col) ) {
                    $wpdb->insert( $wpdb->prefix . CURRENCYR_DBTABLE, $data );
                } else {
                    $wpdb->update( $wpdb->prefix . CURRENCYR_DBTABLE, $data, array( 'code' => $code, 'provider' => $provider ) );
                }
            }
        }

        return true;
    }

    
    /**
     * Get the fetched exchange rates.
     * 
     * @abstract
     * @return array
     * @since 1.0
     */
    abstract protected function rates();
}
