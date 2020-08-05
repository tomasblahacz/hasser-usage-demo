<?php

declare(strict_types=1);

namespace App\DoctrineCommand;

use App\DoctrineCommand\Request\ListUserRequest;
use App\DoctrineCommand\Request\ListUserRequestInterface;
use App\DoctrineCommand\Request\ListUserRequestWithHasser;
use App\Entity\User\User;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineCommandFacade
{

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function getRequest(): ListUserRequest
    {
        return new ListUserRequest(null);
    }

    public function getRequestWithHasser(): ListUserRequestWithHasser
    {
        return new ListUserRequestWithHasser(null);
    }

    /**
     * @return User[]
     */
    public function getUsers(Criteria $criteria): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('user')
            ->from(User::class, 'user')
            ->addCriteria($criteria)
            ->getQuery()
            ->getResult();
    }

    public function getCriteria(ListUserRequestInterface $listUserRequest): Criteria
    {
        $expression = Criteria::expr()->eq('user.name', $listUserRequest->getName());
        $criteria = Criteria::create()->andWhere($expression);

        return $criteria;
    }

}