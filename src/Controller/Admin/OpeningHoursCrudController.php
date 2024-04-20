<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHours;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class OpeningHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHours::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        //yield IdField::new('id');
        yield TextField::new('day');
        yield TextField::new('hours');
    }
}
