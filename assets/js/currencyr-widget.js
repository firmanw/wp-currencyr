/*!
 * Currencyr for WordPress - Widget
 * Version 1.0
 *
 * Copyright (c) 2012 Firman Wandayandi
 * Licensed under GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @since 1.0
 */

(function ($) {

    $(document).ready(function() {
    
        // Bind "from" param
        $('select[name=from]', '.widget_currencyr .currency-converter').change(function() {
            var $parent = $(this).parents('.currency-converter');
            if ( $('option:selected', this).val() == '' ) $('.currency-amount-code', $parent).html( '&nbsp;' );
            else {
                if ( typeof currencyr_currency[$('option:selected', this).val()] == 'object' )
                    $('.currency-amount-code', $parent).html(currencyr_symbols[$('option:selected', this).val()]);
                else
                    $('.currency-amount-code', $parent).html($('option:selected', this).val());
            }
        });

        // Hide "to" param
        $('.currency-result-wrapper', '.widget_currencyr .currency-converter').hide();
        
        // Bind "to" param
        $('select[name=to]', '.widget_currencyr .currency-converter').change(function() {
            var $parent = $(this).parents('.currency-converter');
            if ( $('option:selected', this).val() == '' ) {
                $('.currency-result-wrapper', $parent).slideUp( function () {
                    $('.currency-result-code', $parent).html( '&nbsp;' );
                });
            } else {
                if ( currencyr_symbols[$('option:selected', this).val()] != 'undefined' )
                    $('.currency-result-code', $parent).html(currencyr_symbols[$('option:selected', this).val()]);
                else
                    $('.currency-result-code', $parent).html($('option:selected', this).val());

                $('.currency-result-wrapper', $parent).slideDown();
            }
        });

        // Bind the form submit
        $('.widget_currencyr .currency-converter').submit(function() {
            var self = this;
      
            var data = {
                'action': 'currencyr_convert',
                'from'  : $('select[name=from] option:selected', this).val(),
                'to'    : $('select[name=to] option:selected', this).val(),
                'amount': 0
            };

            amount = $( 'input[name=amount]', this ).val();
            if ( !isNaN( parseFloat(amount) ) && isFinite(amount) ) data.amount = parseFloat( amount );

            if ( !data.from || !data.to || !data.amount ) return false;

            $.get( currencyr_settings.ajaxurl, data, function( response ) {
                if ( response != false ) $( '.currency-result', self ).val( response.amount );
            }, 'json' );

            return false;
        });

    });

})(jQuery);
