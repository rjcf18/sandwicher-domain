<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration\Validator;

use Sandwicher\Domain\Context\Meal\OpenRegistration\Exception\MealRegistrationAlreadyOpenedException;
use Sandwicher\Domain\Context\Meal\OpenRegistration\MealRepository;

class Semantic
{
    private MealRepository $mealRepository;

    public function __construct(MealRepository $mealRepository)
    {
        $this->mealRepository = $mealRepository;
    }

    /**
     * @throws MealRegistrationAlreadyOpenedException
     *
     * @return bool
     */
    public function validate(): bool
    {
        if ($this->mealRepository->registrationAlreadyOpened()) {
            throw new MealRegistrationAlreadyOpenedException();
        }

        return true;
    }
}