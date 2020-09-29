<?php

/**
 * HTTP interface for the GetThumb API
 *
 * Sends the result image to the output. You can configure the arguments
 * in the getthumb.ini and/or by the GET parameters.
 *
 * @package GetThumb
 * @subpackage HTTP interface
 * @version 0.9.0
 * @author Gábor László <gopher.hu@gmail.com>
 * @license LGPL
 */

require_once dirname(__FILE__).'/GetThumbApi.php';

$gta = new GetThumbApi();
$gta->loadConfig('getthumb.ini', @$_GET['config']);
$gta->setConfig($_GET);
try {
    $ret = $gta->generateImage(@$_GET['src']);
    $gta->sendImageHeaders('jpeg', strlen($ret));
    echo $ret;
} catch (Exception $e) {
    $gta->sendErrorImage($e);
}
