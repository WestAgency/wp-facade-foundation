<?php

require_once '../Klarna.php';

// Dependencies from http://phpxmlrpc.sourceforge.net/
require_once dirname(dirname(__FILE__)) .
    '/transport/xmlrpc-3.0.0.beta/lib/xmlrpc.inc';
require_once dirname(dirname(__FILE__)) .
    '/transport/xmlrpc-3.0.0.beta/lib/xmlrpc_wrappers.inc';

/**
 * 1. Initialize and setup the Klarna instance.
 */

$k = new Klarna();

$k->config(
    123456,               // Merchant ID
    'sharedSecret',       // Shared Secret
    KlarnaCountry::SE,    // Country
    KlarnaLanguage::SV,   // Language
    KlarnaCurrency::SEK,  // Currency
    Klarna::BETA,         // Server
    'json',               // PClass Storage
    '/srv/pclasses.json', // PClass Storage URI path
    true,                 // SSL
    true                  // Remote logging of response times of xmlrpc calls
);

// OR you can set the config to loads from a file, for example /srv/klarna.json:
// $k->setConfig(new KlarnaConfig('/srv/klarna.json'));

/**
 * 2. Partially refund a invoice.
 */

// Here you enter the invoice number:
$invNo = '123456';

// Specify for which article(s) you want to refund.
$k->addArtNo(
    1,          // Quantity
    'MG200MMS'  // Article Number. Must be the same as the one you used
);              // in addArticle() when you made the addTransaction() call.

try {
    $result = $k->creditPart(
        $invNo,   // Invoice Number
        ''        // Credit Number. (Optional).
    );

    echo "Result: {$result}\n";

    /* Invoice partially refunded, proceed accordingly.
       $result contains the invoice number of the refunded invoice.
     */
} catch(Exception $e) {
    // Something went wrong, print the message:
    echo "{$e->getMessage()} (#{$e->getCode()})\n";
}
