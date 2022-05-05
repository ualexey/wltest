<?php

namespace App\Command;

use App\Parcer\ParcerManager;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Parcer extends Command
{

    protected static $defaultName = 'app:parce-domain';

    protected function configure()
    {
        $this
            ->setDescription('Parce site by domain')
            ->addArgument('domainName', InputArgument::REQUIRED, 'Site domain.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        /**
         * Run Pattern Strategy
         */

        try {
            $result = (new ParcerManager($input->getArgument('domainName')))->handle();
        } catch (Exception $e) {
            $output->writeLn(json_encode(['error' => $e->getMessage()]));

            return 1;
        }

        $output->writeLn(json_encode($result));

        return 0;

    }

}
