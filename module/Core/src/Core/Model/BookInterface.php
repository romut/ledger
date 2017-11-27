<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:31
 */

namespace Core\Model;

interface BookInterface extends EntryInterface {

    /**
     * @return string
     */
    public function getDataPath();

    /**
     * @param string $path
     * @return BookInterface
     */
    public function setDataPath($path);

    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @param UserInterface $user
     * @return BookInterface
     */
    public function open(UserInterface $user);

    /**
     * @return BookInterface
     */
    public function loadFiles();

    /**
     * @return BookInterface
     */
    public function checkFiles();

    /**
     * @return BookInterface
     */
    public function executeFiles();

    /**
     * @param string $name
     * @param BookChapterInterface $chapter
     * @return BookInterface
     */
    public function addChapter(BookChapterInterface $chapter);
}