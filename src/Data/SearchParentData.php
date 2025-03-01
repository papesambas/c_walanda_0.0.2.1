<?php

namespace App\Data;

use App\Validator\AtLeastOneField;
use Symfony\Component\Validator\Constraints as Assert;

//#[AtLeastOneField]
class SearchParentData
{
    public $page = 1;

    /**
     * Summary of q
     * @var string
     */
    #[Assert\Type('string')]
    public $qpere = '';

        /**
     * Summary of q
     * @var string
     */
    #[Assert\Type('string')]
    public $qmere = '';

    /**
     * Undocumented variable
     * @var string
     */
    #[Assert\Type('string')]
    public $telephonePere = '';

    /**
     * Undocumented variable
     *
     * @var string
     */
    #[Assert\Type('string')]
    public $ninaPere = '';

    #[Assert\Type('string')]
    public $telephoneMere = '';

    #[Assert\Type('string')]
    public $ninaMere = '';
}
