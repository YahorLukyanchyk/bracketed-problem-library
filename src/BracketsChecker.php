<?php

namespace BracketsChecker;

require 'vendor/autoload.php';

use Exception;

class BracketsChecker
{
    public static function index(string $input, string $filePath)
    {
        /* Check if input string contains ivalid values */
        if (preg_match('/^[() \n\t\r]*$/', $input) === 0) {
            throw new Exception("String contains invalid values.");
        }

        $input = preg_replace('/[^()]/', '', $input);

        $data = file_get_contents($filePath);

        /* Check if file was successfuly opened and path is correct */
        if (!$data) {
            throw new Exception("File not found.");
        }

        $data = preg_replace('/[^()]/', '', $data);

        if ($data === $input) {
            echo "Input row is correct.\n";
        }
        else {
            echo "Input row is incorrect, please check your values.\n";
        }
    }
}