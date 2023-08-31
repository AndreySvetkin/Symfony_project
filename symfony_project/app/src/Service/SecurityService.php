<?php
namespace App\Service;

use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\User;


class SecurityService
{
    public function __construct(
        private Security $security,
    ){
    }

    public function isAuthor(User $author): bool
    {
        $user = $this->security->getUser();
        if (strcmp($author->getEmail(),$user->getEmail())){
            return true;
        }
        return false;
    }

    public function getUser(User $author): User{
        return $this->security->getUser();
    }
}
