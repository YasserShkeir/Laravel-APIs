<?php

namespace App\Http\Controllers;

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
                "Sorted" => $string,
                "Test" => $strRes
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

        return response()->json(
            [
                "Len" => $string
            ]
        );
    }
}
