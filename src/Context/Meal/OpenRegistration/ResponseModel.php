<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

use Sandwicher\Domain\Shared\Entity\Meal as MealEntity;

class ResponseModel
{
    protected MealEntity $mealEntity;

    public function __construct(MealEntity $mealEntity)
    {
        $this->mealEntity = $mealEntity;
    }

    public function getMealEntity(): MealEntity
    {
        return $this->mealEntity;
    }
}