<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PerformanceTest;

class PerformanceController extends Controller
{
    protected PerformanceTest $performanceTest;

    public function __construct(PerformanceTest $performanceTest)
    {
        $this->performanceTest = $performanceTest;
    }

    public function index(){
        return view('performance');
    }

    public function testPerformance(Request $request)
    {
        try {
            $request->validate([
                'url' => 'required|url',
                'platform' => 'required|in:mobile,desktop',
            ]);

            $score = $this->performanceTest->getPerformanceScore($request->url, $request->platform);

            return response()->json([
                'score' => $score,
            ]);
            //code...
        } catch (\Exception $error) {
            return response()->json(['error' => $error]);
        }

    }
}
