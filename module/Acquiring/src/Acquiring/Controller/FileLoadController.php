<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 26.05.2016
 * Time: 16:32
 */

namespace Acquiring\Controller;


use Acquiring\Model\Acquiring;
use Core\Model\Book;
use Zend\Mvc\Controller\AbstractActionController;

class FileLoadController extends AbstractActionController {

    public function loadFilesAction() {

        $book = new Book($this->serviceLocator);
        $acquiring = new Acquiring($book);

        $book->loadFiles();
    }
}