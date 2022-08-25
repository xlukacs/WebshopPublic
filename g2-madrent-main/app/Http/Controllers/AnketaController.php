<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnketaController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('admin');
        // add redirectifauthenticated middleware
    }

    public function submit(Request $request){
        dd($request);

        return redirect()->back();
    }

    public function view(){
        $anketaList = DB::table('question')->select('id', 'question_text', 'date_from')->orderBy('date_from','ASC')->get();
        //dd($anketaList);

        return view('anketa.manager', compact('anketaList'));
    }

    public function add(){
        return view('anketa.add');
    }

    public function insert(Request $request){
        DB::table('question')->insert(['question_text'=> $request->question, 'date_from' => $request->from, 'date_to' => $request->to]);

        return  redirect('/anketaManager');
    }

    public function remove(Request $request){
        DB::table('question')->where('id','=',$request->questionID)->delete();
        DB::table('answer')->where('question_id','=',$request->questionID)->delete();
        DB::table('voting')->join('answer', 'voting.answer_id','=','answer.id')->where('answer_id','=',$request->questionID)->delete();


        return  redirect('/anketaManager');
    }

    public function show(Request $request){
        $answers = DB::table('answer')->where('question_id','=',$request->questionID)->select('answer_text')->get();
        

        return view('anketa.results', compact('answers'));
    }

    public function viewEdit(Request $request){
        $answers = DB::table('answer')->where('question_id','=',$request->questionID)->select('id', 'answer_text')->get();
        $questionID = $request->questionID;

        return view('anketa.edit', compact('answers', 'questionID'));
    }

    public function saveAnswer(Request $request){
        DB::table('answer')->where('id','=',$request->answerID)->update(['answer_text' => $request->answerText]);

        return  redirect('/anketaManager');
    }

    public function addAnswerPage(Request $request){
        $questionID = $request->questionID;

        return view('anketa.addAnswer', compact('questionID'));
    }

    public function insertAnswer(Request $request){
        DB::table('answer')->insert(['answer_text'=> $request->newAnswerName, 'question_id' => $request->questionID]);

        return  redirect('/anketaManager');
    }
}
