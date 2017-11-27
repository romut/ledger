<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.05.2016
 * Time: 18:01
 */

namespace Core\Factory;


use Core\Model\Book;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BookFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new Book(
            $serviceLocator,
            $serviceLocator->get('Core\Storage\BookStorageInterface')
        );
    }
}