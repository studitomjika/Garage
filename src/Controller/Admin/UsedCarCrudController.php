<?php

namespace App\Controller\Admin;

use App\Entity\UsedCar;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class UsedCarCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UsedCar::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('used_car'))
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        //yield IdField::new('id');
        yield TextField::new('model');
        yield IntegerField::new('year');
        yield NumberField::new('price');
        yield IntegerField::new('kilometers');
        yield AssociationField::new('employee');
    }
}
