<?php

declare(strict_types=1);

namespace App\ResponseCommand;

use Symfony\Component\Console\Command\Command;

class ResponseCommandWithHasser extends \Symfony\Component\Console\Command\Command
{

    private ResponseCommandFacade $responseCommandFacade;

    public function __construct(
        ResponseCommandFacade $responseCommandFacade
    )
    {
        parent::__construct();
        $this->responseCommandFacade = $responseCommandFacade;
    }

    protected function configure(): void
    {
        $this->setName('test:response-with-hasser');
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output): int
    {
        $user = $this->responseCommandFacade->getUser(2);
        $response = $this->responseCommandFacade->createUserResponseWithHasser($user);

        ResponseCommandFacade::assertHasKey($response, 'name');
        ResponseCommandFacade::assertHasKey($response, 'greeting');

        return Command::SUCCESS;
    }

}