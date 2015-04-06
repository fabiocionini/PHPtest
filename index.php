<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 06/04/15
 * Time: 16:17
 */

header("Content-Type: text/plain; charset=UTF-8");

require_once('SplClassLoader.php');
$loader = new SplClassLoader('Example', '.');
$loader->register();

use Example\Models\Address;

$address = new Address();
$address->name = 'nome';
$address->phone = '8765786587';
$address->address = 'addr';

$address->save();

print_r($address);

print_r($address::find(1));

print_r($address::findAll());