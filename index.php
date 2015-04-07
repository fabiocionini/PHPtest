<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 06/04/15
 * Time: 16:17
 */

use \Example\Controllers\AddressController;

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

$a = new AddressController();

$a->create(['name' => 'pippo', 'phone' => '7865876567', 'address' => 'iuwyetiu']);

$a->update(1, ['name' => 'aggiornato']);

$a->destroy(2);

$a->show(3);

$a->index();