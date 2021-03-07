<?php

return [
    'date' => [
        /**
         * Carbon date format
         */
        'format'         => 'd/m/Y',
        /**
         * Due date for payment since invoice's date.
         */
        'pay_until_days' => 30,
    ],

    'serial_number' => [
        'series'           => date('Y'),
        'sequence'         => 1,
        /**
         * Sequence will be padded accordingly, for ex. 00001
         */
        'sequence_padding' => 5,
        'delimiter'        => '/',
        /**
         * Supported tags {SERIES}, {DELIMITER}, {SEQUENCE}
         * Example: AA.00001
         */
        'format'           => '{SEQUENCE}{DELIMITER}{SERIES}',
    ],

    'currency' => [
        'code'                => 'dirhams',
        /**
         * Usually cents
         * Used when spelling out the amount and if your currency has decimals.
         *
         * Example: Amount in words: Eight hundred fifty thousand sixty-eight EUR and fifteen ct.
         */
        'fraction'            => 'cts.',
        'symbol'              => 'DH',
        /**
         * Example: 19.00
         */
        'decimals'            => 2,
        /**
         * Example: 1.99
         */
        'decimal_point'       => '.',
        /**
         * By default empty.
         * Example: 1,999.00
         */
        'thousands_separator' => ' ',
        /**
         * Supported tags {VALUE}, {SYMBOL}, {CODE}
         * Example: 1.99 €
         */
        'format'              => '{VALUE} {SYMBOL}',
    ],

    'paper' => [
        // A4 = 210 mm x 297 mm = 595 pt x 842 pt
        'size'        => 'a4',
        'orientation' => 'portrait',
    ],

    'disk' => 'local',

    'seller' => [
        /**
         * Class used in templates via $invoice->seller
         *
         * Must implement LaravelDaily\Invoices\Contracts\PartyContract
         *      or extend LaravelDaily\Invoices\Classes\Party
         */
        'class' => \LaravelDaily\Invoices\Classes\Seller::class,

        /**
         * Default attributes for Seller::class
         */
        'attributes' => [
            'name'          => 'Maître Zahra ZAOUI',
            'address'       => '25 Bd Mohhamed V 60000 - OUJDA',
            'phone'         => '(212) 536-70-18-28',
            'code'          => '001649562000055',
            'vat'           => '10100470',
            'custom_fields' => [
                /**
                 * Custom attributes for Seller::class
                 *
                 * Used to display additional info on Seller section in invoice
                 * attribute => value
                 */

                'CNSS' => '2067181',
                'Patente' => '10100178',
            ],
        ],
    ],
];
