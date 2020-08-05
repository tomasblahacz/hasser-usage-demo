<?php

declare(strict_types=1);

namespace App\ResponseCommand;

use Symfony\Component\Console\Command\Command;

class ResponseCommandWithUsedTryCatch extends \Symfony\Component\Console\Command\Command
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
        $this->setName('test:response-with-used-try-catch');
    }

    protected function execute(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output): int
    {
        $user = $this->responseCommandFacade->getUser(2);
        $response = $this->responseCommandFacade->createUserResponseWithUsedTryCatch($user);

        dd($response);
        
        ResponseCommandFacade::assertHasKey($response, 'name');
        ResponseCommandFacade::assertHasKey($response, 'greeting');


        return Command::SUCCESS;
    }

}