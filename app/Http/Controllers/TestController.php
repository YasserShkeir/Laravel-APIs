<?php

namespace App\Http\Controllers;

use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;

class TestController extends Controller
{
    function getUsers()
    {
        return "hi controller";
    }

    function sayHi($name = "Laravel")
    {
        $message = "HI $name";

        return response()->json(
            [
                "status" => "Succes",
                "message" => $message
            ]
        );
    }

    function addUser(Request $request)
    {
        $name = $request->name;
        $age = $request->age;

        return response()->json(
            [
                "status" => "success",
                "message" => $age
            ]
        );
    }

    /* So easy Charbel I'm disappointed... */
    function firstAPI($string)
    {
        $strSorter = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789';
        $strRes = '';

        for ($x = 0; $x < strlen($strSorter); $x++) {
            for ($y = 0; $y < strlen($string); $y++) {
                if ($strSorter[$x] == $string[$y]) {
                    $strRes .= $string[$y];
                }
            }
        }

        return response()->json(
            [
                "Sorted" => $strRes
            ]
        );
    }

    /* ZzZzZz */
    function secondAPI($num)
    {

        $numlength = strlen((string)$num);
        $resArray = array_fill(0, $numlength, 0);

        for ($x = $numlength; $x > 0; $x--) {
            if ($x > 1) {
                $resArray[$numlength - $x] = ($num % (10 ** ($x))) - ($num % (10 ** ($x - 1)));
            } else {
                $resArray[$numlength - $x] = ($num % (10 ** ($x)));
            }
        }

        if ($num < 0) {
            $resArray = array_slice($resArray, 1, $numlength);
        }

        return response()->json(
            [
                "Len" => $resArray
            ]
        );
    }

    // 3rd api nice
    function thirdAPI($string)
    {
        // I have 234 sheep 3333or 444
        // I have 1010101010 sheep 3333or 444 (far2a3)
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

    // fourth api wowwo
    // + 5 4
    function fourthAPI($string)
    {
        $arr = explode(" ", $string);
        $res = 0;

        function isOperand($char)
        {
            if ($char == "+" || $char == "-" || $char == "*" || $char == "%" || $char == "**") {
                return true;
            }
            return false;
        }

        function operandCalculator($arr, $index)
        {
            if ($arr[$index] == "+") {
                return $res = $arr[$index + 1] + $arr[$index + 2];
            }
            if ($arr[$index] == "-") {
                return $res = $arr[$index + 1] - $arr[$index + 2];
            }
            if ($arr[$index] == "*") {
                return $res = $arr[$index + 1] * $arr[$index + 2];
            }
            if ($arr[$index] == "%") {
                return $res = $arr[$index + 1] % $arr[$index + 2];
            }
            if ($arr[$index] == "**") {
                return $res = $arr[$index + 1] ** $arr[$index + 2];
            }
        }

        for ($x = 0; $x < count($arr); $x++) {
            if (isOperand($arr[$x])) {
                $res += operandCalculator($arr, $x);
            }
        }



        return response()->json(
            [
                "Answer" => $res
            ]
        );
    }
}
