<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 18:28
 */

namespace Core\Model;


interface FileTypeInterface extends ModelInterface, \ArrayAccess {

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getFileNamePattern();

    /**
     * @param string $name
     * @return FileTypeInterface
     */
    public function setName($name);

    /**
     * @param string $pattern
     * @return FileTypeInterface
     */
    public function setFileNamePattern($pattern);

    /**
     * @param FileCellInterface $cell
     * @return FileTypeInterface
     */
    public function validate(FileCellInterface $cell);
} 