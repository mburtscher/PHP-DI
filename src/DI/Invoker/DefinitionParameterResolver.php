<?php

namespace DI\Invoker;

use DI\Definition\Definition;
use DI\Definition\Helper\DefinitionHelper;
use DI\Definition\Resolver\DefinitionResolver;
use Invoker\ParameterResolver\ParameterResolver;
use ReflectionFunctionAbstract;

/**
 * Resolves callable parameters using definitions.
 *
 * @since 5.0
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class DefinitionParameterResolver implements ParameterResolver
{
    /**
     * @var DefinitionResolver
     */
    private $definitionResolver;

    public function __construct(DefinitionResolver $definitionResolver)
    {
        $this->definitionResolver = $definitionResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters(
        ReflectionFunctionAbstract $reflection,
        array $providedParameters,
        array $resolvedParameters
    ) {
        foreach ($resolvedParameters as &$parameter) {
            if ($parameter instanceof DefinitionHelper) {
                $parameter = $parameter->getDefinition('');
            }
            if ($parameter instanceof Definition) {
                $parameter = $this->definitionResolver->resolve($parameter);
            }
        }

        return $resolvedParameters;
    }
}
