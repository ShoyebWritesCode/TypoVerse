<?php

namespace App\Livewire;

use Livewire\Component;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TypingTest extends Component
{
    public $words = [];
    public $input = '';
    public $startTime;
    public $endTime;
    public $wpm = 0;
    public $wordCount = 0;
    public $totalInputLength = 0;
    public $totalGreenLength = 0;
    public $accuracy = 0;
    public $timer = 100;
    public $testStarted = false;
    public $testEnded = false;

    public function startTest()
    {
        $this->generateWords();
        $this->startTime = Carbon::now();
        $this->testStarted = true;
        $this->testEnded = false;
    }

    public function generateWords()
    {
        $faker = Faker::create();
        $texts = explode(' ', $faker->text(300));
        $words = [];

        foreach ($texts as $text) {
            $word = strtolower(substr($text, 0, 1)) . substr($text, 1);
            $words[] = $word;
        }

        $this->words = $words;
    }

    public function updatedInput()
    {
        if ($this->testStarted && !$this->testEnded && trim($this->input) === implode(' ', $this->words)) {
            $this->endTest();
        }
    }

    public function endTest()
    {
        $this->endTime = Carbon::now();
        $this->calculateAccuracy();
        $this->calculatewpm();
        $this->testEnded = true;
    }

    public function calculateAccuracy()
    {

        if ($this->totalInputLength == 0) {
            $this->accuracy = 0;
        } else {
            $this->accuracy = ($this->totalGreenLength / $this->totalInputLength) * 100;
        }
    }

    public function calculatewpm()
    {
        if ($this->wordCount == 0) {
            $this->wpm = 0;
        } else {
            $this->wpm = ($this->wordCount / 50) * 60;
        }
    }

    public function render()
    {
        return view('livewire.typing-test');
    }
}
