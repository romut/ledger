<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 31.05.2016
 * Time: 18:01
 */

namespace Core\Data;


class BookData extends Data implements BookDataInterface {

    private $bookId;
    private $dataPath;

    public function getBookId()
    {
        return $this->bookId;
    }

    public function getDataPath()
    {
        return $this->dataPath;
    }

    public function setBookId($id)
    {
        $this->set($this->bookId, $id);
        return $this;
    }

    public function setDataPath($path)
    {
        $this->set($this->dataPath, $path);
        return $this;
    }
}