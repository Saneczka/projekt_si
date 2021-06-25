<?php

namespace App\Controller\Admin;

use App\Entity\UserData;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserDataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserData::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
