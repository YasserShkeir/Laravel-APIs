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

    function thirdAPI($string)
    {
        // I have 234 sheep 3333or 444
        // I have 1010101010 sheep 3333or 444 (far2a3)
        $answer = $string;
        for ($x = 0; $x < strlen($string); $x++) {
            if (is_numeric($string[$x])) {
                $str = $string[$x];
                while ($x < strlen($string) - 1 && is_numeric($string[$x + 1])) {
                    $str .= $string[$x + 1];
                    $x++;
                }

                // My father was born in 1974.10.25.
                // My father was born in 11110101101011010.10.25.

                $z = decbin($str);
                echo $str . " " . $z . "\n";
                $answer =  str_replace($str, $z, $answer);
            }
        }


        return response()->json(
            [
                "Original" => $string,
                "Res" => $answer
            ]
        );
    }

    // fourth api wowwo
    // + 5 4
    function fourthAPI($string)
    {
        $arr = explode(" ", $string);
        $res = 0;

        if ($arr[0] == "+") {
            $res = $arr[1] + $arr[2];
        }
        if ($arr[0] == "-") {
            $res = $arr[1] - $arr[2];
        }
        if ($arr[0] == "*") {
            $res = $arr[1] * $arr[2];
        }
        if ($arr[0] == "%") {
            $res = $arr[1] % $arr[2];
        }
        if ($arr[0] == "**") {
            $res = $arr[1] ** $arr[2];
        }

        return response()->json(
            [
                "Answer" => $res
            ]
        );
    }
}
