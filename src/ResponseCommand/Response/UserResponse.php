<?php

declare(strict_types=1);

namespace App\ResponseCommand\Response;

class UserResponse
{

    private ?string $name;

    private string $greeting;

    public function __construct(
        ?string $name,
        string $greeting
    )
    {
        $this->name = $name;
        $this->greeting = $greeting;
    }


}