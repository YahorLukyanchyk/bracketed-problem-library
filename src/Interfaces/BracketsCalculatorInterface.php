<?php

namespace BracketsChecker\Interfaces;

interface BracketsCalculatorInterface {
    public function check(string $bracketSequence, string $filePath): bool;
}