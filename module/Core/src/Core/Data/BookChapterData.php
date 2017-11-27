<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.06.2016
 * Time: 17:46
 */

namespace Core\Data;

class BookChapterData extends Data implements BookChapterDataInterface {

    private $bookChapterId;
    private $name;

    /**
     * @return int
     */
    public function getBookChapterId()
    {
        return $this->bookChapterId;
    }

    /**
     * @return string
     */
    public function getBookChapterName()
    {
        return $this->name;
    }

    /**
     * @param int $id
     * @return BookChapterDataInterface
     */
    public function setBookChapterId($id)
    {
        $this->set($this->bookChapterId, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return BookChapterDataInterface
     */
    public function setBookChapterName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }
}