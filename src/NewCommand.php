<?php
/**
 * Created by PhpStorm.
 * User: TAU
 * Date: 11/26/15
 * Time: 6:19 PM
 */

namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NewCommand extends Command
{

    public function configure()
    {
        $this->setName('New')
            ->setDescription('Create new laravel project')
            ->addArgument('name' , InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input , OutputInterface $output)
    {
        $directory = getcwd(). '/' . $input->getArgument('name');
        $this->assertApplicationFolderDoesNotExist($directory , $output);
    }

    private function assertApplicationFolderDoesNotExist($directory , OutputInterface $output)
    {
        if(is_dir($directory)){
            $output->writeln('Project already exists');
            exit(1);
        }
    }

}