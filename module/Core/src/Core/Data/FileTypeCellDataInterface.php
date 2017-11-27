<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 17:42
 */

namespace Core\Data;


interface FileTypeCellDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFileTypeId();

    /**
     * @return int
     */
    public function getCellNo();

    /**
     * @return int
     */
    public function getCellTypeId();

    /**
     * @param int $id
     * @return FileTypeCellDataInterface
     */
    public function setFileTypeId($id);

    /**
     * @param int $no
     * @return FileTypeCellDataInterface
     */
    public function setCellNo($no);

    /**
     * @param int $id
     * @return FileTypeCellDataInterface
     */
    public function setCellTypeId($id);
}