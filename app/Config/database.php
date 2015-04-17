<?php
/**
 * @author Fabio Cionini <fabio.cionini@gmail.com>
 *
 * Date: 06/04/15
 * Time: 15:50
 */


return array (
    'driver' => 'sqlite',
    'config' => [
        'sqlite' => [
            'filename' => sys_get_temp_dir().'PHPtest.sqlite3'
        ]
    ]
);
