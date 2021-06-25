<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }


    public function configureFields(string $pageName): iterable
    {
//        if (Crud::PAGE_INDEX === $pageName) {
//            return [
//                IntegerField::new('id', 'ID'),
//
//            ];
//        }
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('image_title'),
            TextEditorField::new('image_desc'),
            ImageField::new('imagefilename', 'image nfile')
              ->setBasePath('images/uploads')
              ->setUploadDir('public/images/uploads')
              ->setUploadedFileNamePattern('[randomhash].[extension]')
              ->setRequired(true),
            AssociationField::new('album'),
        ];
    }
}
