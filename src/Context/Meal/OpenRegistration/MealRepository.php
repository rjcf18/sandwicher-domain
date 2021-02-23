<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

interface MealRepository
{
    public function openRegistration(): int;
}