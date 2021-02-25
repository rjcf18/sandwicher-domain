<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration;

use Sandwicher\Domain\Context\Meal\OpenRegistration\Validator\Semantic as SemanticValidator;

class HandlerImplementation implements Handler
{
    private SemanticValidator $semanticValidator;

    private MealRepository $mealRepository;

    public function __construct(SemanticValidator$semanticValidator, MealRepository $mealRepository)
    {
        $this->semanticValidator = $semanticValidator;
        $this->mealRepository = $mealRepository;
    }

    /**
     * @throws Exception\MealRegistrationAlreadyOpenedException
     *
     * @return ResponseModel
     */
    public function openRegistration(): ResponseModel
    {
        $this->semanticValidator->validate();

        return new ResponseModel($this->mealRepository->openRegistration());
    }
}