<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

class RequestModel
{
    protected int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}