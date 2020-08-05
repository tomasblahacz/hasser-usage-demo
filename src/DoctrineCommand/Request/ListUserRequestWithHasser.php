<?php

declare(strict_types=1);

namespace App\DoctrineCommand\Request;

class ListUserRequestWithHasser implements ListUserRequestInterface
{

    private ?string $name;

    public function __construct(?string $name)
    {
        $this->name = $name;
    }

    public function hasName(): bool
    {
        return $this->name !== null;
    }

    public function getName(): string
    {
        return $this->name;
    }

}