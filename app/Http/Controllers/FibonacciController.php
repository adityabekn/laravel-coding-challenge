<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FibonacciController extends Controller
{
    public function index() {
        $request = null;
        return view("fibonacci")->with("request", $request);
    }

    public function store(Request $request) {
        $length = $request->rows * $request->columns;

        if ($length<1 || $request->rows < 1 || $request->columns < 1) {
            return back()->withErrors(['status' => 'Galat! Masukkan angka positif'])->withInput();
        }

        $num0 = 0;
        $num1 = 1;

        $index = array();

        for ($i = 1; $i <= $length; $i++) {
            if ($i == 1) {
                $index[] = $num0;
            }

            if ($i == 2) {
                $index[] = $num1;
            }

            if ($i > 2) {
                $num3 = $num0 + $num1;

                $num0 = $num1;
                $num1 = $num3;

                $index[] = $num3;
            }
        }

        return view("fibonacci")->with("request", $request)->with("index", $index)->with("length", $length);
    }
}
