<?php

namespace App\Twig\Components;

use Symfony\Component\Intl\Countries;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
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

  #[LiveProp]
  public int $score = 0;
  #[LiveProp]
  public int $questions = 0;

  public function __construct()
  {
    $this->countries = Countries::getNames();
    $this->getQuestion();
  }

  public function getQuestion(): void
  {
    $this->possibleFlags = array_rand($this->countries, 4);
    $this->correctFlag = $this->possibleFlags[array_rand($this->possibleFlags)];
  }

  #[LiveAction]
  public function check(#[LiveArg] string $flag): void
  {
    if ($flag === $this->correctFlag) {
      $this->score++;
    }
    $this->questions++;
  }
}
