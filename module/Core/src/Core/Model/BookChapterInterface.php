<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.06.2016
 * Time: 17:27
 */

namespace Core\Model;


interface BookChapterInterface extends EntryInterface {

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return BookChapterInterface
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDataPath();

    /**
     * @param string $fileFullName
     * @return BookChapterInterface
     */
    public function loadFile($fileFullName);

    /**
     * @param FileInterface $file
     * @return BookChapterInterface
     */
    public function checkFile(FileInterface $file);

    /**
     * @param FileInterface $file
     * @return BookChapterInterface
     */
    public function executeFile(FileInterface $file);

    /**
     * @return BookChapterInterface
     */
    public function loadFiles();

    /**
     * @param int $fileStates
     * @return BookChapterInterface
     */
    public function checkFiles($fileStates = File::STATE_NEW);

    /**
     * @return BookChapterInterface
     */
    public function executeFiles();
}