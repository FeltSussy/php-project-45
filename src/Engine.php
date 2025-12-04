<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

define('ANSWER_PROMPT', "Your answer");
function askQuestion(string $question): void
{
    line("{$question}");
}

function generateRand(int $count, array &$targetArray): void
{
    for ($i = 0; $i < $count; $i++) {
        $targetArray[] = random_int(1, 100);
    }
}

function findNod(int $firstNumber, int $secondNumber): int
{
    if ($firstNumber === 0) {
        return $secondNumber;
    } elseif ($secondNumber === 0) {
        return $firstNumber;
    }

    while ($secondNumber !== 0) {
        $tempVariable = $firstNumber % $secondNumber;
        $firstNumber = $secondNumber;
        $secondNumber = $tempVariable;
    }
    return $firstNumber;
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
    $result = false;
    if ($number < 2 || $number % 2 === 0 || $number % 3 === 0) {
        $result = false;
    }
    if ($number === 2 || $number === 3) {
        $result = true;
    }
    $numberSquareRoot = (int) sqrt($number);
    for ($i = 5; $i <= $numberSquareRoot; $i += 2) {
        if ($number % $i === 0) {
            $result = false;
        }
    }
    return $result;
}

function runBrainEven(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $randomNumber = random_int(1, 100);
        line("Question: {$randomNumber}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = ($randomNumber % 2 === 0) ? 'yes' : 'no';
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}

function runBrainCalc(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $numbers = [];
        generateRand(2, $numbers);
        [$num1, $num2] = $numbers;
        $operations = ['+', '-', '*'];
        $operation = $operations[array_rand($operations)];
        line("Question: {$num1} {$operation} {$num2}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = match ($operation) {
            '+' => (string) ($num1 + $num2),
            '-' => (string) ($num1 - $num2),
            '*' => (string) ($num1 * $num2),
        };
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}

function runBrainGcd(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $numbers = [];
        generateRand(2, $numbers);
        [$num1, $num2] = $numbers;
        line("Question: {$num1} {$num2}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = (string) findNod($num1, $num2);
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}

function runBrainProgression(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $progression = [];
        $start = random_int(1, 20);
        $step = random_int(1, 10);
        $count = random_int(5, 10);
        for ($i = 0; $i < $count; $i++) {
            $progression[] = generateProgressionElement($start, $i, $step);
        }
        $indexOfHiddenElement = random_int(0, $count - 1);
        $hiddenElement = $progression[$indexOfHiddenElement];
        $progression[$indexOfHiddenElement] = '..';
        $shownProgression = implode(' ', $progression);
        line("Question: {$shownProgression}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = (string) $hiddenElement;
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}

function runBrainPrime(string $playerName): void
{
    $totalCorrectAnswers = 0;
    while ($totalCorrectAnswers < 3) {
        $number = random_int(1, 100);
        line("Question: {$number}");
        $answer = prompt(ANSWER_PROMPT);
        $correctAnswer = match (checkPrime($number)) {
            true => 'yes',
            false => 'no',
        };
        evaluateAnswer($correctAnswer, $answer, $playerName, $totalCorrectAnswers);
    }
}
