<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class MessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        //yield IdField::new('id');
        yield TextField::new('name')
                        ->setLabel('Nom');
        yield EmailField::new('email');
        yield TextField::new('phone_number')
                        ->setLabel('Télephone');
        yield TextField::new('subject')
                        ->setLabel('Sujet');
        yield TextField::new('message');
    }
}
