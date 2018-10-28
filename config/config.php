<?php declare(strict_types=1);

/**
 * Container configuration
 * Available variables $container, $loader, $resource, $type
 */

use App\Authorization\AccessManager;
use App\Authorization\Voter\VoterInterface;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Autoconfiguring services
 */

// Prototype definition
$privateDefinition = new Definition();
$privateDefinition
    ->setAutoconfigured(true)
    ->setAutowired(true)
    ->setPublic(false)
;

// Prototype definition
$publicDefinition = new Definition();
$publicDefinition
    ->setAutoconfigured(true)
    ->setAutowired(true)
    ->setPublic(true)
;

$container
    ->registerForAutoconfiguration(VoterInterface::class)
    ->addTag('app.voter');

$loader->registerClasses($privateDefinition, 'App\\', '../src/*', '../src/{Entity,DependencyInjection}');
$loader->registerClasses($publicDefinition, 'App\\Controller\\', '../src/Controller/*');

$container->getDefinition(AccessManager::class)
    ->setPublic(true);
