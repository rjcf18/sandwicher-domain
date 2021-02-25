<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

interface Handler
{
    public function openRegistration(): ResponseModel;
}