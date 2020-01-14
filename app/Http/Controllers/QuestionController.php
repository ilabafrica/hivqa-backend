<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Section;
use App\Question;
use App\Survey;
use App\SurveyData;
use Illuminate\Http\Request;
use DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Checklist::with('section.question')->get();
        
        return response()->json($questions);

    }

    /**
     * Display a all questions in a checklist.
     *
     * @return \Illuminate\Http\Response
     */
    public function question_per_checklist($id, $facility, $sdp)
    {
        $questions = Checklist::with('section.question.question_responses')->where('id', $id)->get();
        foreach ($questions as $key => $value) {
            $checklist_name = $value->name;
            $checklist_id = $value->id;
        }

        $response = ['data' =>$questions, 'checklist_name' =>$checklist_name, 'facility' =>$facility, 'sdp'=>$sdp ];
        
        return response()->json($response);

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

        $survey = new Survey;
        $survey->checklist_id = 1;
        // $survey->qa_officer = Auth::user()->id;
        $survey->qa_officer = 'Ann';
        $survey->facility_id = 2;
        $survey->sdp_id = 2;
        // $survey->comment = $request->overall_comments;
        // $survey->date_started = $request->date_started;
        // $survey->date_ended = $request->date_ended;
        // $survey->date_submitted = $request->date_submitted;
        $survey->save();

        //  Proceed to form-fields
        // get all fields and insert into survey_answers

        $questions =DB::table('questions')
                    ->join('sections', 'questions.section_id', '=', 'sections.id')
                    ->join('checklists', 'sections.checklist_id', '=', 'checklists.id')
                    ->where('checklists.id', '=', '1')
                    ->get(array('questions.name','questions.id'));

        $response = '';
        
        foreach ($questions as $question) {
            $survey_answers = new SurveyData;
            $survey_answers->survey_id = $survey->id;
            $survey_answers->question_id = $question->id;
           
           // //loop through the results entered and get the response for each questions
            foreach ($request->all() as $key => $value)
            {
                if ($question->id == $key) {
                    $response = $value  ;
                    break;
                }else if ($question->id != $key) {
                    $response = '';
                }   
           } 
            // save the response for respective question
            $survey_answers->response = $response;
            $survey_answers->save();
        }

        return response()->json('Done');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
