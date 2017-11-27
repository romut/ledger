<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.07.2016
 * Time: 17:50
 */

namespace Core\Factory;


use Core\Model\Book;
use Core\Model\BookChapter;
use Core\Model\Company;
use Core\Model\ClientFileMap;
use Core\Model\File;
use Core\Model\FileCell;
use Core\Model\FileMap;
use Core\Model\FileMapEntry;
use Core\Model\FileType;
use Core\Model\FileTypeCell;
use Core\Model\User;
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

            $serviceLocator->get('Zend\Db\Adapter\Adapter'),
            array(

                User::MODEL_TYPE => new User(),
                Book::MODEL_TYPE => new Book(),
                BookChapter::MODEL_TYPE => new BookChapter(),
                File::MODEL_TYPE => new File(),
                FileCell::MODEL_TYPE => new FileCell(),
                FileType::MODEL_TYPE => new FileType(),
                FileTypeCell::MODEL_TYPE => new FileTypeCell(),
                FileMap::MODEL_TYPE => new FileMap(),
                FileMapEntry::MODEL_TYPE => new FileMapEntry(),
                Company::MODEL_TYPE => new Company(),
                ClientFileMap::MODEL_TYPE => new ClientFileMap(),
            )
        );
    }
}