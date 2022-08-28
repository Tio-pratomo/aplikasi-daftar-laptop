<?php
function convertionPrice(string $price): int
{
    $process1 = explode(".", $price);
    $process2 = implode($process1);
    return (int)$process2;
}
