<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:34
 */

namespace Core\Model;


use Core\Data\EntryData;
use Core\Data\EntryDataInterface;
use Core\Data\UserData;
use Core\Data\UserDataInterface;

class User extends Entry implements UserInterface {

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'users' => array(
            'alias' => 'u',
            'keys' => array('user_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'user_id'
            ),
        )
    );

    static public function createDataArray() { return array(new EntryData(), new UserData()); }

    /**
     * @param int $part
     * @return EntryDataInterface|UserDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return EntryDataInterface|UserDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    public function getLogin()
    {
        return $this->getData(1)->getLogin();
    }

    public function getPassword()
    {
        return $this->getData(1)->getPassword();
    }

    public function setLogin($login)
    {
        $this->setData(1)->setLogin($login);
        return $this;
    }

    public function setPassword($password)
    {
        $this->setData(1)->setPassword($password);
        return $this;
    }
}