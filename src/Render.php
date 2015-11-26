<?php

namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Render extends Command
{

	/**
	 * configuring the command
	 */
	public function configure()
	{
		$this->setName('render')
			->setDescription('render some tabular data');
	}

	/**
	 * executing the command on dummy data
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int|null|void
	 */
	public function execute(InputInterface $input, OutputInterface $output)
	{
		$table = new Table($output);

		$table->setHeaders([ 'id' , 'name', 'title'])->setRows(
			[
				[ 1 , 'name 1', 'title 1'],
				[ 2 , 'name 2', 'title 2'],
				[ 3 , 'name 3', 'title 3']
			]
		);
		$table->render();
	}

}