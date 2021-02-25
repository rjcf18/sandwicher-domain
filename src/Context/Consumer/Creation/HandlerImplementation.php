<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Consumer\Creation;

class HandlerImplementation implements Handler
{
    private ConsumerRepository $consumerRepository;

    public function __construct(ConsumerRepository $consumerRepository)
    {
        $this->consumerRepository = $consumerRepository;
    }

    public function create(RequestModel $requestModel): ResponseModel
    {
        return new ResponseModel(
            $this->consumerRepository->create($requestModel->getName(), $requestModel->getEmail())
        );
    }
}