<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.03.2017
 * Time: 18:33
 */

namespace Core\Model;


use Core\Exception\LedgerException;

interface FileErrorInterface extends ModelInterface {

    /**
     * @param LedgerException $e
     * @param FileInterface $file
     * @param null|int $row
     * @param null|int $column
     * @return FileErrorInterface
     */
    public function setException(LedgerException $e, FileInterface $file, $row = null, $column = null);

    /**
     * @return string
     */
    public function getDescription();
} 