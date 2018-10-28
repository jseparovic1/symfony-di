<?php

declare(strict_types=1);

namespace App\Controller;

use App\Authorization\AccessManager;
use App\Authorization\Voter\PostVoter;
use App\Entity\Post;
use App\Entity\User;

class PostController
{
    /**
     * @var AccessManager
     */
    private $accessManager;

    public function __construct(AccessManager $accessManager)
    {
        $this->accessManager = $accessManager;
    }

    public function index()
    {
        $user = new User("Jure");
        $admin = new User("Admin");

        $admin->addRole(User::ROLE_ADMIN);

        $post = new Post();

        dump($this->accessManager->decide(PostVoter::READ, $post, $admin));
        dump($this->accessManager->decide(PostVoter::WRITE, $post, $admin));
        dump($this->accessManager->decide(PostVoter::READ, $post, $user));
        dump($this->accessManager->decide(PostVoter::WRITE, $post, $user));
    }
}
