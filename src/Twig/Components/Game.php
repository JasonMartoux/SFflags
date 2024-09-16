<?php

namespace App\Twig\Components;

use Symfony\Component\Intl\Countries;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Game
{
    use DefaultActionTrait;

    public array $countries;
    #[LiveProp]
    public array $possibleFlags;
    #[LiveProp]
    public string $correctFlag;

    public function __construct()
    {
        $this->countries = Countries::getNames();
        $this->getQuestion();
    }

    public function getQuestion()
    {
        $this->possibleFlags = array_rand($this->countries, 4);
        $this->correctFlag = $this->possibleFlags[array_rand($this->possibleFlags)];
    }
}
