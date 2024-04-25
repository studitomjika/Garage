<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        //yield IdField::new('id');
        yield TextField::new('name')
                            ->setLabel('Nom');
        yield IntegerField::new('grade')
                            ->setLabel('Note');
        yield TextareaField::new('message');
        yield BooleanField::new('accepted')
                            ->setLabel('Accepté');
        yield AssociationField::new('employee')
                            ->setLabel('Employé');;
    }
}
