<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:30
 */

namespace Core\Model;

interface EntryInterface extends ModelInterface {

    const NEW_STATE = 0, SIGNED_STATE = 1, EXECUTED_STATE = 2, DELETED_STATE = 3;
    const AUTHOR_LEVEL = 0, READER_LEVEL = 1, EDITOR_LEVEL = 2, SIGNER_LEVEL = 3, EXECUTOR_LEVEL = 4;

    /**
     * @return int
     */
    public function getId();

    /**
     * @return EntryInterface
     */
    public function getParent();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function getDescription();

    /**
     * @param EntryInterface $parent
     * @return EntryInterface
     */
    public function setParent(EntryInterface $parent);

    /**
     * @param int $level
     * @return bool
     */
    public function checkRight($level = self::READER_LEVEL);

    /**
     * @return EntryInterface
     */
    public function sign();

    /**
     * @return EntryInterface
     */
    public function unsign();

    /**
     * @return EntryInterface
     */
    public function execute();

    /**
     * @return EntryInterface
     */
    public function rollback();

    /**
     * @return bool
     */
    public function isSigned();

    /**
     * @return bool
     */
    public function isExecuted();
}