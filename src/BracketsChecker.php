<?php

namespace BracketsChecker;

require 'vendor/autoload.php';

use Exception;
use BracketsChecker\Interfaces\BracketsCalculatorInterface;
use InvalidArgumentException;

class BracketsChecker implements BracketsCalculatorInterface
{
    public function check(string $inputData, string $filePath): bool
    {
        /* Check if input string contains ivalid values */
        if (preg_match('/^[() \n\t\r]*$/', $inputData) === 0) {
            throw new InvalidArgumentException("You can only use '(', ')', ' ', '\\n', '\\t' and '\\r', please check your input.\n");
        }

        $inputData = preg_replace('/[^()]/', '', $inputData);

        /* Get data from file */
        $fileData = file_get_contents($filePath);

        /* Check if file was successfuly opened and path is correct */
        if (!$fileData) {
            throw new Exception("File not found.");
        }

        $fileData = preg_replace('/[^()]/', '', $fileData);

        /* Calculate brackets for each data sources */
        $fileDataBracketsCount = [
            'openingBrackets' => substr_count($fileData, '('),
            'closingBrackets' => substr_count($fileData, ')')
        ];

        $inputDataBracketsCount = [
            'openingBrackets' => substr_count($inputData, '('),
            'closingBrackets' => substr_count($inputData, ')')
        ];

        /* Print counted brackets stats in the CLI */
        echo "Bracket Sequence from input:\n" .
            "Opening brackets - " . $inputDataBracketsCount['openingBrackets'] . "\n" .
            "Closing brackets - " . $inputDataBracketsCount['closingBrackets'] . "\n" .
            "Bracket Sequence from file:\n" .
            "Opening brackets - " . $fileDataBracketsCount['openingBrackets'] . "\n" .
            "Closing brackets - " . $fileDataBracketsCount['closingBrackets'] . "\n";

        /* Return False if the amount of brackets is not the same */
        if ($fileData !== $inputData) {
            return false;
        }

        return true;
    }
}