<?php declare(strict_types=1);
namespace Sandwicher\Domain\Context\Consumer\Creation;

class RequestModel
{
    protected string $name;

    protected string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}