<?php

namespace App\Command;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use App\Repository\SourceRepository;
use Symfony\Bundle\FrameworkBundle\Tests\Functional\app\AppKernel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\ConfigService;

class ConfigCommands extends Command
{
    protected static $defaultName = "app:ChangeSource";
    private $sourceRepo;
    private $configs;

    function __construct(string $name = null, SourceRepository $sourceRepository,ConfigService $configService)
    {
        $this->configs=$configService;
        $this->sourceRepo = $sourceRepository;
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Change Source')
            ->setHelp('Change Data Source (cbr,ecb)');
        $this->addArgument("source", InputArgument::REQUIRED, 'data source {cbr,ecb}');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = $input->getArgument('source');
        switch ($source) {
            case 'cbr':
                $this->configs->setConfig("source",'cbr');
                break;
            case 'ecb':
                $this->configs->setConfig("source",'ecb');
                break;
            default:
                echo 'Source Not Found';
        }
    }


}