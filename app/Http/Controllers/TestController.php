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

    // // Third API (If this still doesn't work pls use next one :3 )
    // function thirdAPI($string)
    // {
    //     $answer = $string;
    //     for ($x = 0; $x < strlen($string); $x++) {
    //         if (is_numeric($string[$x])) {
    //             $str = $string[$x];
    //             while ($x < strlen($string) - 1 && is_numeric($string[$x + 1])) {
    //                 $str .= $string[$x + 1];
    //                 $x++;
    //             }

    //             $strRight = substr($answer, $x + 1, strlen($answer));

    //             echo "strRight: " . $strRight . "\n" . "answer: " . $answer . "\n" . "str: " . $str . "\n";

    //             $z = decbin($str);

    //             $answer =  str_replace($str, $z, $answer);
    //             echo "str: " . $str . "\n" . "z: " . $z . "\n";
    //         }
    //     }


    //     return response()->json(
    //         [
    //             "Original" => $string,
    //             "Res" => $answer
    //         ]
    //     );
    // }


    // This is working for some reason, I know there's an easier way...
    // Couldn't finish it but I was really close :<
    function thirdAPItest($string)
    {
        $answer = $string;

        // echo $answer . "\n";

        $arr = str_split($answer);
        // Store all ending indexes for numbers
        $splicers = [];

        // Stores additional length for numbers; ex. 1974: we replace 1 with the binary value of 1974,
        // 974 are the extra numbers we wont need, so 3 numbers, so returns 3 at first index
        $splicerRepeat = [];

        for ($x = 0; $x < count($arr); $x++) {
            $startIndex = $x;
            $endingIndex = $x;
            if (is_numeric($arr[$x])) {
                $str = $arr[$x];
                while ($x < count($arr) - 1 && is_numeric($arr[$x + 1])) {
                    $str .= $arr[$x + 1];
                    $x++;
                }
                $endingIndex = $x;
                array_push($splicers, $endingIndex);
                array_push($splicerRepeat, ($endingIndex - $startIndex));

                // echo "answer: " . $answer . "\n str: " . $str . "\n start " . $startIndex . "\n end " . $endingIndex . "\n";

                $z = decbin($str);

                $arr[$startIndex] = $z;
            }
        }

        for ($x = 0; $x < count($splicers); $x++) {
            for ($y = $splicers[$x] - (int)$splicerRepeat[$x] + 1; $y < $splicers[$x]; $y++) {
                // echo $y . " ";
                array_splice($arr, $y, 1);
            }
        }

        $exampleRes = "";
        for ($x = 0; $x < count($arr); $x++) {
            $exampleRes .= $arr[$x];
        }

        return response()->json(
            [
                "Original" => $answer,
                // "splicers" => $splicers,
                // "SplicersRepeat" => $splicerRepeat,
                "Answer" => $exampleRes
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
