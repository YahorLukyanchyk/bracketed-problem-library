<?php

namespace BracketsChecker;

require 'vendor/autoload.php';

use Exception;

class BracketsChecker
{
    public static function index(string $input, string $filePath)
    {
        $data = file_get_contents($filePath);
        $data = preg_replace('/[^()]/', '', $data);

        if (preg_match('/^[() \n\t\r]*$/', $input) === 0) {
            throw new Exception("String contains invalid values.");
        }

        $input = preg_replace('/[^()]/', '', $input);

        if ($data === $input) {
            echo 'Input row is correct.';
        }
        else {
            echo 'Input row is incorrect, please check your values.';
        }
    }
}