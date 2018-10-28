<?php declare(strict_types=1);

require __DIR__. '/../vendor/autoload.php';

use App\Controller\PostController;
use App\DependencyInjection\Compiler\VoterPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

$env = 'dev';
$cachedContainerFile = __DIR__ .'/../var/cache/CachedContainer.php';

if ($env === 'prod' && file_exists($cachedContainerFile)) {
    require_once $cachedContainerFile;

    $containerBuilder = new CachedContainer();
} else {
    $containerBuilder = new ContainerBuilder();

    /**
     * Add compiler pass
     */
    $containerBuilder->addCompilerPass(new VoterPass());
    $containerBuilder->setParameter('env', $env);

    /**
     * Register configuration
     */
    $loader = new PhpFileLoader($containerBuilder, new FileLocator(__DIR__.'/../config'));
    $loader->load('parameters.php');
    $loader->load('config.php');
    $loader->load('monolog.php');


    $containerBuilder->compile();

    $dumper = new PhpDumper($containerBuilder);
    file_put_contents($cachedContainerFile, $dumper->dump(['class' => 'CachedContainer']));
}

$containerBuilder->get(PostController::class)->index();
