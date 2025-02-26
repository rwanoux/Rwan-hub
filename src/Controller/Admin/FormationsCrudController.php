<?php

namespace App\Controller\Admin;

use App\Entity\Formations;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formations::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            DateField::new('date')->setFormat('MM/yyyy'),
            TextEditorField::new('description'),
            VichImageField::new('imageFile')->onlyOnForms(),
            AssociationField::new('skill')->setSortProperty('name'),

        ];
    }
}