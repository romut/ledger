<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.03.2017
 * Time: 18:38
 */

namespace Core\Model;

use Core\Data\FileErrorData;
use Core\Data\FileErrorDataInterface;
use Core\Exception\LedgerException;

class FileError extends Model implements FileErrorInterface {

    static public $tableDescriptor = array(
        'file_errors' => array(
            'alias' => 'fe',
            'keys' => array('file_error_id'),
        ),
    );

    static public function createDataArray()
    {
        return array(new FileErrorData());
    }

    /**
     * @var LedgerException $e
     */
    private $e;

    /**
     * @param int $part
     * @return FileErrorDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param LedgerException $e
     * @param FileInterface $file
     * @param null|int $row
     * @param null|int $column
     * @return FileErrorInterface
     */
    public function setException(LedgerException $e, FileInterface $file, $row = null, $column = null)
    {
        $this->e = $e;

        $this->getData()
            ->setFileId($file->getId())
            ->setFileRow($row)
            ->setFileColumn($column)
            ->setErrorDescription($e->getMessage())
        ;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getData()->getErrorDescription();
    }
}