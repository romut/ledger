<?php
return array(
    'service_manager' => array(
        'factories' => array(
            
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            
            'Core\Storage\EntryStorageInterface' => 'Core\Factory\EntryStorageFactory',
            'Core\Storage\BookStorageInterface' => 'Core\Factory\BookStorageFactory',
            'Core\Storage\FileStorageInterface' => 'Core\Factory\FileStorageFactory',
        ),
    ),
);