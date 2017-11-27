<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.06.2016
 * Time: 17:40
 */

namespace Core\Model;

use Core\Data\BookChapterData;
use Core\Data\BookChapterDataInterface;
use Core\Data\EntryData;
use Core\Data\EntryDataInterface;
use Core\Exception\LedgerException;
use Core\Exception\UnknownClientException;
use Core\Exception\UnknownFileTypeException;
use Core\Storage\ModelStorage;

class BookChapter extends Entry implements BookChapterInterface {

    const INPUT_DIR = 'input', OUTPUT_DIR = 'output', TEMPLATE_DIR = 'templates';
    const ARCHIVE_DIR = 'archive', IMPORT_DIR = 'import', EXPORT_DIR = 'export';

    const FILE_PREFIX_LENGTH = 12;

    static public $tableDescriptor =  array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'book_chapters' => array(
            'alias' => 'bc',
            'keys' => array('book_chapter_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'book_chapter_id'
            ),
        ),
    );


    static public function createDataArray()
    {
        return array(new EntryData(), new BookChapterData());
    }

    /**
     * @var FileTypeInterface[] $fileTypes
     */
    private $fileTypes = array();

    static public function getFileName($fullName, $delimiter = '/')
    {
        $nameParts = mb_split($delimiter, $fullName);
        return self::fromOS($nameParts[count($nameParts) - 1]);
    }

    private function getFileFullName(FileInterface $file)
    {
        return
            $this->getDataPath() . '/' . self::ARCHIVE_DIR . '/' .
            \DateTime::createFromFormat(self::DB_DATETIME_FORMAT, $file->getLoadDate())
                ->format(self::DB_DATE_FORMAT) . '/' .
            str_pad($file->getId(), self::FILE_PREFIX_LENGTH, '0', STR_PAD_LEFT) . '-' . $file->getName()
            ;
    }

    private function createFile($fileFullName)
    {
        $fileName = self::getFileName($fileFullName);

        /**
         * @var FileInterface $file
         */
        $file = $this->getStorage()->createModel('Core\Model\File');
        $file
            ->setBookChapter($this)
            ->setState(File::STATE_NEW)
            ->setName($fileName)
            ->setSize(filesize($fileFullName))
            ->setCreateDate(date(self::DB_DATETIME_FORMAT, filectime($fileFullName)))
            ->setModifyDate(date(self::DB_DATETIME_FORMAT, filemtime($fileFullName)))
            ->setLoadDate(date(self::DB_DATETIME_FORMAT))
        ;

        try {

            $fileType = $this->getFileType($fileName);
            $client = $this->getClient($fileName);

            $file
                ->setFileType($fileType)
                ->setClient($client)
                ->setFileMap($this->getFileMap($client, $fileType))
            ;

            $file->save();
        }
        catch (LedgerException $e) {

            $file->setState(File::STATE_INVALID);
            $file->save();

            /**
             * @var FileErrorInterface $fileError
             */
            $fileError = $this->getStorage()->createModel('Core\Model\FileError');
            $fileError->setException($e, $file);
            $fileError->save();
        }

        $this->moveToArchive($file);

        return $file;
    }

    private function loadExcelFile(FileInterface $file)
    {
        print 'Reading Excel-file: ' . self::toConsole($this->getFileFullName($file)) . "\n";

        try {

            $excel = \PHPExcel_IOFactory::load(self::toOS($this->getFileFullName($file)));
            $worksheet = $excel->getActiveSheet();
            $maxRow = $worksheet->getHighestRow();

            for ($i = 1; $i <= $maxRow; ++$i) {

                $maxColumn = \PHPExcel_Cell::columnIndexFromString($worksheet->getHighestColumn($i));
                if (0 == $maxColumn) continue;

                //print 'ROW '  . ($i - 1) . ' [' . $maxColumn . ']: ';
                $row = new FileRow($file);

                for ($j = 0; $j < $maxColumn; ++$j) {

                    $excelCell = $worksheet->getCellByColumnAndRow($j, $i);
                    if (mb_strlen($excelCell->getFormattedValue()) == 0) continue;

                    /**
                     * @var FileCellInterface $cell
                     */
                    $cell = $this->getStorage()->createModel('Core\Model\FileCell');
                    $cell
                        ->setRow($i - 1)
                        ->setColumn($j)
                        ->setValue($excelCell->getFormattedValue())
                    ;
                    $row->addCell($cell);

                    //print '[(' . $cell->getIndex() . ')' . $cell->getRow() . ',' . $cell->getColumn() . ']' .
                    //    $this->toConsole($excelCell->getFormattedValue()) . '; ';
                }

                if (0 < count($row)) {

                    //$file->getFileType()->validate($row);
                    $file->addRow($row);
                }
            }
        }
        catch (LedgerException $e) {

            print 'ERROR: ' . $e->getMessage() . "\n";
        }

    }

    private function moveToArchive(FileInterface $file)
    {
        $path = self::toOS($this->getDataPath());
        $archiveDirName = $path . '/' . self::toOS(self::ARCHIVE_DIR);
        $date = self::toOS(
            \DateTime::createFromFormat(self::DB_DATETIME_FORMAT, $file->getLoadDate())->format(self::DB_DATE_FORMAT)
        );
        $fileFullName = $path . '/' . self::toOS(self::INPUT_DIR . '/' . $file->getName());

        if (!file_exists($archiveDirName)) mkdir($archiveDirName);
        if (!file_exists($archiveDirName . '/' . $date)) mkdir($archiveDirName . '/' . $date);

        copy(
            $fileFullName,
            self::toOS($this->getFileFullName($file))
        );

        unlink($fileFullName);
    }

    /**
     * @param int $part
     * @return EntryDataInterface|BookChapterDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return EntryDataInterface|BookChapterDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    /**
     * @param string $fileName
     * @throws UnknownFileTypeException
     * @throws \Core\Exception\NoPermissionException
     * @return FileTypeInterface
     */
    protected function getFileType($fileName)
    {
        $resultFileType = null;

        if (count($this->fileTypes) == 0) {

            $fileTypes = $this->getStorage()->select(
                'Core\Model\FileType',
                array('book_chapter_id' => $this->getId())
            );
            $this->fileTypes = is_array($fileTypes) ? $fileTypes : (is_null($fileTypes) ? null : array($fileTypes));
        }

        if (is_null($this->fileTypes)) throw new UnknownFileTypeException($fileName);

        foreach ($this->fileTypes as $fileType) {

            if (mb_ereg_match($fileType->getFileNamePattern(), $fileName)) {

                $resultFileType = $fileType;
                break;
            }
        }

        if (is_null($resultFileType)) throw new UnknownFileTypeException($fileName);

        return $resultFileType;
    }

    /**
     * @param string $fileName
     * @throws UnknownClientException
     * @return ClientInterface
     */
    protected function getClient($fileName)
    {
        $company = null;
        $foundCodes = array();

        if (mb_ereg('\.(\d+)\.', $fileName, $foundCodes)) {

            $company = $this->getStorage()->select('Core\Model\Company', array('company_code' => $foundCodes[1]));
        }

        if (count($foundCodes) == 0) {

            $company = $this->getStorage()->select('Core\Model\Company', array('company_code' => '0001'));
        }

        if (is_null($company)) throw new UnknownClientException('code = ' . $foundCodes[1]);

        return $company;
    }

    /**
     * @param ClientInterface $client
     * @param FileTypeInterface $fileType
     * @return FileMapInterface
     */
    protected function getFileMap(ClientInterface $client, FileTypeInterface $fileType)
    {
        /**
         * @var ClientFileMapInterface $clientFileMap
         */
        $clientFileMap = $this->getStorage()->select(
            'Core\Model\ClientFileMap',
            array('client_id' => $client->getId(), 'file_type_id' => $fileType->getId())
        );

        return is_null($clientFileMap) ? null : $clientFileMap->getFileMap();
    }

    public function getName()
    {
        return $this->getData(1)->getBookChapterName();
    }

    public function setName($name)
    {
        $this->setData(1)->setBookChapterName($name);
        return $this;
    }

    public function getDataPath()
    {
        return
            $this->getBook()->getDataPath() . '/' .
            mb_ereg_replace('chapter', '', basename(ModelStorage::getModelName($this)), 'i');
    }

    public function loadFile($fileFullName)
    {
        $file = $this->createFile($fileFullName);
        if ($file->getState() != File::STATE_NEW) return $this;

        $fileParts = mb_split('\.', $file->getName());
        $fileExt = mb_strtoupper(self::fromOS($fileParts[count($fileParts) - 1]));

        switch ($fileExt) {

            case 'XLSX':
            case 'XLS':
                $this->loadExcelFile($file);
                break;
            case 'ТЕСТ':
                print "Reading test-file\n";
                break;
            default:
                print 'Unknown file type: ' . $this->toConsole($fileExt) . "\n";
        }

        return $this;
    }

    public function checkFile(FileInterface $file)
    {
        $file->rewind();
        print 'Check file: (' . $file->getId() . ') ' . self::toConsole($file->getName()) .
            ' [rows: ' . $file->getMaxRow() . "]\n";

        /**
         * @var FileRowInterface $row
         */
        foreach ($file as $row) {

            //print 'ROW [' . $row->getRowNo() . ', cells: ' . count($row) . ']: ';

            /**
             * @var FileCellInterface $cell
             */
            foreach ($row as $cell) {

                //print '(' . $cell->getRow() . ',' . $cell->getColumn() . ') ' . self::toConsole($cell->getValue()) . ';';
            }
            //print "\n";
        }

        $file
            ->setState(File::STATE_CHECKED)
            ->save()
        ;

        return $this;
    }

    public function executeFile(FileInterface $file)
    {
        $file
            ->setState(File::STATE_EXECUTED)
            ->save()
        ;

        return $this;
    }

    public function loadFiles()
    {
        $path = self::toOS($this->getDataPath() . '/' . self::INPUT_DIR);
        $dir = dir($path);

        while ($fileName = $dir->read()) {

            $fileFullName = $path . '/' . $fileName;

            if (!is_dir($fileFullName) && !mb_ereg_match('^[.~]', $fileName)) {

                $this->loadFile($fileFullName);
            }
        }

        return $this;
    }

    public function checkFiles($fileState = File::STATE_NEW)
    {
        $files = $this->getStorage()->select(
            'Core\Model\File',
            array('f.file_state' => $fileState, 'f.book_chapter_id' => $this->getId())
        );

        if (is_null($files)) return $this;
        if (!is_array($files)) $files = array($files);

        foreach ($files as $file) {

            print 'Class: ' . get_class($this) . "\n";
            $this->checkFile($file);
        }

        return $this;
    }

    public function executeFiles()
    {
        $files = $this->getStorage()->select(
            'Core\Model\File',
            array('file_state' => File::STATE_CHECKED, 'f.book_chapter_id' => $this->getId())
        );

        if (is_null($files)) return $this;
        if (!is_array($files)) $files = array($files);

        foreach ($files as $file) $this->executeFile($file);
        return $this;
    }
}