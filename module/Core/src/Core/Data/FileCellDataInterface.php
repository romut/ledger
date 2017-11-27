<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.06.2016
 * Time: 10:28
 */

namespace Core\Data;


interface FileCellDataInterface extends DataInterface {

    public function getFileId();
    public function getRow();
    public function getColumn();
    public function getValueExt();
    public function getValue();

    public function setFileId($id);
    public function setRow($row);
    public function setColumn($column);
    public function setValueExt($valueExt);
    public function setValue($value);
} 