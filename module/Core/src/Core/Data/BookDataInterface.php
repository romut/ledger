<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 31.05.2016
 * Time: 18:02
 */

namespace Core\Data;


interface BookDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getBookId();

    /**
     * @return string
     */
    public function getDataPath();

    /**
     * @param int $id
     * @return BookDataInterface
     */
    public function setBookId($id);

    /**
     * @param string $path
     * @return BookDataInterface
     */
    public function setDataPath($path);
} 