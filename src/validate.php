<?php
declare(strict_types=1);

function validate_required(string $v): bool
{
    return trim($v) !== '';
}


function validate_email(string $v): bool
{
    return preg_match('/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)+$/', $v) === 1;
}

function validate_length(string $v, int $min, int $max): bool
{
    $len = mb_strlen($v);
    return $len >= $min && $len <= $max;
}
