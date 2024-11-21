<?php

namespace BracketsChecker\Interfaces;

interface BracketsCalculatorInterface {
    public function check(string $bracketSequence): bool;
}