<?php

namespace AppBundle\Command;

use AppBundle\Entity\Artist;
/*use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;*/

use AppBundle\Repository\ArtistRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArtistCommand extends Command
{
    protected $repo;

    public function __construct(ArtistRepository $repo)
    {
        $this->repo = $repo;
        parent::__construct();
    }

    protected function configure()
    {

        $this->setName('app:query:artist')
            ->setDescription('Trouver infos sur artiste')
            ->addArgument('id', InputArgument::OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $id = $input->getArgument('id');

        if (!$id) {
            $id = $io->ask('Id de l\'artiste ?');
        }

        $artist = $this->repo->find($id);


        $output->writeln('Nom de l\'artiste: ' . $artist->getName());
        $output->writeln('Type de l\'artiste: ' . $artist->getType());
        $output->writeln('Image de l\'artiste: ' . $artist->getPicture());
        $output->writeln('Genre de l\'artiste: ' . $artist->getGenre());
    }
}