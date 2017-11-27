<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 10:37
 */

namespace Core\Data;


interface ClientFileMapDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getCompanyId();

    /**
     * @return int
     */
    public function getFileTypeId();

    /**
     * @return int
     */
    public function getFileMapId();

    /**
     * @param int $id
     * @return ClientFileMapDataInterface
     */
    public function setCompanyId($id);

    /**
     * @param int $id
     * @return ClientFileMapDataInterface
     */
    public function setFileTypeId($id);

    /**
     * @param int $id
     * @return ClientFileMapDataInterface
     */
    public function setFileMapId($id);
} 