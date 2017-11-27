<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 07.06.2016
 * Time: 17:57
 */

namespace Core\Model;

use Core\Data\EntryData;
use Core\Data\FileData;
use Core\Data\FileDataInterface;
use Core\Exception\ParentKeyIsModified;

class File extends Entry implements FileInterface {

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'files' => array(
            'alias' => 'f',
            'keys' => array('file_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'file_id'
            ),
        ),
    );

    static public function createDataArray() { return array(new EntryData(), new FileData()); }

    const STATE_NEW = 0, STATE_EXECUTED = 1, STATE_CHECKED = 2, STATE_INVALID = 4;
    const STATE_WARNING = 5, STATE_DROPPED = 6;

    private $currentLine = 0;

    /**
     * @var FileTypeInterface $fileType
     */
    private $fileType;

    /**
     * @var ClientInterface $client
     */
    private $client;

    /**
     * @var FileMapInterface $fileMap
     */
    private $fileMap;

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|FileDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|FileDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return FileRowInterface
     */
    public function current()
    {
        /**
         * @var FileCellInterface[] $fileCells
         */
        $fileCells = $this->getStorage()->select(
            'Core\Model\FileCell',
            array(
                'file_id' => $this->getId(),
                'row' => $this->currentLine
            ),
            'column ASC'
        );

        if (is_null($fileCells)) {

            $fileRow = new FileRow($this);
            $fileRow->setRowNo($this->currentLine);
        }
        else {

            $fileRow = new FileRow($this, $fileCells);
        }

        return $fileRow;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->currentLine;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return int
     */
    public function key()
    {
        return $this->currentLine;
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
        return $this->currentLine <= $this->getMaxRow();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->currentLine = 0;
    }

    /**
     * @return FileTypeInterface
     */
    public function getFileType()
    {
        if (is_null($this->fileType) && !is_null($this->getData(1)->getFileTypeId())) {

            $this->fileType = $this->getStorage()->select(
                'Core\Model\FileType',
                array('file_type_id' => $this->getData(1)->getFileTypeId())
            );
        }

        return $this->fileType;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        if (is_null($this->client) && !is_null($this->getData(1)->getClientId())) {

            $this->client = $this->getStorage()->select(
                'Core\Model\Client',
                array('client_id' => $this->getData(1)->getClientId())
            );
        }

        return $this->client;
    }

    /**
     * @return FileMapInterface
     */
    public function getFileMap()
    {
        if (is_null($this->fileMap) && !is_null($this->getData(1)->getFileTypeId())) {

            $this->fileMap = $this->getStorage()->select(
                'Core\Model\FileMap',
                array('file_map_id' => $this->getData(1)->getFileMapId())
            );
        }

        return $this->fileMap;
    }

    public function getName() { return $this->getData(1)->getFileName(); }

    public function getDescription()
    {
        return array(
            'file_id' => $this->getId(),
            'type' => $this->getFileType(),
            'name' => $this->getName(),
            'size' => $this->getSize(),
            'created' => $this->getCreateDate(),
            'modified' => $this->getModifyDate(),
            'loaded' => $this->getLoadDate(),
            'max_row' => $this->getMaxRow()
        );
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->getData(1)->getFileState();
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->getData(1)->getFileSize();
    }

    /**
     * @return string
     */
    public function getCreateDate()
    {
        return $this->getData(1)->getFileCreateDate();
    }

    /**
     * @return string
     */
    public function getModifyDate()
    {
        return $this->getData(1)->getFileModifyDate();
    }

    /**
     * @return string
     */
    public function getLoadDate()
    {
        return $this->getData(1)->getFileLoadDate();
    }

    /**
     * @return int
     */
    public function getMaxRow()
    {
        return $this->getData(1)->getMaxRow();
    }

    /**
     * @return int
     */
    public function getErrorCount()
    {
        return $this->getData(1)->getErrorCount();
    }

    public function setBookChapter(BookChapterInterface $chapter)
    {
        $this->setData(1)->setBookChapterId($chapter->getId());
        return $this;
    }

    /**
     * @param FileTypeInterface $fileType
     * @return FileInterface
     */
    public function setFileType(FileTypeInterface $fileType = null)
    {
        $this->fileType = $fileType;
        $this->setData(1)->setFileTypeId(is_null($fileType) ? null : $fileType->getId());

        return $this;
    }

    /**
     * @param ClientInterface $client
     * @return FileInterface
     */
    public function setClient(ClientInterface $client = null)
    {
        $this->client = $client;
        $this->setData(1)->setClientId($client->getId());

        return $this;
    }

    /**
     * @param FileMapInterface $fileMap
     * @return FileInterface
     */
    public function setFileMap(FileMapInterface $fileMap = null)
    {
        $this->fileMap = $fileMap;
        $this->setData(1)->setFileMapId(is_null($fileMap) ? null : $fileMap->getId());

        return $this;
    }

    /**
     * @param int $state
     * @return FileInterface
     */
    public function setState($state)
    {
        $this->setData(1)->setFileState($state);
        return $this;
    }

    /**
     * @param string $name
     * @return $this|FileInterface
     */
    public function setName($name)
    {
        $this->setData(1)->setFileName($name);
        return $this;
    }

    /**
     * @param int $size
     * @return FileInterface
     */
    public function setSize($size)
    {
        $this->setData(1)->setFileSize($size);
        return $this;
    }

    /**
     * @param string $date
     * @return FileInterface
     */
    public function setCreateDate($date)
    {
        $this->setData(1)->setFileCreateDate($date);
        return $this;
    }

    /**
     * @param string $date
     * @return FileInterface
     */
    public function setModifyDate($date)
    {
        $this->setData(1)->setFileModifyDate($date);
        return $this;
    }

    /**
     * @param string $date
     * @return FileInterface
     */
    public function setLoadDate($date)
    {
        $this->setData(1)->setFileLoadDate($date);
        return $this;
    }

    /**
     * @param FileRowInterface $row
     * @return $this|FileInterface
     * @throws ParentKeyIsModified
     * @throws \Core\Exception\NoPermissionException
     */
    public function addRow(FileRowInterface $row)
    {
        if ($this->isModified()) throw new ParentKeyIsModified();

        $rowNo = $row->getRowNo();
        //print 'addRow [#' . (is_null($rowNo) ? 'null' : $rowNo) . ', cells: ' . count($row) . ']: ';

        if (is_null($rowNo)) {

            $rowNo = $this->getData(1)->getMaxRow() + 1;
            $this->getData(1)->setMaxRow($rowNo);
            $this->save();
        }
        else {

            /**
             * @var FileCellInterface[] $cells
             */
            $cells = $this->getStorage()->select(
                'Core\Model\FileCell',
                array(
                    'file_id' => $this->getId(),
                    'row' => $rowNo
                )
            );

            if (is_null($cells)) {

                $maxRow = $this->getData(1)->getMaxRow();
                if (is_null($maxRow) || $maxRow < $rowNo) {

                    $this->setData(1)->setMaxRow($rowNo);
                    $this->save();
                }
            }
            else {

                $this->deleteRow(new FileRow($this, $cells));
            }
        }

        $row->rewind();
        /**
         * @var FileCellInterface $cell
         */
        foreach ($row as $cell) {

            $cell->setRow($rowNo);
            $cell->setFileId($this->getId());
            $this->getStorage()->save($cell);

            //print '(' . $cell->getRow() . ',' . $cell->getColumn() . ') ' . self::toConsole($cell->getValue()) . '; ';
        }

        //print "\n";

        $this->currentLine = $rowNo;

        return $this;
    }

    /**
     * @param FileRowInterface $row
     * @return $this|FileInterface
     * @throws ParentKeyIsModified
     */
    public function deleteRow(FileRowInterface $row)
    {
        if ($this->isModified()) throw new ParentKeyIsModified();

        if (is_null($row->getRowNo())) return $this;

        if ($row->getRowNo() == $this->getMaxRow()) {

            $this->setData(1)->setMaxRow($this->getMaxRow() - 1);
            $this->getStorage()->save($this);
        }

        foreach ($row as $cell) {

            $this->getStorage()->removeModel($cell);
        }

        return $this;
    }
}