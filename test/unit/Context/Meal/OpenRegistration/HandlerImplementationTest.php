<?php declare(strict_types=1);
namespace UnitTest\Context\Meal\OpenRegistration;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sandwicher\Domain\Context\Meal\OpenRegistration\Exception\MealRegistrationAlreadyOpenedException;
use Sandwicher\Domain\Context\Meal\OpenRegistration\HandlerImplementation;
use Sandwicher\Domain\Context\Meal\OpenRegistration\MealRepository;
use Sandwicher\Domain\Context\Meal\OpenRegistration\ResponseModel;
use Sandwicher\Domain\Context\Meal\OpenRegistration\Validator\Semantic as SemanticValidator;
use Sandwicher\Domain\Shared\Entity\Meal as MealEntity;

class HandlerImplementationTest extends TestCase
{
    private MockObject|SemanticValidator $semanticValidatorMock;

    private MockObject|MealRepository $mealRepositoryMock;

    private HandlerImplementation $handler;

    protected function setUp(): void
    {
        $this->semanticValidatorMock = $this->getSemanticValidatorMock();
        $this->mealRepositoryMock = $this->getMealRepositoryMock();

        $this->handler = new HandlerImplementation($this->semanticValidatorMock, $this->mealRepositoryMock);
    }

    /**
     * @throws MealRegistrationAlreadyOpenedException
     */
    public function testOpenRegistrationWhenMealRegistrationIsAlreadyOpenThrowException(): void
    {
        $expectedException = new MealRegistrationAlreadyOpenedException();

        $this->semanticValidatorMock
            ->expects($this->once())
            ->method('validate')
            ->willThrowException($expectedException);

        $this->mealRepositoryMock
            ->expects($this->never())
            ->method('openRegistration');

        $this->expectException($expectedException::class);
        $this->expectExceptionMessage($expectedException->getMessage());

        $this->handler->openRegistration();
    }

    /**
     * @throws MealRegistrationAlreadyOpenedException
     */
    public function testOpenRegistrationWhenNoMealRegistrationIsOpenReturnsMealEntity(): void
    {
        $expectedMeal = (new MealEntity())
            ->setId(1)
            ->setStatus(1)
            ->setRegistrationCode('code');

        $expectedResponse = new ResponseModel($expectedMeal);

        $this->semanticValidatorMock
            ->expects($this->once())
            ->method('validate')
            ->willReturn(true);

        $this->mealRepositoryMock
            ->expects($this->once())
            ->method('openRegistration')
            ->willReturn($expectedResponse->getMealEntity());

        $response = $this->handler->openRegistration();

        $this->assertEquals($expectedResponse, $response);
    }

    private function getSemanticValidatorMock(): MockObject|SemanticValidator
    {
        return $this->getMockBuilder(SemanticValidator::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['validate'])
            ->getMock();
    }

    private function getMealRepositoryMock(): MockObject|MealRepository
    {
        return $this->getMockBuilder(MealRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['openRegistration', 'registrationAlreadyOpened'])
            ->getMock();
    }
}