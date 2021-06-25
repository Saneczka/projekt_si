<?php

namespace App\EntityListener;

use App\Entity\Image;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Asset\Package;

class ImageListener
{
    private $image;

    public function __construct()
    {
    }

    public function preRemove(Image $image, LifecycleEventArgs $args)
    {
        $this->image = $args->getEntity();
        unlink("/home/epi/19_trapeznikova/gallery/public/".$this->image->getPrefixedImageFileName());
    }
}
