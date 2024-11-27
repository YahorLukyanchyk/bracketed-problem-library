<?php

namespace BracketsChecker;

require 'vendor/autoload.php';

use BracketsChecker\Interfaces\BracketsCalculatorInterface;
use InvalidArgumentException;

class BracketsChecker implements BracketsCalculatorInterface
{
    
    public function check(string $inputData): bool
    {
        /* Check if input string contains ivalid values */
        if (preg_match('/^[() \n\t\r]*$/', $inputData) === 0) {
            throw new InvalidArgumentException("You can only use '(', ')', ' ', '\\n', '\\t' and '\\r', please check your input.\n");
        }

        $inputData = preg_replace('/[^()]/', '', $inputData);

        if ((substr_count($inputData, "(") !== substr_count($inputData, ")")) or !$this->isValidBrackets($inputData)) {
            return false;
        }

        return true;
    }

    /* Check if brackets have valid subsequence */
    private function isValidBrackets(string $bracketsSequence): bool {
        $stack = [];

        foreach (str_split($bracketsSequence) as $char) {
            if ($char === '(') {
                array_push($stack, $char);
            } elseif ($char === ')') {
                if (empty($stack)) {
                    return false;
                }
                array_pop($stack);
            }
        }
        
        return empty($stack);
    }
}