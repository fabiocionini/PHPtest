<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 05/04/15
 * Time: 15:20
 */

// Set default timezone
date_default_timezone_set('UTC');

try {
    // Create (connect to) SQLite database in file
    $sqlite_db = new PDO('sqlite:/tmp/PHPTest.sqlite3');

    // Set error mode to exceptions
    $sqlite_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table addresses
    $sqlite_db->exec("CREATE TABLE IF NOT EXISTS address (
                id INTEGER PRIMARY KEY,
                name TEXT,
                phone TEXT,
                address TEXT)");

    $sqlite_db->exec("DELETE FROM address");
    $sqlite_db->exec("VACUUM");

    // Set initial data
    $addresses = array(
        array('name' => 'Michal', 'phone' => '506088156', 'address' => 'Michalowskiego 41'),
        array('name' => 'Marcin', 'phone' => '502145785', 'address' => 'Opata Rybickiego 1'),
        array('name' => 'Piotr',  'phone' => '504212369', 'address' => 'Horacego 23'),
        array('name' => 'Albert', 'phone' => '605458547', 'address' => 'Jan Pawła 67')
    );

    // Prepare INSERT statement to SQLite3 file db
    $insert = "INSERT INTO address (name, phone, address) VALUES (:name, :phone, :address)";
    $stmt = $sqlite_db->prepare($insert);

    // Bind parameters to statement variables
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);

    // execute prepared insert statement with every address
    foreach ($addresses as $a) {
        // Set values to bound variables
        $name = $a['name'];
        $phone = $a['phone'];
        $address = $a['address'];

        // Execute statement
        $stmt->execute();
    }

    echo "Database setup complete, ".count($addresses)." records created.";
}
catch(PDOException $e) {
    echo $e->getMessage();
}

