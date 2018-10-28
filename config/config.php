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

// Private prototype definition
$privateDefinition = new Definition();
$privateDefinition
    ->setAutowired(true)
    ->setAutoconfigured(true)
    ->setPublic(false)
;

$loader->registerClasses(
    $privateDefinition,
    'App\\',
    '../src/*',
    '../src/{Entity,DependencyInjection}'
);

$container
    ->registerForAutoconfiguration(VoterInterface::class)
    ->addTag('app.voter');

// Public prototype definition
$publicDefinition = new Definition();
$publicDefinition
    ->setAutowired(true)
    ->setAutoconfigured(true)
    ->setPublic(true);

$loader->registerClasses(
    $publicDefinition,
    'App\\Controller\\',
    '../src/Controller/*'
);
