<?php

declare(strict_types=1);

namespace App\ResponseCommand;

use App\DoctrineCommand\Request\ListUserRequest;
use App\DoctrineCommand\Request\ListUserRequestInterface;
use App\DoctrineCommand\Request\ListUserRequestWithHasser;
use App\Entity\User\User;
use App\ResponseCommand\Response\UserResponse;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManagerInterface;

class ResponseCommandFacade
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

    public function getUser(int $id): User
    {
        return $this->entityManager->createQueryBuilder()
            ->select('user')
            ->from(User::class, 'user')
            ->where('user.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }

    public function createUserResponse(User $user): UserResponse
    {
        $name = $user->getName();

        return new UserResponse(
            $name,
            sprintf(
                'Hello, %s',
                $name
            )
        );
    }

    public function createUserResponseWithHasser(User $user): UserResponse
    {
        $name = $user->getNameStrictly();

        return new UserResponse(
            $name,
            sprintf(
                'Hello, %s',
                $name
            )
        );
    }

    public function createUserResponseWithUsedHasser(User $user): UserResponse
    {
        if ($user->hasName() === true) {
            $name = $user->getNameStrictly();
        } else {
            $name = User::ANONYMOUS_USER_NAME;
        }

        return new UserResponse(
            $name,
            sprintf(
                'Hello, %s',
                $name
            )
        );
    }

    public function createUserResponseWithUsedTryCatch(User $user): UserResponse
    {
        try {
            $name = $user->getNameStrictly();
        } catch (\TypeError $e) {
            $name = User::ANONYMOUS_USER_NAME;
        }

        return new UserResponse(
            $name,
            sprintf(
                'Hello, %s',
                $name
            )
        );
    }

    /**
     * @param mixed $array
     * @param mixed $key
     */
    public static function assertHasKey(
        $array,
        $key
    ): void
    {
        if (property_exists($array, $key)) {
            echo '.' . PHP_EOL;
        } else {
            echo 'F' . PHP_EOL;
        }
    }

}