<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 05/04/15
 * Time: 15:20
 */

use \FabioCionini\ExampleCore\Database\Database;

// autoload classes (PSR-0)
require_once('SplClassLoader.php');
$vendor_loader = new SplClassLoader('FabioCionini\\ExampleCore', 'vendor');
$vendor_loader->register();
$app_loader = new SplClassLoader('app', '.');
$app_loader->register();

try {
    // Set default timezone
    date_default_timezone_set('UTC');

    $config = include('app/Config/database.php');
    $sqlite_db = Database::connection($config);

    // Create table addresses
    $sqlite_db->exec("CREATE TABLE IF NOT EXISTS address (
                id INTEGER PRIMARY KEY,
                name TEXT,
                phone TEXT,
                street TEXT)");

    $sqlite_db->exec("DELETE FROM address");
    $sqlite_db->exec("VACUUM");

    // Set initial data

    $addresses = [];
    $file = fopen('example.csv', 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        $addresses[] = [
            'name' => $line[0],
            'phone' => $line[1],
            'street' => $line[2]
        ];
    }

    // Prepare INSERT statement to SQLite3 file db
    $insert = "INSERT INTO address (name, phone, street) VALUES (:name, :phone, :street)";
    $stmt = $sqlite_db->prepare($insert);

    // Bind parameters to statement variables
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':street', $street);

    // execute prepared insert statement with every address
    foreach ($addresses as $a) {
        // Set values to bound variables
        $name = $a['name'];
        $phone = $a['phone'];
        $street = $a['street'];

        // Execute statement
        $stmt->execute();
    }

    echo 'Database setup complete, '.count($addresses).' records created.';
}
catch(PDOException $e) {
    echo $e->getMessage();
}

