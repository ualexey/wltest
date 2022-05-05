<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class WltestStrategyTest extends KernelTestCase
{


    public function testFailExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:parce-domain');

        $commandTester = new CommandTester($command);

        $commandTester->execute(['domainName' => 'gvgjfvyvtgyug7gigykfsdrtuGFJf']);

        $output = $commandTester->getDisplay();

        $data = json_decode($output, true);

        $this->assertArrayHasKey('error', $data);

    }

    public function testSuccessExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:parce-domain');

        $commandTester = new CommandTester($command);

        $commandTester->execute(['domainName' => 'wltest']);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();

        $buff = json_decode($output, true);

        foreach ($buff as $val) {
            $this->assertArrayHasKey('name', $val);
            $this->assertArrayHasKey('description', $val);
            $this->assertArrayHasKey('price', $val);
            $this->assertArrayHasKey('discount', $val);
        }
    }

}
