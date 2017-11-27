<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2017
 * Time: 19:24
 */

namespace Core\Data;


interface ModelDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getModelId();

    /**
     * @return string
     */
    public function getModelName();

    /**
     * @return int
     */
    public function getNamespaceId();

    /**
     * @param int $id
     * @return ModelDataInterface
     */
    public function setModelId($id);

    /**
     * @param string $name
     * @return ModelDataInterface
     */
    public function setModelName($name);
    /**
     * @param int $id
     * @return ModelDataInterface
     */
    public function setNamespaceId($id);

} 