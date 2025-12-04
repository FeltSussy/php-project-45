<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function askQuestion(string $question): void
{
    line("{$question}");
}

function generateRand(int $count, array &$randArray): void
{
    for ($i = 0; $i < $count; $i++) {
        $randArray[] = rand(1, 100);
    }
}

function findNod(int $a, int $b): int
{
    if ($a === 0) {
        return $b;
    } elseif ($b === 0) {
        return $a;
    }

    while ($b !== 0) {
        $c = $a % $b;
        $a = $b;
        $b = $c;
    }
    return $a;
}

function evaluateAnswer(string $correctAnswer, string $answer, string $playerName, int &$totalCorrectAnswers): void
{
    if ($correctAnswer !== $answer) {
        line("Answer '{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
        line("Let's try again, {$playerName}!");
        exit;
    } else {
        line("Correct!");
        $totalCorrectAnswers++;
    }

    if ($totalCorrectAnswers === 3) {
        line("Congratulations, {$playerName}!");
    }
}

function generateProgressionElement(int $start, int $index, int $step): int
{
    return $start + $index * $step;
}

function checkPrime(int $number): bool
{
    if ($number < 2 || $number % 2 === 0 || $number % 3 === 0) {
        return false;
    }
    if ($number === 2 || $number === 3) {
        return true;
    }
    $max = (int) sqrt($number);
    for ($i = 5; $i <= $max; $i += 2) {
        if ($number % $i === 0) {
            return false;
        }
    }
    return true;
}

function run(string $gameName, string $playerName): void
{
    switch ($gameName) {
        case "brain-even":
            $totalCorrectAnswers = 0;
            while ($totalCorrectAnswers < 3) {
                $randomNumber = rand(1, 100);
                line("Question: {$randomNumber}");
                $answer = prompt("Your answer");
                $correctAnswer = ($randomNumber % 2 === 0) ? 'yes' : 'no';
                evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
            }
            break;
        case "brain-calc":
            $totalCorrectAnswers = 0;
            while ($totalCorrectAnswers < 3) {
                $randArray = [];
                generateRand(2, $randArray);
                [$num1, $num2] = $randArray;
                $operations = ['+', '-', '*'];
                $operation = $operations[array_rand($operations)];
                line("Question: {$num1} {$operation} {$num2}");
                $answer = prompt("Your answer");
                $correctAnswer = match ($operation) {
                    '+' => (string) ($num1 + $num2),
                    '-' => (string) ($num1 - $num2),
                    '*' => (string) ($num1 * $num2),
                };
                evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
            }
            break;
        case "brain-gcd":
            $totalCorrectAnswers = 0;
            while ($totalCorrectAnswers < 3) {
                $randArray = [];
                generateRand(2, $randArray);
                [$a, $b] = $randArray;
                line("Question: {$a} {$b}");
                $answer = prompt("Your answer");
                $correctAnswer = (string) findNod($a, $b);
                evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
            }
            break;
        case "brain-progression":
            $totalCorrectAnswers = 0;
            while ($totalCorrectAnswers < 3) {
                $progression = [];
                $start = rand(1, 20);
                $step = rand(1, 10);
                $count = rand(5, 10);
                for ($i = 0; $i < $count; $i++) {
                    $progression[] = generateProgressionElement($start, $i, $step);
                }
                $indexOfHiddenElement = rand(0, $count - 1);
                $hiddenElement = $progression[$indexOfHiddenElement];
                $progression[$indexOfHiddenElement] = '..';
                $showProgression = implode(' ', $progression);
                line("Question: {$showProgression}");
                $answer = prompt("Your answer");
                $correctAnswer = (string) $hiddenElement;
                evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
            }
            break;
        case "brain-prime":
            $totalCorrectAnswers = 0;
            while ($totalCorrectAnswers < 3) {
                $number = rand(1, 100);
                line("Question: {$number}");
                $answer = prompt("Your answer");
                $correctAnswer = match (checkPrime($number)) {
                    true => 'yes',
                    false => 'no',
                };
                evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
            }
            break;
    }
}
