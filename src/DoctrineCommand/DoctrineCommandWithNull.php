<?php

declare(strict_types=1);

namespace App\DoctrineCommand;

use Symfony\Component\Console\Command\Command;

class DoctrineCommandWithNull extends \Symfony\Component\Console\Command\Command
{

    private DoctrineCommandFacade $doctrineCommandFacade;

    public function __construct(
        DoctrineCommandFacade $doctrineCommandFacade
    )
    {
        parent::__construct();
        $this->doctrineCommandFacade = $doctrineCommandFacade;
    }

    protected function configure(): void
    {
        $this->setName('test:doctrine-with-null');
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output): int
    {
        $request = $this->doctrineCommandFacade->getRequest();
        $searchCriteria = $this->doctrineCommandFacade->getCriteria($request);
        $users = $this->doctrineCommandFacade->getUsers($searchCriteria);

        dd($users);

        return Command::SUCCESS;
    }

}