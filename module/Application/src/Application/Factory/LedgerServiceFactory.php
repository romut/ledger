<?php

namespace Application\Factory;

use Application\Service\LedgerService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LedgerServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new LedgerService(
            $serviceLocator->get('Core\Storage\EntryStorageInterface')
            );
    }
}