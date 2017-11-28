<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.06.2016
 * Time: 17:45
 */

namespace Core\Data;


interface BookChapterDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getBookChapterId();

    /**
     * @return string
     */
    public function getBookChapterName();

    /**
     * @param int $id
     * @return BookChapterDataInterface
     */
    public function setBookChapterId($id);

    /**
     * @param string $name
     * @return BookChapterDataInterface
     */
    public function setBookChapterName($name);
} 