<?php

declare(strict_types=1);

require __DIR__. '/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Authorization\AccessManager;
use App\Authorization\Voter\PostVoter;
use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

$containerBuilder = new ContainerBuilder();

$user = new User("Jure");
$admin = new User("Admin");

$admin->addRole(User::ROLE_ADMIN);

$post = new Post();

//Creating definition for PostVoter and AccessManager classes;
$postVoterDefinition = new Definition(PostVoter::class);
$containerBuilder->setDefinition(PostVoter::class, $postVoterDefinition);

$accessManagerDefinition = new Definition(AccessManager::class);
$accessManagerDefinition->addArgument([new Reference(PostVoter::class)]);
$containerBuilder->setDefinition(AccessManager::class, $accessManagerDefinition);

$accessManager = $containerBuilder->get(AccessManager::class);

if ($accessManager->decide(PostVoter::READ, $post, $admin)) {
    echo "Yea go ahead!";
} else {
    echo "YOU SHALL NOT PASS!";
}
