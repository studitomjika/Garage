<?php

namespace App\Controller\Admin;

use App\Entity\UsedCar;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class UsedCarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UsedCar::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        //yield IdField::new('id');
        yield TextField::new('model')
                        ->setLabel('Modéle');
        yield IntegerField::new('year')
                        ->setLabel('Année de mise en circulation');
        yield NumberField::new('price')
                        ->setLabel('Prix');
        yield IntegerField::new('kilometers')
                        ->setLabel('Kilometres');
        yield AssociationField::new('employee')
                        ->setLabel('Employé');
        yield ImageField::new('picture_filename')
                        ->setLabel('Photo')
                        ->setUploadDir('public/img/')
                        ->setFormTypeOptions(['attr' => [
                            'accept' => 'image/jpeg, image/png, image/gif'
                            ]
                        ])
                        ->setHelp('fichier jpeg/png/gif');
    }
}
