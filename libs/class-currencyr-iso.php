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
 * Currency information according to ISO
 *
 * @package    WordPress
 * @subpackage Currencyr
 * @copyright  Copyright (c) 2012 Firman Wandayandi
 * @license    GNU General Public License Version 2.0 http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0
 */
class Currencyr_ISO
{
    /**
     * List of currency information.as listed on ISO-4217 including symbol.
     * 
     * @var array
     * @access public
     * @since 1.0
     */
    public static $currency = array(
        'AED' => array(
            'name'   => 'United Arab Emirates Dirham',
            'symbol' => 'د.إ',
            'html'   => '&#1583;.&#1573;'
        ),
        'AFN' => array(
            'name'   => 'Afghan Afghani',
            'symbol' => '؋',
            'html'   => '&#1547;'
        ),
        'ALL' => array(
            'name'   => 'Albanian Lek',
            'symbol' => 'Lek',
            'html'   => 'Lek'
        ),
        'AMD' => array(
            'name'   => 'Armenian Dram',
            'symbol' => 'դր.',
            'html'   => '&#1380;&#1408;.'
        ),
        'ANG' => array(
            'name'   => 'Neth Antilles Guilder',
            'symbol' => 'NAƒ',
            'html'   => 'NA&#402;'
        ),
        'AOA' => array(
            'name'   => 'Angolan Kwanza',
            'symbol' => 'Kz',
            'html'   => 'Kz'
        ),
        'ARS' => array(
            'name'   => 'Argentine Peso',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'AUD' => array(
            'name'   => 'Australian Dollar',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'AWG' => array(
            'name'   => 'Aruba Florin',
            'symbol' => 'ƒ',
            'html'   => '&#402;'
        ),
        'AZN' => array(
            'name'   => 'Azerbaijani Manat',
        ),
        'BAM' => array(
            'name'   => 'Bosnia and Herzegovina Convertible Marka',
            'symbol' => 'KM',
            'html'   => 'KM'
        ),
        'BBD' => array(
            'name'   => 'Barbadian Dollar',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'BDT' => array(
            'name'   => 'Bangladeshi Taka',
            'symbol' => 'Tk',
            'html'   => 'Tk'
        ),
        'BGN' => array(
            'name'   => 'Bulgarian Lev',
            'symbol' => 'лв',
            'html'   => '&#1083;&#1074;'
        ),
        'BHD' => array(
            'name'   => 'Bahraini Dinar',
            'symbol' => '.د.ب',
            'html'   => '.&#1583;.&#1576;'
        ),
        'BIF' => array(
            'name'   => 'Burundi Franc',
            'symbol' => 'FBu',
            'html'   => 'FBu'
        ),
        'BMD' => array(
            'name'   => 'Bermuda Dollar',
            'symbol' => 'BD$',
            'html'   => 'BD&#36;'
        ),
        'BND' => array(
            'name'   => 'Brunei Dollar',
            'symbol' => 'B$',
            'html'   => 'B&#36;'
        ),
        'BOB' => array(
            'name'   => 'Bolivian Boliviano',
            'symbol' => 'Bs',
            'html'   => 'Bs'
        ),
        'BRL' => array(
            'name'   => 'Brazilian Real',
            'symbol' => 'R$',
            'html'   => 'R&#36;'
        ),
        'BSD' => array(
            'name'   => 'Bahamian Dollar',
            'symbol' => 'B$',
            'html'   => 'B&#36;'
        ),
        'BTN' => array(
            'name'   => 'Bhutan Ngultrum',
            'symbol' => 'Nu.',
            'html'   => 'Nu.'
        ),
        'BWP' => array(
            'name'   => 'Botswana Pula',
            'symbol' => 'P',
            'html'   => 'P'
        ),
        'BYR' => array(
            'name'   => 'Belarus Ruble',
            'symbol' => 'Br',
            'html'   => 'Br'
        ),
        'BZD' => array(
            'name'   => 'Belize Dollar',
            'symbol' => 'BZ$',
            'html'   => 'BZ&#36;'
        ),
        'CAD' => array(
            'name'   => 'Canada Dollar',
            'symbol' => 'C$',
            'html'   => 'C&#36;'
        ),
        'CDF' => array(
            'name'   => 'Congo/Kinshasa Franc',
            'symbol' => '₣',
            'html'   => '&#8355;'
        ),
        'CHF' => array(
            'name'   => 'Switzerland Franc',
            'symbol' => 'CHF',
            'html'   => 'CHF'
        ),
        'CLP' => array(
            'name'   => 'Chilean Peso',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'CNY' => array(
            'name'   => 'Chinese Yuan',
            'symbol' => '¥',
            'html'   => '&#165;'
        ),
        'COP' => array(
            'name'   => 'Colombian Peso',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'CRC' => array(
            'name'   => 'Costa Rica Colon',
            'symbol' => '₡',
            'html'   => '&#8353;'
        ),
        'CUC' => array(
            'name'   => 'Cuba Convertible Peso',
            'symbol' => 'CUC$',
            'html'   => 'CUC&#36;'
        ),
        'CUP' => array(
            'name'   => 'Cuban Peso',
            'symbol' => '$MN',
            'html'   => '&#36;'
        ),
        'CVE' => array(
            'name'   => 'Cape Verde Escudo',
            'symbol' => 'Esc',
            'html'   => 'Esc'
        ),
        'CZK' => array(
            'name'   => 'Czech Koruna',
            'symbol' => 'Kč',
            'html'   => 'K&#269;'
        ),
        'DJF' => array(
            'name'   => 'Djibouti Franc',
            'symbol' => 'Fdj',
            'html'   => 'Fdj'
        ),
        'DKK' => array(
            'name'   => 'Danish Krone',
            'symbol' => 'kr',
            'html'   => 'kr'
        ),
        'DOP' => array(
            'name'   => 'Dominican Peso',
            'symbol' => 'RD$',
            'html'   => 'RD&#36;'
        ),
        'DZD' => array(
            'name'   => 'Algerian Dinar',
            'symbol' => 'دج',
            'html'   => '&#1583;&#1580;'
        ),
        'EGP' => array(
            'name'   => 'Egyptian Pound',
            'symbol' => 'ج.م',
            'html'   => '&#1580;.'
        ),
        'ERN' => array(
            'name'   => 'Eritrea Nakfa',
            'symbol' => 'ج.م',
            'html'   => 'Nfk'
        ),
        'ETB' => array(
            'name'   => 'Ethiopian Birr',
            'symbol' => 'Br',
            'html'   => 'Br'
        ),
        'EUR' => array(
            'name'   => 'Euro',
            'symbol' => '€',
            'html'   => '&#8364;'
        ),
        'FJD' => array(
            'name'   => 'Fiji Dollar',
            'symbol' => 'FJ$',
            'html'   => 'FJ&#36;'
        ),
        'FKP' => array(
            'name'   => 'Falkland Islands Pound',
            'symbol' => '£',
            'html'   => '&#163;'
        ),
        'GBP' => array(
            'name'   => 'British Pound',
            'symbol' => '£',
            'html'   => '&#163;'
        ),
        'GEL' => array(
            'name'   => 'Georgian Lari',
            'symbol' => 'ლ',
            'html'   => '&#4314;'
        ),
        'GGP' => array(
            'name'   => 'Guernsey Pound',
        ),
        'GHS' => array(
            'name'   => 'GHS',
            'symbol' => 'GH¢',
            'html'   => 'GH¢'
        ),
        'GIP' => array(
            'name'   => 'Gibraltar Pound',
            'symbol' => '£',
            'html'   => '&#163;'
        ),
        'GMD' => array(
            'name'   => 'Gambian Dalasi',
            'symbol' => 'D',
            'html'   => 'D'
        ),
        'GNF' => array(
            'name'   => 'Guinea Franc',
            'symbol' => 'FG',
            'html'   => 'FG'
        ),
        'GTQ' => array(
            'name'   => 'Guatemala Quetzal',
            'symbol' => 'Q',
            'html'   => 'Q'
        ),
        'GYD' => array(
            'name'   => 'Guyana Dollar',
            'symbol' => 'GY$',
            'html'   => 'GY&#36;'
        ),
        'HKD' => array(
            'name'   => 'Hong Kong Dollar',
            'symbol' => 'HK$',
            'html'   => 'HK&#36;'
        ),
        'HNL' => array(
            'name'   => 'Honduras Lempira',
            'symbol' => 'L',
            'html'   => 'L'
        ),
        'HRK' => array(
            'name'   => 'Croatian Kuna',
            'symbol' => 'kn',
            'html'   => 'kn'
        ),
        'HTG' => array(
            'name'   => 'Haiti Gourde',
            'symbol' => 'HTG',
            'html'   => 'HTG'
        ),
        'HUF' => array(
            'name'   => 'Hungarian Forint',
            'symbol' => 'Ft',
            'html'   => 'Ft'
        ),
        'IDR' => array(
            'name'   => 'Indonesian Rupiah',
            'symbol' => 'Rp',
            'html'   => 'Rp'
        ),
        'ILS' => array(
            'name'   => 'Israeli Shekel',
            'symbol' => '₪',
            'html'   => '&#8362;'
        ),
        'IMP' => array(
            'name'   => 'Isle of Man Pound',
            'symbol' => '£',
            'html'   => '&#163;'
        ),
        'INR' => array(
            'name'   => 'Indian Rupee',
            'symbol' => 'Rs.',
            'html'   => 'Rs.'
        ),
        'IQD' => array(
            'name'   => 'Iraq Dinar',
            'symbol' => 'ع.د',
            'html'   => '&#03071;.'
        ),
        'IRR' => array(
            'name'   => 'Iran Rial',
            'symbol' => '﷼',
            'html'   => '&#65020;'
        ),
        'ISK' => array(
            'name'   => 'Iceland Krona',
            'symbol' => 'kr',
            'html'   => 'kr'
        ),
        'JEP' => array(
            'name'   => 'Jersey Pound',
            'symbol' => '£',
            'html'   => '&#163;'
        ),
        'JMD' => array(
            'name'   => 'Jamaican Dollar',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'JOD' => array(
            'name'   => 'Jordanian Dinar',
            'symbol' => 'JOD',
            'html'   => 'JOD'
        ),
        'JPY' => array(
            'name'   => 'Japanese Yen',
            'symbol' => '¥',
            'html'   => '&#165;'
        ),
        'KES' => array(
            'name'   => 'Kenya Shilling',
            'symbol' => 'KSh',
            'html'   => 'KSh'
        ),
        'KGS' => array(
            'name'   => 'Kyrgyzstani Som',
            'symbol' => 'сом',
            'html'   => '&#1089;'
        ),
        'KHR' => array(
            'name'   => 'Cambodia Riel',
            'symbol' => '៛',
            'html'   => '&#6107;'
        ),
        'KMF' => array(
            'name'   => 'Comoros Franc',
            'symbol' => 'KMF',
            'html'   => 'KMF'
        ),
        'KPW' => array(
            'name'   => 'North Korean Won',
            'symbol' => '₩',
            'html'   => '&#8361;'
        ),
        'KRW' => array(
            'name'   => 'South Korean Won',
            'symbol' => '₩',
            'html'   => '&#8361;'
        ),
        'KWD' => array(
            'name'   => 'Kuwait Dinar',
            'symbol' => 'د.ك',
            'html'   => '&#1583;.'
        ),
        'KYD' => array(
            'name'   => 'Cayman Islands Dollar',
            'symbol' => 'CI$',
            'html'   => 'CI&#36;'
        ),
        'KZT' => array(
            'name'   => 'Kazakhstan Tenge',
            'symbol' => 'KZT',
            'html'   => 'KZT'
        ),
        'LAK' => array(
            'name'   => 'Lao Kip',
            'symbol' => '₭',
            'html'   => '&#8365;'
        ),
        'LBP' => array(
            'name'   => 'Lebanese Pound',
            'symbol' => 'ل.ل',
            'html'   => '&#1604;.&#1604;'
        ),
        'LKR' => array(
            'name'   => 'Sri Langka Rupee',
            'symbol' => '₨',
            'html'   => '₨'
        ),
        'LRD' => array(
            'name'   => 'Liberian Dollar',
            'symbol' => 'L$',
            'html'   => 'L&#36;'
        ),
        'LSL' => array(
            'name'   => 'Lesotho Loti',
            'symbol' => 'L',
            'html'   => 'L'
        ),
        'LTL' => array(
            'name'   => 'Lithuanian Lita',
            'symbol' => 'Lt',
            'html'   => 'Lt'
        ),
        'LVL' => array(
            'name'   => 'Latvian Lat',
            'symbol' => 'Ls',
            'html'   => 'Ls'
        ),
        'LYD' => array(
            'name'   => 'Lybian Dinar',
            'symbol' => 'ل.د',
            'html'   => '&#1604;.'
        ),
        'MAD' => array(
            'name'   => 'Moroccan Dirham',
            'symbol' => 'د.م.',
            'html'   => '&#1583;.&#1605;.'
        ),
        'MDL' => array(
            'name'   => 'Moldovan Leu',
            'symbol' => 'MDL',
            'html'   => 'MDL'
        ),
        'MGA' => array(
            'name'   => 'Madagascar Ariary',
            'symbol' => 'Ar',
            'html'   => 'Ar'
        ),
        'MKD' => array(
            'name'   => 'Macedonian Denar',
            'symbol' => 'MKD',
            'html'   => 'MKD'
        ),
        'MMK' => array(
            'name'   => 'Myanmar Kyat',
            'symbol' => 'K',
            'html'   => 'K'
        ),
        'MNT' => array(
            'name'   => 'Mongolian Tugrik',
            'symbol' => '₮',
            'html'   => '&#8366;'
        ),
        'MOP' => array(
            'name'   => 'Macau Pataca',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'MRO' => array(
            'name'   => 'Mauritania Ougulya',
            'symbol' => 'UM',
            'html'   => 'UM'
        ),
        'MUR' => array(
            'name'   => 'Mauritius Rupee',
            'symbol' => 'Rs',
            'html'   => 'Rs'
        ),
        'MVR' => array(
            'name'   => 'Maldives Rufiyaa',
            'symbol' => 'Rf',
            'html'   => 'Rf'
        ),
        'MWK' => array(
            'name'   => 'Malawi Kwacha',
            'symbol' => 'MK',
            'html'   => 'MK'
        ),
        'MXN' => array(
            'name'   => 'Mexican Peso',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'MYR' => array(
            'name'   => 'Malaysian Ringgit (MYR)',
            'symbol' => 'RM',
            'html'   => 'RM'
        ),
        'MZN' => array(
            'name'   => 'Mozambique Metical',
            'symbol' => 'MT',
            'html'   => 'MT'
        ),
        'NAD' => array(
            'name'   => 'Namibian Dollar (NAD)',
            'symbol' => 'N$',
            'html'   => 'N&#36;'
        ),
        'NGN' => array(
            'name'   => 'Nigerian Naira',
            'symbol' => '₦',
            'html'   => '&#8358;'
        ),
        'NIO' => array(
            'name'   => 'Nicaragua Cordoba',
            'symbol' => 'C$',
            'html'   => 'C&#36;'
        ),
        'NOK' => array(
            'name'   => 'Norwegian Krone',
            'symbol' => 'kr',
            'html'   => 'kr'
        ),
        'NPR' => array(
            'name'   => 'Nepalese Rupee',
            'symbol' => 'Rs',
            'html'   => 'Rs'
        ),
        'NZD' => array(
            'name'   => 'New Zealand Dollar',
            'symbol' => '$',
            'html'   => '$'
        ),
        'OMR' => array(
            'name'   => 'Omani Rial',
            'symbol' => 'ر.ع.',
            'html'   => '&#1585;.&#1593;.'
        ),
        'PAB' => array(
            'name'   => 'Panama Balboa (PAB)',
            'symbol' => 'B',
            'html'   => 'B'
        ),
        'PEN' => array(
            'name'   => 'Peruvian Nuevo Sol',
            'symbol' => 'S/.',
            'html'   => 'S/.'
        ),
        'PGK' => array(
            'name'   => 'Papua New Guinea Kina',
            'symbol' => 'K',
            'html'   => 'K'
        ),
        'PHP' => array(
            'name'   => 'Philippine Peso',
            'symbol' => '₱',
            'html'   => '&#8369;'
        ),
        'PKR' => array(
            'name'   => 'Pakistani Rupee',
            'symbol' => 'Rs.',
            'html'   => 'Rs.'
        ),
        'PLN' => array(
            'name'   => 'Polish Zloty (PLN)',
            'symbol' => 'zł',
            'html'   => 'z&#322;'
        ),
        'PYG' => array(
            'name'   => 'Paraguayan Guarani',
            'symbol' => '₲',
            'html'   => '&#8370;'
        ),
        'QAR' => array(
            'name'   => 'Qatar Rial',
            'symbol' => 'ر.ق',
            'html'   => '&#1585;.'
        ),
        'RON' => array(
            'name'   => 'Romanian New Leu',
            'symbol' => 'L',
            'html'   => 'L'
        ),
        'RSD' => array(
            'name'   => 'Serbian Dinar',
            'symbol' => 'ДИН',
            'html'   => '&#1044;&#1048;&#1053;'
        ),
        'RUB' => array(
            'name'   => 'Russian Rouble',
            'symbol' => 'руб',
            'html'   => '&#1088;'
        ),
        'RWF' => array(
            'name'   => 'Rwanda Franc (RWF)',
            'symbol' => 'RF',
            'html'   => 'RF'
        ),
        'SAR' => array(
            'name'   => 'Saudi Arabian Riyal',
            'symbol' => 'ر.س',
            'html'   => '&#1585;.'
        ),
        'SBD' => array(
            'name'   => 'Solomon Islands Dollar (SBD)',
            'symbol' => 'SI$',
            'html'   => 'SI&#36;'
        ),
        'SCR' => array(
            'name'   => 'Seychelles Rupee',
            'symbol' => 'SR',
            'html'   => 'SR'
        ),
        'SDG' => array(
            'name'   => 'Sudanese Pound',
            'symbol' => 'SDG',
            'html'   => 'SDG'
        ),
        'SEK' => array(
            'name'   => 'Swedish Krona',
            'symbol' => 'kr',
            'html'   => 'kr'
        ),
        'SGD' => array(
            'name'   => 'Singapore Dollar (SGD)',
            'symbol' => 'S$',
            'html'   => 'S&#36;'
        ),
        'SHP' => array(
            'name'   => 'St Helena Pound (SHP)',
            'symbol' => '£',
            'html'   => '&#163;'
        ),
        'SLL' => array(
            'name'   => 'Sierra Leone Leone',
            'symbol' => 'Le',
            'html'   => 'Le'
        ),
        'SOS' => array(
            'name'   => 'Somali Shilling',
            'symbol' => 'So.',
            'html'   => 'So.'
        ),
        'SPL' => array(
            'name'   => 'Seborga Luigino',
        ),
        'SRD' => array(
            'name'   => 'Surinamese Dollar',
            'symbol' => 'SRD',
            'html'   => 'SRD'
        ),
        'STD' => array(
            'name'   => 'Sao Tome Dobra',
            'symbol' => 'Db',
            'html'   => 'Db'
        ),
        'SVC' => array(
            'name'   => 'El Salvador Colon',
            'symbol' => '₡',
            'html'   => '&#8353;'
        ),
        'SYP' => array(
            'name'   => 'Syrian Pound',
            'symbol' => 'SYP',
            'html'   => 'SYP'
        ),
        'SZL' => array(
            'name'   => 'Swaziland Lilageni',
            'symbol' => 'SZL',
            'html'   => 'SZL'
        ),
        'THB' => array(
            'name'   => 'Thai Baht',
            'symbol' => '฿',
            'html'   => '&#3647;'
        ),
        'TJS' => array(
            'name'   => 'Tajikistan Somoni',
        ),
        'TMT' => array(
            'name'   => 'Turkmenistan Manat',
        ),
        'TND' => array(
            'name'   => 'Tunisian Dinar',
            'symbol' => 'د.ت',
            'html'   => '&#1583;.&#1578;'
        ),
        'TOP' => array(
            'name'   => 'Tonga Pa\'ang',
            'symbol' => 'T$',
            'html'   => 'T&#36;'
        ),
        'TKY' => array(
            'name'   => 'Turkish Lira',
        ),
        'TTD' => array(
            'name'   => 'Trinidad  Tobago Dollar',
            'symbol' => 'TT$',
            'html'   => 'TT&#36;'
        ),
        'TVD' => array(
            'name'   => 'Tuvaluan Dollar',
        ),
        'TWD' => array(
            'name'   => 'Taiwan Dollar (TWD)',
            'symbol' => 'NT$',
            'html'   => 'NT&#36;'
        ),
        'TZS' => array(
            'name'   => 'Tanzanian Shilling (TZS)',
            'symbol' => 'x',
            'html'   => 'x'
        ),
        'UAH' => array(
            'name'   => 'Ukraine Hryvnia',
            'symbol' => '₴',
            'html'   => '&#8372;'
        ),
        'UGX' => array(
            'name'   => 'Ugandan Shilling',
            'symbol' => 'USh',
            'html'   => 'Ush'
        ),
        'USD' => array(
            'name'   => 'United States Dollar',
            'symbol' => '$',
            'html'   => '&#36;'
        ),
        'UYU' => array(
            'name'   => 'Uruguayan New Peso',
            'symbol' => '$U',
            'html'   => '&#36;U'
        ),
        'UZS' => array(
            'name'   => 'Uzbekistan Som',
        ),
        'VEF' => array(
            'name'   => 'Venezuelan Bolivar Fuerte',
            'symbol' => 'Bs',
            'html'   => 'Bs'
        ),
        'VND' => array(
            'name'   => 'Vietnam Dong',
            'symbol' => '₫',
            'html'   => '&#8363;'
        ),
        'VUV' => array(
            'name'   => 'Vanuatu Vatu',
            'symbol' => 'Vt',
            'html'   => 'Vt'
        ),
        'WST' => array(
            'name'   => 'Samoa Tala (WST)',
            'symbol' => 'WS$',
            'html'   => 'WS&#36;'
        ),
        'XAF' => array(
            'name'   => 'CFA Franc BEAC',
            'symbol' => 'CFA',
            'html'   => 'CFA'
        ),
        'XCD' => array(
            'name'   => 'East Caribbean Dollar',
            'symbol' => 'EC$',
            'html'   => 'EC&#36;'
        ),
        'XDR' => array(
            'name'   => 'Special Drawing Rights',
        ),
        'XOR' => array(
            'name'   => 'CFA Franc BCEAO',
            'symbol' => 'FCFA',
            'html'   => 'FCFA'
        ),
        'XPF' => array(
            'name'   => 'Pacific Franc',
            'symbol' => 'F',
            'html'   => 'F'
        ),
        'YER' => array(
            'name'   => 'Yemen Riyal',
        ),
        'ZAR' => array(
            'name'   => 'South African Rand',
            'symbol' => 'R',
            'html'   => 'R'
        ),
        'ZMK' => array(
            'name'   => 'Zambian Kwacha',
            'symbol' => 'ZK',
            'html'   => 'ZK'
        ),
        'ZWD' => array(
            'name'   => 'Zimbabwe Dollar',
            'symbol' => 'Z$',
            'html'   => 'Z&#36;'
        ),
    );

    /**
     * Country currency map.
     * 
     * @var array
     * @access public
     * @since 1.0
     */
    public static $countries = array(
        'AD' => 'EUR',
        'AE' => 'AED',
        'AD' => 'AFN',
        'AG' => 'XCD',
        'AI' => 'XCD',
        'AL' => 'ALL',
        'AM' => 'AMD',
        'AO' => 'AOA',
        'AQ' => '',
        'AR' => 'ARS',
        'AS' => 'USD',
        'AT' => 'EUR',
        'AU' => 'AUD',
        'AW' => 'AWG',
        'AX' => 'EUR',
        'AZ' => 'AZN',
        'BA' => 'BAM',
        'BB' => 'BBD',
        'BD' => 'BDT',
        'BE' => 'EUR',
        'BF' => 'XOF',
        'BG' => 'BGN',
        'BH' => 'BHD',
        'BI' => 'BIF',
        'BJ' => 'XOF',
        'BL' => 'EUR',
        'BM' => 'BMD',
        'BN' => 'BND',
        'BO' => 'BOB',
        'BQ' => 'USD',
        'BR' => 'BRL',
        'BS' => 'BSD',
        'BT' => 'BTN',
        'BV' => '',
        'BW' => 'BWP',
        'BY' => 'BYR',
        'BZ' => 'BZD',
        'CA' => 'CAD',
        'CC' => 'AUD',
        'CD' => 'CDF',
        'CF' => 'XAF',
        'CG' => 'XAF',
        'CH' => 'CHF',
        'CI' => 'XOF',
        'CK' => 'NZD',
        'CL' => 'CLP',
        'CM' => 'XAF',
        'CN' => 'CNY',
        'CO' => 'COP',
        'CR' => 'CRC',
        'CU' => 'CUP',
        'CV' => 'CVE',
        'CW' => 'ANG',
        'CX' => 'AUD',
        'CY' => 'EUR',
        'CZ' => 'CZK',
        'DE' => 'EUR',
        'DJ' => 'DJF',
        'DK' => 'DKK',
        'DM' => 'XCB',
        'DO' => 'DOP',
        'DZ' => 'DZD',
        'EC' => 'USD',
        'EE' => 'EUR',
        'EG' => 'EGP',
        'EH' => 'MAD',
        'ER' => 'ERN',
        'ES' => 'EUR',
        'ET' => 'ETB',
        'FI' => 'EUR',
        'FJ' => 'FJD',
        'FK' => 'FKP',
        'FM' => 'USD',
        'FO' => 'DKK',
        'FR' => 'EUR',
        'GA' => 'XAF',
        'GB' => 'GBP',
        'GD' => 'XCD',
        'GE' => 'GEL',
        'GF' => 'EUR',
        'GG' => 'GBP',
        'GH' => 'GHS',
        'GI' => 'GIP',
        'GL' => 'DKK',
        'GM' => 'GMD',
        'GN' => 'GNF',
        'GP' => 'EUR',
        'GQ' => 'XAF',
        'GR' => 'EUR',
        'GS' => 'GBP',
        'GT' => 'GTQ',
        'GU' => 'USD',
        'GW' => 'XOF',
        'GY' => 'GYD',
        'HK' => 'HKD',
        'HM' => 'AUD',
        'HN' => 'HNL',
        'HR' => 'HRK',
        'HT' => 'HTG',
        'HU' => 'HUF',
        'ID' => 'IDR',
        'IE' => 'EUR',
        'IL' => 'ILS',
        'IM' => 'GBP',
        'IN' => 'INR',
        'IO' => 'USD',
        'IQ' => 'IQD',
        'IR' => 'IRR',
        'IS' => 'ISK',
        'IT' => 'EUR',
        'JE' => 'GBP',
        'JM' => 'JMD',
        'JO' => 'JOD',
        'JP' => 'JPY',
        'KE' => 'KES',
        'KG' => 'KGS',
        'KH' => 'KHR',
        'KI' => 'AUD',
        'KM' => 'KMF',
        'KN' => 'XCD',
        'KR' => 'KPW',
        'KR' => 'KRW',
        'KW' => 'KWD',
        'KY' => 'KYD',
        'KZ' => 'KZT',
        'LA' => 'LAK',
        'LB' => 'LBP',
        'LC' => 'XCD',
        'LI' => 'CHF',
        'LK' => 'LKR',
        'LR' => 'LRD',
        'LS' => 'LSL',
        'LT' => 'LTL',
        'LU' => 'EUR',
        'LV' => 'LVL',
        'LY' => 'LYD',
        'MA' => 'MAD',
        'MC' => 'EUR',
        'MD' => 'MDL',
        'ME' => 'EUR',
        'MF' => 'EUR',
        'MG' => 'MGA',
        'MH' => 'USD',
        'MK' => 'MKD',
        'ML' => 'XOF',
        'MM' => 'MMK',
        'MN' => 'MNT',
        'MO' => 'MOP',
        'MP' => 'USD',
        'MQ' => 'EUR',
        'MR' => 'MRO',
        'MS' => 'XCD',
        'MT' => 'EUR',
        'MU' => 'MUR',
        'MV' => 'MVR',
        'MW' => 'MWK',
        'MX' => 'MXN',
        'MY' => 'MYR',
        'MZ' => 'MZN',
        'NA' => 'NAD',
        'NC' => 'XPF',
        'NE' => 'XOF',
        'NF' => 'AUD',
        'NG' => 'NGN',
        'NI' => 'NIO',
        'NL' => 'EUR',
        'NO' => 'NOK',
        'NP' => 'NPR',
        'NR' => 'AUD',
        'NU' => 'NZD',
        'NZ' => 'NZD',
        'OM' => 'OMR',
        'PA' => 'PAB',
        'PE' => 'PEN',
        'PF' => 'XPF',
        'PG' => 'PGK',
        'PH' => 'PHP',
        'PK' => 'PKR',
        'PL' => 'PLN',
        'PM' => 'EUR',
        'PN' => 'NZD',
        'PR' => 'USD',
        'PS' => 'JOD',
        'PT' => 'EUR',
        'PW' => 'USD',
        'PY' => 'PYG',
        'QA' => 'QAR',
        'RE' => 'EUR',
        'RO' => 'RON',
        'RS' => 'RSD',
        'RU' => 'RUB',
        'RW' => 'RWF',
        'SA' => 'SAR',
        'SB' => 'SBD',
        'SC' => 'SCR',
        'SD' => 'SDG',
        'SE' => 'SEK',
        'SG' => 'SGD',
        'SH' => 'SHP',
        'SI' => 'EUR',
        'SJ' => '',
        'SK' => 'EUR',
        'SL' => 'SLL',
        'SM' => 'EUR',
        'SN' => 'XOF',
        'SO' => 'SOS',
        'SR' => 'SRD',
        'SS' => 'SSP',
        'ST' => 'STD',
        'SV' => 'USD',
        'SX' => 'ANG',
        'SY' => 'SYP',
        'SZ' => 'SZL',
        'TC' => 'USD',
        'TD' => 'XAF',
        'TF' => 'EUR',
        'TG' => 'XOF',
        'TH' => 'THB',
        'TJ' => 'TJS',
        'TK' => 'NZD',
        'TL' => 'USD',
        'TM' => 'TMT',
        'TN' => 'TND',
        'TO' => 'TOP',
        'TR' => 'TRY',
        'TT' => 'TTD',
        'TV' => 'AUD',
        'TW' => 'TWD',
        'TZ' => 'TZS',
        'UA' => 'UAH',
        'UG' => 'UGX',
        'UM' => 'USD',
        'US' => 'USD',
        'UY' => 'UYU',
        'UZ' => 'UZS',
        'VA' => 'EUR',
        'VC' => 'XCD',
        'VE' => 'VEF',
        'VG' => 'USD',
        'VI' => 'USD',
        'VN' => 'VND',
        'VU' => 'VUV',
        'WF' => 'XPF',
        'WS' => 'WST',
        'YE' => 'YER',
        'YT' => 'EUR',
        'ZA' => 'ZAR',
        'ZM' => 'ZMK',
        'ZW' => 'ZWD',
    );

    /**
     * Get the currency symbol.
     *
     * @param string $code Currency code.
     * @return string|bool
     * @since 1.0
     */
    public static function symbol( $code )
    {
        if ( array_key_exists( $code, self::$currency ) && array_key_exists( 'symbol', self::$currency[ $code ] ) ) {
            return self::$currency[ $code ]['symbol'];
        }
        return false;
    }

    /**
     * Get html formatted of the currency symbol.
     *
     * @param string $code Currency code.
     * @return string|bool
     * @since 1.0
     */
    public static function html( $code )
    {
        if ( array_key_exists( $code, self::$currency ) && array_key_exists( 'html', self::$currency[ $code ] ) ) {
            return self::$currency[ $code ]['html'];
        }
        return false;
    }
    
    public static function currency( $country )
    {
        if ( array_key_exists( $country, self::$countries ) ) {
            return self::$countries[ $country ];
        }
        return false;
    }
}
