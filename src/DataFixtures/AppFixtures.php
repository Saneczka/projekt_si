<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserData;
use App\Entity\Album;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    private function loadUsers(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin'));
        $user->setRoles(array('ROLE_ADMIN'));
//        $manager->persist($user);

        $profile = new UserData();
        $profile->setEmail('root@localhost');
        $profile->setUser($user);
//        $manager-->persist($profile);

        $user->setProfile($profile);
        $manager->persist($user);
        $this->addReference('user', $user);
        $manager->flush();
    }

    private function LoadAlbums(ObjectManager $manager): void
    {
        for ($i=0; $i<21; $i++) {
//        $i = 1;
            $album = new Album();
            $album->setAlbumName('Test '.$i);
            $album->setAlbumDescription('description '.$i);
            $album->setAlbumCover('Depositphotos_101074730_xl-2015.jpg');
            $album->setUser($this->getReference('user'));
            $this->addReference('album'.$i, $album);
            $manager->persist($album);
        }
        $manager->flush();
    }

    private function LoadImages(ObjectManager $manager): void
    {
        for ($k=0; $k<21; $k++) {
            for($i=0; $i<21; $i++) {
                $image = new Image();
                $image->setImageFileName('images/uploads/Depositphotos_320511298_xl-2015.jpg');
                $image->setImageTitle('title'.$k*21+$i);
                $image->setImageDesc('image description '.$k*21+$i);
                $image->setAlbum($this->getReference('album'.$k));
                $manager->persist($image);
            }
        }
        $manager->flush();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
//        $this->LoadAlbums($manager);
//        $this->LoadImages($manager);
    }
}
