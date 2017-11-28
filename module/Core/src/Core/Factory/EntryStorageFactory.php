<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.07.2016
 * Time: 17:50
 */

namespace Core\Factory;

use Core\Storage\EntryStorage;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntryStorageFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new EntryStorage(
            
            $serviceLocator->get('Zend\Db\Adapter\Adapter')
        );
    }
}