<?php

namespace PhpKnight\WeMeal\Core\Container;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;
use PhpKnight\WeMeal\Core\Container\Exception\DependencyHasNoDefaultValueException;
use PhpKnight\WeMeal\Core\Container\Exception\DependencyIsNotInstantiableException;

class Container {

	protected $instances = [];

	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
	 * @throws ContainerExceptionInterface|ReflectionException Error while retrieving the entry.
	 *
	 * @return mixed Entry.
	 */
	public function get( string $id ): object {
		if ( ! $this->has( $id ) ) {
			$this->set( $id );
		}

		$instance = $this->instances[ $id ];
		return $this->resolve( $instance );
	}

	/**
	 * Sets an entry of the container by its identifier
	 *
	 * @param string $id
	 * @param object|null $instance
	 *
	 * @return void
	 */
	public function set( string $id, object $instance = null ): void {
		if ( $instance === null ) {
			$instance = $id;
		}
		$this->instances[ $id ] = $instance;
	}

	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return bool
	 */
	public function has( string $id ): bool {
		return isset( $this->instances[ $id ] );
	}


	/**
	 * Resolves the service object by its name.
	 *
	 * @param string $class_name
	 *
	 * @throws DependencyHasNoDefaultValueException
	 * @throws DependencyIsNotInstantiableException
	 * @throws ReflectionException|Exception
	 *
	 * @return object
	 */
	public function resolve( string $class_name ): object {
		if ( ! class_exists( $class_name ) ) {
			throw new Exception( "Class: {$class_name} does not exist" );
		}

		$reflection_class = new ReflectionClass( $class_name );

		if ( ! $reflection_class->isInstantiable() ) {
			throw new DependencyIsNotInstantiableException( "Class: {$class_name} is not instantiable" );
		}

		if ( null === $reflection_class->getConstructor() ) {
			return $reflection_class->newInstance();
		}

		$parameters = $reflection_class->getConstructor()->getParameters();

		$dependencies = $this->build_dependencies( $parameters );

		return $reflection_class->newInstanceArgs( $dependencies );
	}


	/**
	 * Builds the dependencies for the given parameters.
	 *
	 * @param ReflectionParameter[] $parameters
	 *
	 * @throws ReflectionException
	 * @throws DependencyHasNoDefaultValueException
	 *
	 * @return array
	 */
	public function build_dependencies( array $parameters ): array {
		$dependencies = [];

		foreach ( $parameters as $parameter ) {
			$dependency = $parameter->getClass();

			if ( is_null( $dependency ) ) {
				if ( $parameter->isDefaultValueAvailable() ) {
					$dependencies[] = $parameter->getDefaultValue();
				} else {
					throw new DependencyHasNoDefaultValueException( "Class: {$parameter->name} dependency can not be resolved" );
				}
			} else {
				$dependencies[] = $this->get( $dependency->name );
			}
		}

		return $dependencies;
	}
}
