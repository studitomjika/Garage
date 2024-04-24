<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Repository\UsedCarRepository;

#[AsLiveComponent('usedcar_filter')]
class UsedCarsFilterComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(
        private UsedCarRepository $usedCarRepository
    ) {
    }

    public function getUsedCarsFiltered(): array
    {
        return $this->usedCarRepository->findByQuery($this->query);
        /* $used_cars = $usedCarRepository->findAll();
        dd($used_cars); */
        /* return rand(0, 1000); */
    }
}