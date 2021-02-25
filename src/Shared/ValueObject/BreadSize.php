<?php declare(strict_types=1);
namespace Sandwicher\Domain\Shared\ValueObject;

use Sandwicher\Domain\Shared\Exception\InvalidBreadSizeException;

class BreadSize
{
    private const ALLOWED_SIZES = [15, 30];

    private int $size;

    public function __construct(int $size)
    {
        $this->setSize($size);
    }

    private function setSize(int $size): void
    {
        if (!in_array($size, self::ALLOWED_SIZES)) {
            throw new InvalidBreadSizeException();
        }

        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}