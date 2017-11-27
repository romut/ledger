<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 14:36
 */

namespace Core\Model;


interface FileMapEntryInterface extends ModelInterface {

    /**
     * @return int
     */
    public function getInputNo();

    /**
     * @return int
     */
    public function getOutputNo();

    /**
     * @param int $no
     * @return FileMapEntryInterface
     */
    public function setInputNo($no);

    /**
     * @param int $no
     * @return FileMapEntryInterface
     */
    public function setOutputNo($no);
} 