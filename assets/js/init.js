/*!
 * Currencyr for WordPress - Initialization
 * Version 1.0
 *
 * Copyright (c) 2012 Firman Wandayandi
 * Licensed under GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @since 1.0
 */

(function ($) {

    $(document).ready( function() {

        $.getJSON( currencyr_settings.ajaxurl, { action: 'currencyr_data' }, function( response ) {
            // Set the data
            $.currencyr( response.currencies, response.base, response.rates );

            // Call the plugin
            $( currencyr_settings.selector ).currencyr( {
                currency    : currencyr_settings.currency || null,
                thousand    : currencyr_settings.thousand,
                decimal     : currencyr_settings.decimal,
                precision   : currencyr_settings.precision
            } );
        } );

    } );

})(jQuery);