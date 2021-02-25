<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Consumer\Creation;

use Sandwicher\Domain\Shared\Entity\Consumer as ConsumerEntity;

class ResponseModel
{
    protected ConsumerEntity $consumerEntity;

    public function __construct(ConsumerEntity $consumerEntity)
    {
        $this->consumerEntity = $consumerEntity;
    }

    public function getConsumerEntity(): ConsumerEntity
    {
        return $this->consumerEntity;
    }
}