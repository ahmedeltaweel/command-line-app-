<?php
/**
 * Created by PhpStorm.
 * User: TAU
 * Date: 11/26/15
 * Time: 7:36 PM
 */

namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Render extends Command
{

	public function configure()
	{
		$this->setName('render')
			->setDescription('render some tabular data');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$table = new Table($output);

		$table->setHeaders(['name', 'age'])->setRows(
			[
				['ahmed', 21],
				['nada', 21]

			]
		);
		$table->render();
	}

}