<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 03.06.2016
 * Time: 16:15
 */

namespace Acquiring\Model;


use Core\Model\BookChapter;
use Core\Model\BookInterface;

class Acquiring extends BookChapter implements AcquiringInterface {

    public function __construct(BookInterface $book)
    {
        parent::__construct($book, __CLASS__);
    }

    public function loadFiles($path)
    {
        $commissions = array(0.6, 1);

        $excel = \PHPExcel_IOFactory::load($path . '/' . self::TEMPLATE_DIR . '/acquiring.xlsx');
        $worksheet = $excel->getSheet(0);

        $terminals = array('554515', '554516', '554517');
        $terminals = array('704097', '528246');
        $dir = dir($path . '/' . self::INPUT_DIR);
        $dateInterval = new \DateInterval('P1D');

        while ($fileName = $dir->read()) {

            if (mb_ereg_match('^[~.]', $fileName)) continue;

            print $fileName;

            $file = fopen($path . '/' . self::INPUT_DIR . '/' . $fileName, 'r');
            $count = 0;
            $i = 4;
            while ($line = fgets($file)) {

                $terminal = substr($line, 127, 6);
                if (!in_array($terminal, $terminals)) continue;

                $worksheet->insertNewRowBefore($i + 1, 1);
                $worksheet->getCellByColumnAndRow(0, $i)->setValue($terminal);

                $cardNo = substr($line, 26, 16);
                $worksheet->getCellByColumnAndRow(1, $i)->setValueExplicit(
                    mb_substr($cardNo, 0, 4) . '********' . mb_substr($cardNo, -4, 4)
                );
                $worksheet->getCellByColumnAndRow(2, $i)->setValue(trim(substr($line, 155, 12)));

                $commissionType = substr($line, 24, 1);
                $commission = $commissionType == 'C' || $commissionType == 'P' ? $commissions[0] :
                    $commissions[1];
                $worksheet->getCellByColumnAndRow(3, $i)->setValue($commission);

                $amount = $worksheet->getCellByColumnAndRow(2, $i)->getValue();
                $commissionValue = $worksheet->getCellByColumnAndRow(3, $i)->getValue();
                $worksheet->getCellByColumnAndRow(4, $i)->setValue(round($amount * $commissionValue / 100, 2));
                $worksheet->getCellByColumnAndRow(5, $i)->setValue(
                    $amount - round($amount * $commissionValue / 100, 2)
                );

                $turnDate = date_create_from_format('ymd', substr($line, 8, 6));
                $accountDate = clone $turnDate;
                $accountDate->add($dateInterval);
                $worksheet->getCellByColumnAndRow(6, $i)->setValue($turnDate->format('d.m.Y'));
                $worksheet->getCellByColumnAndRow(7, $i)->setValue($accountDate->format('d.m.Y'));
                $worksheet->getCellByColumnAndRow(8, $i)->setValue($amount < 0 ? 'Возврат' : 'Оплата');

                ++$count;
                ++$i;
            }

            $writer = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $writer->save($path . '/' . self::OUTPUT_DIR . '/ACQ_379899_' . date('ymd') . '_ED_01.xlsx');

            fclose($file);
            //$this->archive(
            //    $path . '/' . self::INPUT_DIR . '/' . $fileName,
            //    $this->getShortName(__CLASS__, "\\\\"),
            //   self::INPUT_DIR
            //);

            print ': ' . $count . " lines\n";
            //print $this->getShortName(__CLASS__, "\\\\") . "\n";
        }
    }
} 