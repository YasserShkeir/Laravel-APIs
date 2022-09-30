<?php

namespace App\Http\Controllers;

use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;

class TestController extends Controller
{
    // First API
    function firstAPI($string)
    {
        // Store the sorting algo logic in a single string
        $strSorter = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789';

        // Result is initially empty
        $strRes = '';

        // Loop through the logic string and the given string
        for ($x = 0; $x < strlen($strSorter); $x++) {
            for ($y = 0; $y < strlen($string); $y++) {
                // If we match based on the logic string, we add the char
                if ($strSorter[$x] == $string[$y]) {
                    $strRes .= $string[$y];
                }
            }
        }

        // Return response JSON
        return response()->json(
            [
                "Sorted" => $strRes
            ]
        );
    }

    // Second API
    function secondAPI($num)
    {
        // Retrieve the length of the string given
        $numlength = strlen((string)$num);

        // Create an empty array with a length equal to above
        $resArray = array_fill(0, $numlength, 0);

        // Loop through the array and fill it
        for ($x = $numlength; $x > 0; $x--) {
            if ($x > 1) {
                $resArray[$numlength - $x] = ($num % (10 ** ($x))) - ($num % (10 ** ($x - 1)));
            } else {
                $resArray[$numlength - $x] = ($num % (10 ** ($x)));
            }
        }

        // If original number is less than zero, first index will be zero, annihilate it
        if ($num < 0) {
            $resArray = array_slice($resArray, 1, $numlength);
        }

        // Return JSON response
        return response()->json(
            [
                "Len" => $resArray
            ]
        );
    }

    // Third API
    function thirdAPI($string)
    {
        $answer = $string;
        $arrSize = 0;
        for ($x = 0; $x < strlen($string); $x++) {
            if (is_numeric($string[$x])) {
                $initIndex = $x;
                while ($x < strlen($string) - 1 && is_numeric($string[$x + 1])) {
                    $x++;
                }
                $arrSize++;
            }
        }
        echo "ARR SIZE" . $arrSize;
        $resArray = array_fill(0, $arrSize, [0, 0]);

        $test = "123 123 123";
        $test2 = "sssss";
        $test[3] = $test[3] . $test2;

        for ($x = 0; $x < strlen($string); $x++) {
            if (is_numeric($string[$x])) {
                $str = $string[$x];
                $initIndex = $x;
                while ($x < strlen($string) - 1 && is_numeric($string[$x + 1])) {
                    $str .= $string[$x + 1];
                    $x++;
                }

                // My father was born in 1974.10.25.
                // My father was born in 11110101101011010.10.25.

                $z = decbin($str);
                echo "\n" . $str . " " . $z . "\n";
                $answer =  substr_replace($str, $z, 0, $x - $initIndex + 1);
                echo $answer;
                // $answer =  str_replace($str, $z, $answer);
            }
        }


        return response()->json(
            [
                "Original" => $string,
                "Res" => $answer,
                "ARR FADE" => $resArray
            ]
        );
    }

    // Fourth API
    function fourthAPI($string)
    {
        // Separate every character and store in an array
        $arr = explode(" ", $string);

        // Result answer is initially zero
        $res = 0;

        // A function to check if a character is an operand or not
        function isOperand($char)
        {
            if ($char == "+" || $char == "-" || $char == "*" || $char == "%" || $char == "**") {
                return true;
            }
            return false;
        }

        // A function to calculate the two numbers following the operand
        function operandCalculator($arr, $index)
        {
            if ($arr[$index] == "+") {
                return $arr[$index + 1] + $arr[$index + 2];
            }
            if ($arr[$index] == "-") {
                return $arr[$index + 1] - $arr[$index + 2];
            }
            if ($arr[$index] == "*") {
                return $arr[$index + 1] * $arr[$index + 2];
            }
            if ($arr[$index] == "%") {
                return $arr[$index + 1] % $arr[$index + 2];
            }
            if ($arr[$index] == "**") {
                return $arr[$index + 1] ** $arr[$index + 2];
            }
        }

        // Loop through all the characters and whenever we get an operand, we operate :p
        for ($x = 0; $x < count($arr); $x++) {
            if (isOperand($arr[$x])) {
                $res += operandCalculator($arr, $x);
            }
        }

        // Return response as JSON
        return response()->json(
            [
                "Answer" => $res
            ]
        );
    }
}
