<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

class ResponseModel
{
    protected int $mealId;

    public function __construct(int $mealId)
    {
        $this->mealId = $mealId;
    }

    public function getMealId(): int
    {
        return $this->mealId;
    }
}