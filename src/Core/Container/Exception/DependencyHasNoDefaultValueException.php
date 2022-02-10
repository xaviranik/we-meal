<?php

namespace PhpKnight\WeMeal\Core\Container\Exception;

use Exception;
use PhpKnight\WeMeal\Core\Container\NotFoundExceptionInterface;

class DependencyHasNoDefaultValueException extends Exception implements NotFoundExceptionInterface {
}
