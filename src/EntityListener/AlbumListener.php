<?php

namespace App\EntityListener;

use App\Entity\Album;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Asset\Package;

class AlbumListener
{
    private $album;

    public function __construct()
    {
    }

    public function preRemove(Album $album, LifecycleEventArgs $args)
    {
        $this->album = $args->getEntity();
        unlink("/home/epi/19_trapeznikova/gallery/public/".$this->album->getPrefixedCoverFileName());
    }
}
