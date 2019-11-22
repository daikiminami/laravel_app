<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;

class TodoController extends Controller
{
    private $todo;
    public function __construct(Todo $instanceClass)     
    {
        // $instanceClassにはfillableにtitle,user_idが配列として入っている。
        // dd($instanceClass);
        // dd($this->middleware('auth'));
        $this->middleware('auth'); //この一行でTodo一覧が表示されなくなる。
        // dd($this->middleware('auth'));//controllerMiddlewareOptionsインスタンスが返る。
        $this->todo = $instanceClass;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $todos = $this->todo->all();                   //DBからの全件取得
        $todos = $this->todo->getByUserId(Auth::id());
        // dd($todos);
        // dd(compact('todos'));
        // return view('todo.index', $todos);
        return view('todo.index', compact('todos'));   //取得データをviewに渡す。
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(view('todo.create'));
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$request ParameterBag parametersにtoken,titleの値が入っている。
        // dd($request);
        $input = $request->all();           //file上部にあるuse illuminate\Http\Request;のRequestを使用
        // $input = $request->input();　　　　　結果変わらない。
        // dd($input);                         //配列としていくつか入っている。
        $input['user_id'] = Auth::id();     //file上部にあるuse AuthによりloginしているuserをAuth::idという形で取得。
        // dd($this->todo->fill($input));
        $this->todo->fill($input)->save();  //Formタグで送信したPOST情報を取得可能。一致している場合fill関数でattributeにそのキー値が入る。
        // dd(redirect(),redirect()->to('todo'));
        return redirect()->to('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $todo = $this->todo->find($id);
        // dd($todo);
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->all();
        // dd($this->todo->find($id)->fill($input));
        $this->todo->find($id)->fill($input)->save();
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($this->todo);
        $this->todo->find($id)->delete();
        // dd($this->todo->find($id)->delete());
        return redirect()->to('todo');
    }
}
