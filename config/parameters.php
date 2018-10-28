<?php declare(strict_types=1);

$container->setParameter('root_dir', __DIR__.'/..');
$container->setParameter('app.logger.voter_channel', 'voter');
$container->setParameter('app.logger.file_path', '%root_dir%/var/app.log');
