<?php declare(strict_types=1);
namespace UnitTest\Context\Consumer\Creation;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Sandwicher\Domain\Context\Consumer\Creation\Service;
use Sandwicher\Domain\Context\Consumer\Creation\ConsumerRepository;
use Sandwicher\Domain\Context\Consumer\Creation\RequestModel;
use Sandwicher\Domain\Context\Consumer\Creation\ResponseModel;
use Sandwicher\Domain\Shared\Entity\Consumer as ConsumerEntity;

class ServiceTest extends TestCase
{
    private MockObject|ConsumerRepository $consumerRepositoryMock;

    private Service $handlerService;

    protected function setUp(): void
    {
        $this->consumerRepositoryMock = $this->getConsumerRepositoryMock();

        $this->handlerService = new Service($this->consumerRepositoryMock);
    }

    public function testCreateWhenNoErrorsOccurReturnsEntity(): void
    {
        $expectedConsumer = (new ConsumerEntity())
            ->setId(1)
            ->setName('test')
            ->setEmail('test@email.com');

        $expectedResponse = new ResponseModel($expectedConsumer);

        $this->consumerRepositoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($expectedResponse->getConsumerEntity());

        $response = $this->handlerService->create(
            new RequestModel($expectedConsumer->getName(), $expectedConsumer->getEmail())
        );

        $this->assertEquals($expectedResponse, $response);
    }

    private function getConsumerRepositoryMock(): MockObject|ConsumerRepository
    {
        return $this->getMockBuilder(ConsumerRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['create'])
            ->getMock();
    }
}