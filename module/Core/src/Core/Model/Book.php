<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.02.2016
 * Time: 22:49
 */

namespace Core\Model;

use Core\Data\BookData;
use Core\Data\BookDataInterface;
use Core\Data\EntryData;
use Core\Data\EntryDataInterface;
use Core\Exception\NoPermissionException;
use Core\Exception\NotAuthenticatedException;
use Core\Exception\StorageIsNullException;
use Core\Storage\EntryStorageInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;

class Book extends Entry implements BookInterface {

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'book_id',
        ),
        'books' => array(
            'alias' => 'b',
            'keys' => array('book_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'book_id'
            ),
        ),
    );

    /**
     * @return \Core\Data\DataInterface[]
     */
    static public function createDataArray() { return array(new EntryData(), new BookData()); }

    /**
     * @var AuthAdapter $authAdapter
     */
    private $authAdapter;

    /**
     * @var UserInterface $user
     */
    private $user;

    /**
     * @var BookChapterInterface[] $bookChapters
     */
    protected $bookChapters = array();

    /**
     * @param int $part
     * @return EntryDataInterface|BookDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return EntryDataInterface|BookDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    /**
     * @param EntryStorageInterface $storage
     * @param int $index
     */
    public function __construct(EntryStorageInterface $storage, $index)
    {
        parent::__construct($storage, $index);
        //print "Book constructor\n";

        mb_internal_encoding(self::DEFAULT_ENCODING);
        mb_regex_encoding(self::DEFAULT_ENCODING);
    }

    /**
     * @return $this
     */
    protected function getBook() { return $this; }

    /**
     * @return UserInterface
     */
    public function getUser() { return $this->user; }

    /**
     * @return null|string
     */
    public function getDataPath()
    {
        return is_null($this->getData(1)) ? null : $this->getData(1)->getDataPath();
    }

    /**
     * @param string $path
     * @return $this|BookInterface
     */
    public function setDataPath($path)
    {
        if (is_null($this->getData(1))) return $this;

        $this->getData(1)->setDataPath($path);
        return $this;
    }

    public function debug()
    {
        printf("ClassName: " . basename(__CLASS__) . "\n");
        printf("FunctionName: " . __FUNCTION__ . "\n");
    }

    /**
     * @param UserInterface $user
     * @throws NoPermissionException
     * @throws NotAuthenticatedException
     * @throws StorageIsNullException
     * @return $this
     */
    public function open(UserInterface $user)
    {
        //print __CLASS__ . '->' . __FUNCTION__ . " STARTING\n";

        if (is_null($this->getStorage())) throw new StorageIsNullException();
        if (!$this->checkRight(self::READER_LEVEL)) throw new NoPermissionException();


        if (is_null($this->authAdapter)) {

            $this->authAdapter = new AuthAdapter(
                $this->getStorage()->getDatabaseAdapter(),
                'users', 'login', 'password'
            );
        }

        $this->authAdapter->setIdentity($user->getLogin());
        $this->authAdapter->setCredential($user->getPassword());
        $result = $this->authAdapter->authenticate();

        if (!$result->isValid()) throw new NotAuthenticatedException();

        $this->getStorage()->resetCheckedEntries();
        $this->user = $user;

        //print __CLASS__ . '->' . __FUNCTION__ . " FINISHED.\n";

        return $this;
    }

    public function loadFiles()
    {
        $dir = dir($this->getDataPath());

        while ($fileName = $dir->read()) {

            $fullFileName = $this->getDataPath() . '/' . $fileName;

            if (!is_dir($fullFileName) || mb_ereg_match('^[.~]', $fileName)) continue;

            print 'Reading folder: ' . $fullFileName . "\n";
            if (array_key_exists($fileName, $this->bookChapters)) {

                print 'Reading chapter: ' . $fullFileName . "\n";
                $this->bookChapters[$fileName]->loadFiles();
            }
        }
    }

    public function checkFiles()
    {
        foreach ($this->bookChapters as $chapter) {

            $chapter->checkFiles();
            print 'Chapter class: ' . get_class($chapter) . "\n";
        }
    }

    public function executeFiles()
    {
        foreach ($this->bookChapters as $chapter) {

            $chapter->executeFiles();
        }
    }

    public function addChapter(BookChapterInterface $chapter)
    {
        $this->bookChapters[mb_ereg_replace('chapter', '', basename(get_class($chapter)), 'i')] = $chapter;
        return $this;
    }
}