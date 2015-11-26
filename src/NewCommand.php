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
use GuzzleHttp\ClientInterface;
use ZipArchive;

class NewCommand extends Command
{


	private $client;

	/**
	 * NewCommand constructor.
	 * @param ClientInterface $client
	 */
	public function __construct(ClientInterface $client)
	{
		$this->client = $client;

		parent::__construct();
	}

	/**
	 *
	 */
	public function configure()
	{
		$this->setName('new')
			->setDescription('Create new laravel project')
			->addArgument('name', InputArgument::REQUIRED);
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return int|null|void
	 */
	public function execute(InputInterface $input, OutputInterface $output)
	{
		$directory = getcwd() . '/' . $input->getArgument('name');
		$this->assertApplicationFolderDoesNotExist($directory, $output);

		$output->writeln("<comment>Downloading ....</comment>");
		$this->download($zipFile = $this->makeFileName())
			->extract($zipFile, $directory, $output)
			->cleanUp($zipFile, $output);

		$output->writeln("<comment>App Ready</comment>");
	}

	/**
	 * @param $directory
	 * @param OutputInterface $output
	 */
	private function assertApplicationFolderDoesNotExist($directory, OutputInterface $output)
	{
		if (is_dir($directory)) {
			$output->writeln("<error>Project already exists</error>");
			exit(1);
		}
	}

	/**
	 * @param $zipFile
	 * @return $this
	 */
	private function download($zipFile)
	{
		$response = $this->client->request('GET' , 'http://cabinet.laravel.com/latest.zip')->getBody();
		file_put_contents($zipFile, $response);

		return $this;

	}

	/**
	 * create file name for
	 * @return string
	 */
	private function makeFileName()
	{
		return getcwd() . '/laravel_' . md5(time() . uniqid()) . '.zip';
	}

	/**
	 * @param $zipFile
	 * @param $directory
	 * @param OutputInterface $output
	 * @return $this
	 */
	private function extract($zipFile, $directory, OutputInterface $output)
	{
		$output->writeln("<comment>Extracting ....</comment>");

		$archive = new ZipArchive;
		$archive->open($zipFile);
		$archive->extractTo($directory);
		$archive->close();
		return $this;
	}

	private function cleanUp($zipFile, OutputInterface $output)
	{
		$output->writeln("<comment>CLeaning Up ....</comment>");

		@chmod($zipFile, 0777);
		@unlink($zipFile);
		return $this;
	}

}