<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

class HandlerImplementation implements Handler
{
    private MealRepository $mealRepository;

    public function __construct(MealRepository $mealRepository)
    {
        $this->mealRepository = $mealRepository;
    }

    public function openRegistration(RequestModel $requestModel)
    {
        # TODO - Validate if user is administrator

        # TODO - Validate if there is an already opened registration

        $this->mealRepository->openRegistration();
    }
}