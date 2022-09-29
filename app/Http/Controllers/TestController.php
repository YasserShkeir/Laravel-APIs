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
}
