<?php
/**
 * Created by PhpStorm.
 * User: TAU
 * Date: 11/26/15
 * Time: 5:59 PM
 */

namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class sayHelloCommand extends Command
{

    /**
     *
     */
    public function configure()
    {
        $this->setName('sayHelloTo')
            ->setDescription('saying hello to given person')
            ->addArgument('name', InputArgument::OPTIONAL, 'the name you want to greet')
            ->addOption('greeting', 'g', InputOption::VALUE_OPTIONAL, 'override the default greeting value', 'Hello');
    }

    /**
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $message = sprintf("%s %s", $input->getOption('greeting'), $input->getArgument('name'));
        $output->writeln("<info>{$message}</info>");
    }

}