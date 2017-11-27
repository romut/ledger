<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 12.07.2017
 * Time: 18:23
 */

namespace Military\Model;


use Core\Model\BookChapter;
use Core\Model\ClientAccountInterface;
use Core\Model\File;
use Core\Model\FileCellInterface;
use Core\Model\FileInterface;
use Core\Model\Model;
use Core\Model\PersonInterface;
use Core\Model\PersonPassportInterface;

class MilitaryChapter extends BookChapter implements MilitaryChapterInterface {

    public function executeERCRegister(FileInterface $file)
    {
        /**
         * @var FileCellInterface[] $row
         */
        foreach ($file as $row) {

            if (!is_numeric($row[0]->getValue())) continue;

            /**
             * @var MilitaryInterface $military
             */
            $military = $this->getStorage()->select(
                'Military\Model\Military',
                array(
                    'last_name' => $row[2]->getValue(),
                    'first_name' => $row[3]->getValue(),
                    'patronymic' => $row[4]->getValue(),
                    'birthday' => Model::toDBDate($row[5]->getValue())
                )
            );

            if (is_null($military)) {

                $military = $this->getStorage()->createModel('Military\Model\Military');
                $military
                    ->setNumber($row[1]->getValue())
                    ->setState(0)
                    ->setLastName($row[2]->getValue())
                    ->setFirstName($row[3]->getValue())
                    ->setPatronymic($row[4]->getValue())
                    ->setBirthday($row[5]->getValue())
                ;

                /**
                 * @var ClientAccountInterface $account
                 */
                $account = $this->getStorage()->createModel('Core\Model\ClientAccount');
                $account
                    ->setState(0)
                    ->setAccount($row[6]->getValue())
                ;
                $military->addAccount($account);

                /**
                 * @var PersonPassportInterface $passport
                 */
                $passport = $this->getStorage()->createModel('Core\Model\PersonPassport');
                $passport
                    ->setPassportType('21')
                    ->setPassportSeries($row[9]->getValue())
                    ->setPassportId($row[10]->getValue())
                    ->setPassportDate($row[11]->getValue())
                    ->setPassportPlace($row[12]->getValue())
                ;

                $military->addPassport($passport);
                $military->save();
            }
        }
    }

    public function checkFile(FileInterface $file)
    {
        //print 'Check file for MilitaryChapter: ' . self::toConsole($file->getName()) . "\n";

        $file
            ->setState(File::STATE_CHECKED)
            ->save()
        ;

        return $this;
    }

    public function executeFile(FileInterface $file)
    {
        switch ($file->getFileType()->getName()) {

            case 'Military Register for ERC':
                $this->executeERCRegister($file);
                break;
        }

        return $this;
    }
}