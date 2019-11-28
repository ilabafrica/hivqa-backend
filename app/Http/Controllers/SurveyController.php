<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Sdp;
use App\Facility;
use App\SurveyData;
use App\Checklist;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all surveys

        $surveys = Survey::all();

        return response()->json($surveys);
    }

    public function specific_checklist_survey($id)
    {
        //get htc surveys

        $surveys = Survey::where('checklist_id', $id)->get();

        foreach ($surveys as $key => $value) {
           $facility = Facility::where('id', $value->facility_id)->pluck('name')->toArray();
           $sdp = Sdp::find($value->sdp_id)->get()->pluck('name')->toArray();

           $value->facility_name = $facility[0];
           $value->sdp_name = $sdp[0];

        }
        return response()->json($surveys);
    }

    public function survey_data($survey_id){

        //get surveys
        $survey = Survey::find($survey_id);
        $survey_data = $survey->surveydata;

        //get questions
        $questions = Checklist::with('section.question.question_responses')->where('id', $survey->checklist_id)->get();
        // dd($questions);

        $response = [
            'survey' => $survey,
            'questions' => $questions
        ] ;

        return $response;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
