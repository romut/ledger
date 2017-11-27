<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 18:28
 */

namespace Core\Model;


use Core\Data\FileTypeData;
use Core\Data\FileTypeDataInterface;

class FileType extends Model implements FileTypeInterface {

    static public $tableDescriptor = array(
        'file_types' => array(
            'alias' => 'ft',
            'keys' => array('file_type_id'),
            'auto_increment' => 'file_type_id',
        ),
    );

    static public function createDataArray() { return array(new FileTypeData()); }

    /**
     * @var FileTypeCell[] $fileTypeCells
     */
    private $fileTypeCells = array();

    /**
     * @param int $part
     * @return FileTypeDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return FileTypeDataInterface
     */
    protected function setData($part = 0) { return parent::getData($part); }

    public function getId() { return $this->getData()->getFileTypeId(); }

    public function getName() { return $this->getData()->getFileTypeName(); }

    public function getFileNamePattern() { return $this->getData()->getFileNamePattern(); }

    public function setName($name)
    {
        $this->setData()->setFileTypeName($name);
        return $this;
    }

    public function setFileNamePattern($pattern)
    {
        $this->getData()->setFileNamePattern($pattern);
        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    public function validate(FileCellInterface $cell)
    {
        if (is_null($this->fileTypeCells) && !is_null($this->getStorage())) {

            $this->fileTypeCells = $this->getStorage()->select(
                'FileTypeCell',
                array('file_type_id' => $this->getId(), 'cell_no' => $cell->getColumn()))
            ;

            if (is_null($this->fileTypeCells)) {

                $this->fileTypeCells = array();
            }
            elseif (!is_array($this->fileTypeCells)) {

                $this->fileTypeCells = array($this->fileTypeCells);
            }
        }


        return true;

        $result = true;
        $i = 0;
        /**
         * @var FileCellInterface $cell
         */
        foreach ($row as $cell) {

            $isValid = $this->fileTypeCells[$i]->getCellType()->validate($cell->getValue());

            if ($result) $result = $isValid;
        }

        return $result;
    }
}