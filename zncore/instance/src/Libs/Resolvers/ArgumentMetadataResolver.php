<?php

namespace ZnCore\Instance\Libs\Resolvers;

use ArgumentResolver\Argument\ArgumentDescription;
use ArgumentResolver\Argument\ArgumentDescriptions;
use ArgumentResolver\Argument\ArgumentDescriptor;
use ArgumentResolver\Exception\ArgumentResolutionException;
use ArgumentResolver\Exception\ResolutionException;
use ArgumentResolver\Resolution\ConstraintResolver;
use ArgumentResolver\Resolution\Resolution;
use ArgumentResolver\Resolution\ResolutionConstraint;
use ArgumentResolver\Resolution\ResolutionConstraintCollection;
use ArgumentResolver\Resolution\Resolutions;
use Psr\Container\ContainerInterface;

class ArgumentMetadataResolver
{

    protected ?ContainerInterface $container = null;
        protected ?\ZnCore\Instance\Libs\Resolvers\ArgumentDescriptor $argumentDescriptor = null;
        protected ?ConstraintResolver $constraintResolver = null;

    public function __construct(
        ?ContainerInterface $container = null,
        ?\ZnCore\Instance\Libs\Resolvers\ArgumentDescriptor $argumentDescriptor = null,
        ?ConstraintResolver $constraintResolver = null,
    ) {
        if($container) {
            $this->container = $container;
        }
        $this->argumentDescriptor = $argumentDescriptor ?: new \ZnCore\Instance\Libs\Resolvers\ArgumentDescriptor();
        $this->constraintResolver = $constraintResolver ?: new ConstraintResolver();
    }

    public function call($callback, array $availableArguments = []): mixed
    {
        $resolvedArguments = $this->resolve($callback, $availableArguments);
        return call_user_func_array($callback, $resolvedArguments);
    }

    public function resolve($callback, array $availableArguments = [])
    {
        $descriptions = $this->argumentDescriptor->getDescriptions($callback);
        $constraints = $this->constraintResolver->resolveConstraints($descriptions);

        foreach ($descriptions as $argument) {
            /** @var ArgumentDescription $argument */
            if(!array_key_exists($argument->getName(), $availableArguments)) {
                try {
                    $argumentValue = $this->container->get($argument->getType());
                    $availableArguments[$argument->getName()] = $argumentValue;
                } catch (\Throwable $e) {}
            }
        }

        $resolutions = new Resolutions();
        foreach ($descriptions as $description) {
            $resolutions->addCollection(
                $this->getArgumentResolutions($constraints, $description, $availableArguments)
            );
        }
        $this->addMissingResolutions($resolutions, $descriptions);
        $arguments = $resolutions->sortByPriority()->toArgumentsArray();
        return $arguments;
    }

    /**
     * @param ResolutionConstraintCollection $constraints
     * @param ArgumentDescription            $description
     * @param array                          $availableArguments
     *
     * @return Resolution[]
     */
    private function getArgumentResolutions(ResolutionConstraintCollection $constraints, ArgumentDescription $description, array $availableArguments)
    {
        $resolutions = [];

        foreach ($availableArguments as $argumentName => $argumentValue) {
            $priority = $this->getArgumentPriority($constraints, $description, $argumentName, $argumentValue);

            if ($priority > 0) {
                $resolutions[] = new Resolution($description->getPosition(), $argumentValue, $priority);
            }
        }

        return $resolutions;
    }

    /**
     * @param ResolutionConstraintCollection $constraints
     * @param ArgumentDescription            $description
     * @param string                         $argumentName
     * @param mixed                          $argumentValue
     *
     * @return int
     */
    private function getArgumentPriority(ResolutionConstraintCollection $constraints, ArgumentDescription $description, $argumentName, $argumentValue)
    {
        $priority = 0;
        if ($description->getName() === $argumentName) {
            $priority++;
        }

        if ($description->isScalar()) {
            return $priority;
        }

        if ($description->getType() === $this->argumentDescriptor->getValueType($argumentValue)) {
            $priority += 2;
        } elseif ($constraints->hasConstraint(
            ResolutionConstraint::STRICT_MATCHING,
            [
                'type' => $description->getType(),
            ]
        )) {
            
            /*throw new ResolutionException(
                sprintf(
                    'Strict matching for type "%s" can\'t be resolved',
                    $description->getType()
                )
            );*/
        }

        return $priority;
    }

    /**
     * @param Resolutions          $resolutions
     * @param ArgumentDescriptions $descriptions
     *
     * @throws ResolutionException
     */
    private function addMissingResolutions(Resolutions $resolutions, ArgumentDescriptions $descriptions)
    {
        $missingResolutionPositions = $resolutions->getMissingResolutionPositions($descriptions->count());

        foreach ($missingResolutionPositions as $position) {
            $description = $descriptions->getByPosition($position);
            if ($description->isRequired()) {
                throw new ArgumentResolutionException(
                    sprintf(
                        'Argument at position %d is required and wasn\'t resolved',
                        $description->getPosition()
                    ),
                    $description
                );
            }

            $resolutions->add(new Resolution($description->getPosition(), $description->getDefaultValue(), 0));
        }
    }
}
