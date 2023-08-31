<?php
namespace App\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use App\Service\SecurityService;

class AuthorEventListener
{
    public function __construct(
        private SecurityService $securityService,
    ){
    }

    public function prePersist(PrePersistEventArgs $args)
    {
        $entity = $args->getObject();
        $entityManager = $args->getObjectManager();

        if ($entity instanceof AuthorInterface) {
            $author=$this->securityService->getUser();
            $entity->setAuthor($author);
        }
    }
}