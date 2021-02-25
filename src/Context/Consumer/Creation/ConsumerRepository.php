<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Consumer\Creation;

use Sandwicher\Domain\Shared\Entity\Consumer as ConsumerEntity;

interface ConsumerRepository
{
    public function create(string $name, string $email): ConsumerEntity;
}