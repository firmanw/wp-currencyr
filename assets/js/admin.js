/*!
 * Currencyr for WordPress - Admin
 * Version 1.0
 *
 * Copyright (c) 2012 Firman Wandayandi
 * Licensed under GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @since 1.0
 */

(function ($) {

    $(document).ready(function() {

        $('#currencyr-update').click(function() {
            $btn = $(this);
            $btn.val('Updating...').attr('disabled', 'disabled');
            $.get(ajaxurl, {action: 'currencyr_update'}, function(response) {
                $('#currencyr-updated').text(response);
                $btn.val('Update').removeAttr('disabled');
            }, 'json');
        });

    });

})(jQuery);
