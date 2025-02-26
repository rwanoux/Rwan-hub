<?php

namespace App\Controller\Admin;

use App\Entity\Employeurs;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class EmployeursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employeurs::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            UrlField::new('website'),
            TextEditorField::new('description'),
            VichImageField::new('imageFile')->onlyOnForms(),
            BooleanField::new('favorite'),

        ];
    }
}