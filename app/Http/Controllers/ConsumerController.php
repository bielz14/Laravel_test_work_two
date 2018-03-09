<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;

class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->param === 'id') {
            $consumer = User::orderBy('consumerId', 'asc')->join('group', 'consumer.groupId', '=', 'group.groupId')->paginate(5);
            return view('welcome', compact('consumer'))->with('i', (request()->input('page', 1) - 1) * 5);
        }else if($request->param === 'login'){
            $consumer = User::orderBy('login', 'asc')->join('group', 'consumer.groupId', '=', 'group.groupId')->paginate(5);
            return view('welcome', compact('consumer'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }else if($request->param === 'email'){
            $consumer = User::orderBy('email', 'asc')->join('group', 'consumer.groupId', '=', 'group.groupId')->paginate(5);
            return view('welcome', compact('consumer'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }else if($request->param === 'group'){
            $consumer = User::orderBy('name', 'asc')->join('group', 'consumer.groupId', '=', 'group.groupId')->paginate(5);
            return view('welcome', compact('consumer'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }else{
            $consumer = User::join('group', 'consumer.groupId', '=', 'group.groupId')->paginate(5);
            return view('welcome', compact('consumer'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = Group::all();
        return view('consumer.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'login' => 'required|max:255|string|unique:consumer',
            'email' => 'required|max:255|email|unique:consumer',
            'groupId' => 'required',
            'password' => 'required|string|min:6',
            'password_confirmation'=>'required|string|same:password'
        ]);

        User::create( array(
                'login' => $request->input('login'),
                'email' => $request->input('email'),
                'groupId' => $request->input('groupId'),
                'password' => $request->input('password')
            )
        );

        return redirect()->route('home');
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
        $consumer = User::find($id);
        $group = Group::all();
        return view('consumer.edit',compact('consumer'), compact('group'));
    }

    /**
     * Show the form for changing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $consumer = User::find($id);
        $group = Group::all();
        return view('consumer.editpassword',compact('consumer'), compact('group'));
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
        $consumerSingleton = User::find($id);

        request()->validate([
            'login' => 'required|max:255|string|unique:consumer,login,' . $consumerSingleton->consumerId.',consumerId',
            'email' => 'required|max:255|email|unique:consumer,email,' . $consumerSingleton->consumerId.',consumerId',
            'groupId' => 'required'
        ]);
            User::find($id)->update($request->all());
            $request->session()->flash('success', 'Consumer edit successfully');
            return redirect()->route('home');
    }

    public function updatePassword(Request $request, $id)
    {
        request()->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation'=>'required|string|same:password'
        ]);

        if(md5($request->input('old_password')) !== \Auth::user()->password){
            $request->session()->flash('error', 'The specified password does not match the database password');
            return redirect()->route('home');
        }else{
            User::find($id)->update($request->all());
            $request->session()->flash('success', 'Password edit successfully');
            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if (isset($_POST['consumer_id'])) {

            $consumer_id = $_POST['consumer_id'];

            if (User::find($consumer_id)->delete() != 0) {
                return response(['msg' => 'Consumer deleted successfully']);
            }
        }

        return response(['msg' => 'Consumer deleted no successfully']);
    }
}
