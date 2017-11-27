<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.07.2016
 * Time: 10:05
 */

namespace Core\Model;

class FileRow implements FileRowInterface {

    private $rowNo, $maxColumn = 0;

    /**
     * @var FileInterface $file
     */
    private $file;

    /**
     * @var int $currentCell
     */
    private $currentCell = 0;

    /**
     * @var FileCellInterface[] $cells
     */
    private $cells = array();

    /**
     * @var FileMapInterface $fileMap
     */
    private $fileMap;

    /**
     * @param FileInterface $file
     * @param FileCellInterface[] $cells
     */
    public function __construct(FileInterface $file, $cells = null)
    {
        $this->file = $file;

        if (!is_null($cells)) {

            foreach ($cells as $cell) {

                if (is_null($this->rowNo)) $this->rowNo = $cell->getRow();

                $this->cells[$cell->getColumn()] = $cell;
                if ($this->maxColumn < $cell->getColumn()) $this->maxColumn = $cell->getColumn();
            }
        }

        $this->fileMap = is_null($file->getFileMap()) ?
            $file->getStorage()->createModel('Core\Model\FileMap') : $file->getFileMap();
    }

    public function setFileMap(FileMapInterface $fileMap)
    {
        $this->fileMap = $fileMap;
        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return FileCellInterface
     */
    public function current()
    {
        $i = $this->fileMap[$this->currentCell];

        if (isset($this->cells[$i])) {

            $cell = $this->cells[$i];
        }
        else {

            /**
             * @var FileCellInterface $cell
             */
            $cell = $this->file->getStorage()->createModel('Core\Model\FileCell');
            $cell->setRow($this->rowNo);
            $cell->setColumn($this->currentCell);
        }

        return $cell;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->currentCell;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->currentCell;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return !is_null($this->maxColumn) && $this->currentCell <= $this->maxColumn;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->currentCell = 0;
    }

    /**
     * @param $column
     * @return FileCellInterface
     */
    public function getCell($column)
    {
        return $this->cells[$this->fileMap[$column]];
    }

    /**
     * @param FileCellInterface $cell
     * @return $this|FileRowInterface
     */
    public function addCell(FileCellInterface $cell)
    {
        if (is_null($this->rowNo)) {

            if (!is_null($cell->getRow())) $this->rowNo = $cell->getRow();
        }
        else {

            $cell->setRow($this->rowNo);
        }

        if (is_null($cell->getColumn())) {

            if (is_null($this->maxColumn)) {

                $this->maxColumn = 0;
                $cell->setColumn(0);
            }
            else {

                $cell->setColumn(++$this->maxColumn);
            }
        }
        elseif ($this->maxColumn < $cell->getColumn()) {

            $this->maxColumn = $cell->getColumn();
        }

        $this->cells[$cell->getColumn()] = $cell;

        return $this;
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return 0 == count($this->cells) ? 0 : ($this->maxColumn + 1);
    }

    public function getRowNo()
    {
        return $this->rowNo;
    }

    public function setRowNo($rowNo)
    {
        $this->rowNo = $rowNo;
        return $this;
    }

    public function isEmpty()
    {
        return is_null($this->maxColumn);
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
        return isset($this->cells[$offset]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return FileCellInterface
     */
    public function offsetGet($offset)
    {
        return isset($this->cells[$offset]) ? $this->cells[$offset] : null;
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
        if (is_null($offset)) {

            $this->cells[++$this->maxColumn] = $value;
        }
        else {

            $this->cells[$offset] = $value;
        }
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
        unset($this->cells[$offset]);
    }
}