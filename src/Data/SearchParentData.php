<?php

namespace App\Data;

use App\Validator\AtLeastOneField;
use Symfony\Component\Validator\Constraints as Assert;

//#[AtLeastOneField]
class SearchParentData
{
    public $page = 1;

    #[Assert\Type('string')]
    public $telephonePere = '';

    #[Assert\Type('string')]
    public $ninaPere = '';

    #[Assert\Type('string')]
    public $telephoneMere = '';

    #[Assert\Type('string')]
    public $ninaMere = '';
}
