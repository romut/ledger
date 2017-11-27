<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Core\Storage\BookStorageInterface' => 'Core\Factory\BookStorageFactory',
            'Core\Storage\EntryStorageInterface' => 'Core\Factory\EntryStorageFactory',
            'Core\Storage\FileStorageInterface' => 'Core\Factory\FileStorageFactory',
        ),
    ),
);