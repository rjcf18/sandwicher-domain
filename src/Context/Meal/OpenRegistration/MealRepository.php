<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

use Sandwicher\Domain\Shared\Entity\Meal as MealEntity;

interface MealRepository
{
    public function openRegistration(): MealEntity;

    public function registrationAlreadyOpened(): bool;
}