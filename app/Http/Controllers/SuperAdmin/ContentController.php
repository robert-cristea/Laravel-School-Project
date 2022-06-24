<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Model\BreathingTool;
use App\Model\Challenge;
use App\Model\GuidedTool;
use App\Model\Lessons;
use App\Model\MindfulnessTool;
use App\Model\Quotes;
use App\Model\SelfHypTool;
use App\Model\Series;
use App\Model\Tools;
use App\User;
use DB;

class ContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $series = Series::orderby('display_order')->get();
        $lessons = Lessons::orderby('order_number')->get();
        $quotes = Quotes::all();
        $tools = Tools::all();
        $breathingTools = BreathingTool::all();
        $mindfulnessTools = MindfulnessTool::all();
        $guidedTools = GuidedTool::all();
        $selfhypTools = SelfHypTool::all();
        $mindfulnessCategories = DB::table('vieva_mindfulness_categories')->get();
        $quotes_en = count(Quotes::whereLanguage(1)->get());
        $quotes_fr = count(Quotes::whereLanguage(0)->get());
        $coaches = User::where('user_level', 6)->get();
        $challenges = Challenge::all();

        return view('backend.superadmin.content', compact(
            'series',
            'lessons',
            'quotes',
            'tools',
            'quotes_en',
            'quotes_fr',
            'challenges',
            'coaches',
            'breathingTools',
            'guidedTools',
            'selfhypTools',
            'mindfulnessTools',
            'mindfulnessCategories',
        ));
    }

}
