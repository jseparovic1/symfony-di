<?php declare(strict_types=1);

namespace App\DependencyInjection\Compiler;
use App\Authorization\AccessManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class VoterPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $accessManagerDefinition = $container->getDefinition(AccessManager::class);

        $voters = $container->findTaggedServiceIds('app.voter');
        foreach ($voters as $serviceId => $tagAttributes){
            $accessManagerDefinition->addMethodCall('addVoter', [new Definition($serviceId)]);
        }
    }
}
