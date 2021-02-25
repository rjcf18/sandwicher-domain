<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Consumer\Creation;

interface Handler
{
    public function create(RequestModel $requestModel): ResponseModel;
}