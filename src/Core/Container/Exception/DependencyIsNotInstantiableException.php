<?php

namespace PhpKnight\WeMeal\Core\Container\Exception;

use Exception;
use PhpKnight\WeMeal\Core\Container\ContainerExceptionInterface;

class DependencyIsNotInstantiableException extends Exception implements ContainerExceptionInterface {
}
