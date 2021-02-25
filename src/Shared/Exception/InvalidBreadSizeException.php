<?php declare(strict_types=1);
namespace Sandwicher\Domain\Shared\Exception;

use InvalidArgumentException;

class InvalidBreadSizeException extends InvalidArgumentException
{
    protected $message = 'An invalid bread size was chosen';
}