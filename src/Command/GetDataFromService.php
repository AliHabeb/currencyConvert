<?php

namespace App\Command;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use App\Repository\SourceRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetDataFromService extends Command
{
    protected static $defaultName = "app:getData";
    private $sourceRepo;
    private $currencyRepo;

    function __construct(string $name = null, SourceRepository $sourceRepository, CurrencyRepository $currencyRepository)
    {
        $this->sourceRepo = $sourceRepository;
        $this->currencyRepo = $currencyRepository;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Get Xml Data From Source ')
            ->setHelp('Get Xml Data From Source and store it on database');
        $this->addArgument("source", InputArgument::REQUIRED, 'data source {cbr,ecb}');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = $input->getArgument('source');
        switch ($source) {
            case 'cbr':
                $this->getDataFromCBR();
                break;
            case 'ecb':
                $this->getDataFromECB();
                break;
            default:
                echo 'Source Not Found';
        }
    }

    private function getDataFromCBR()
    {
        $source = $this->sourceRepo->findOneBy(['name' => 'cbr']);
        if (!is_null($source)) {
            $file = file_get_contents($source->getUrl());
            $xml = simplexml_load_string($file);
            foreach ($xml as $k => $v) {
                $rate = $v->Value[0];
                $currency = $v->CharCode[0];
                $this->currencyRepo->save(new Currency($source, $currency, $rate));
                echo ".";

            }
            echo PHP_EOL."DONE".PHP_EOL;
        }else{
            echo "Source not Found";
        }

    }

    private function getDataFromECB()
    {
        $source = $this->sourceRepo->findOneBy(['name' => 'ecb']);
        if (!is_null($source)) {
            $file = file_get_contents($source->getUrl());
            $xml = simplexml_load_string($file);
            $arr = $xml->Cube->Cube->Cube;
            foreach ($arr as $k => $v) {
                $currency = $v->attributes()->currency;
                $rate = $v->attributes()->rate;
                $this->currencyRepo->save(new Currency($source, $currency, $rate));
                echo ".";
            }
            echo PHP_EOL."DONE".PHP_EOL;
        }else{
            echo "Source not Found";
        }
    }
}