<?php declare(strict_types=1);

require __DIR__. '/../vendor/autoload.php';

use App\Controller\PostController;
use App\DependencyInjection\Compiler\VoterPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addCompilerPass(new VoterPass());

/**
 * Register configuration
 */
$loader = new PhpFileLoader($containerBuilder, new FileLocator(__DIR__.'/../config'));
$loader->load('config.php');

$containerBuilder->compile();

$containerBuilder->get(PostController::class)->index();
