<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Meal\OpenRegistration\Exception;

use Exception;

class MealRegistrationAlreadyOpenedException extends Exception
{
    protected $message = "There is already a meal currently open";
}