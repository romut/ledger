<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 13:20
 */

namespace Core\Model;

use Core\Data\ClientData;
use Core\Data\EntryData;
use Core\Data\PersonData;
use Core\Storage\EntryStorageInterface;

class Person extends Client implements PersonInterface {

    const CLIENT_TYPE_NAME = 'Person';

    /**
     * @var ClientTypeInterface
     */
    private $clientType;

    /**
     * @var PersonPassport[]
     */
    private $passports = array();

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'clients' => array(
            'alias' => 'c',
            'keys' => array('client_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'client_id'
            ),
        ),
        'persons' => array(
            'alias' => 'p',
            'keys' => array('person_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'person_id'
            ),
        ),
    );

    static public function createDataArray() { return array(new EntryData(), new ClientData(), new PersonData()); }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\ClientDataInterface|\Core\Data\PersonDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\ClientDataInterface|\Core\Data\PersonDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    protected function afterSave()
    {
        parent::afterSave();

        foreach ($this->passports as $passport) {

            $passport->setPersonId($this->getData(2)->getPersonId());
            $passport->save();
        }
    }

    public function __construct(EntryStorageInterface $storage, $index)
    {
        parent::__construct($storage, $index);

        $this->clientType = $this->getStorage()->getClientType(self::CLIENT_TYPE_NAME);
        $this->getData(1)->setClientTypeId($this->clientType->getId());
        $this->getData(1)->modify(false);

        //print 'Person created (typeId=' . $this->clientType->g . ").\n";
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->getData(2)->getLastName();
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->getData(2)->getFirstName();
    }

    /**
     * @return string
     */
    public function getPatronymic()
    {
        return $this->getData(2)->getPatronymic();
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->getData(2)->getSex();
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->getData(2)->getBirthday();
    }

    /**
     * @return string
     */
    public function getBirthplace()
    {
        return $this->getBirthplace();
    }

    /**
     * @param string $name
     * @return PersonInterface
     */
    public function setLastName($name)
    {
        $this->setData(2)->setLastName($name);
        return $this;
    }

    /**
     * @param string $name
     * @return PersonInterface
     */
    public function setFirstName($name)
    {
        $this->setData(2)->setFirstName($name);
        return $this;
    }

    /**
     * @param string $name
     * @return PersonInterface
     */
    public function setPatronymic($name)
    {
        $this->setData(2)->setPatronymic($name);
        return $this;
    }

    /**
     * @param string $sex
     * @return PersonInterface
     */
    public function setSex($sex)
    {
        $this->setData(2)->setSex($sex);
        return $this;
    }

    /**
     * @param string $day
     * @return PersonInterface
     */
    public function setBirthday($day)
    {
        $this->setData(2)->setBirthday(self::toDBDate($day));
        return $this;
    }

    /**
     * @param string $place
     * @return PersonInterface
     */
    public function setBirthplace($place)
    {
        $this->setData(2)->setBirthplace($place);
        return $this;
    }

    public function addPassport(PersonPassportInterface $passport)
    {
        $this->passports[] = $passport;
        return $this;
    }
}