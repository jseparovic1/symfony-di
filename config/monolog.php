<?php declare(strict_types=1);

use App\Logger\FancyLoggerDecorator;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Reference;

$container->register(StreamHandler::class, StreamHandler::class)
    ->addArgument('%app.logger.file_path%');

$container->register(LoggerInterface::class, Logger::class)
    ->addArgument('%app.logger.voter_channel%')
    ->addMethodCall('pushHandler', [new Reference(StreamHandler::class)]);

$container->registerForAutoconfiguration(LoggerAwareInterface::class)
    ->addMethodCall('setLogger', [new Reference(LoggerInterface::class)]);

/**
 * Logger decorator
 */
$container->register(FancyLoggerDecorator::class)
    ->setDecoratedService(LoggerInterface::class)
    ->addArgument(new Reference(FancyLoggerDecorator::class.'.inner'));
