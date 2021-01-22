<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    
    // 学生データのダッシュボード一覧表示
    public function index()
    {
        $students = Student::orderBy('created_at', 'asc')->paginate(10);
        $auths    = Auth::user();
            return view('students', [
                'students' => $students,
                'auths' => $auths
            ]);
    }
    

    //新規登録処理
    public function store(Request $request) {
        //バリデーション
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|max:255',
        'user_number' => 'required|max:255',
        'user_name' => 'required|max:255',
        'user_birth' => 'max:255',
        'user_sex' => 'max:255',
        'user_ntl' => 'max:255',
        'user_address' => 'max:255',
        'user_status' => 'max:255',
        'user_work' => 'max:255',
        'user_period' => 'max:255',
        'user_tel' => 'max:255',
        'user_email' => 'max:255',
        'user_msg' => 'max:255',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
       //以下に登録処理を記述（Eloquentモデル）
       // Eloquent モデル
        $students = new Student;
        $students->user_id = Auth::user()->id;
        $students->user_number = $request->user_number;
        $students->user_name= $request->user_name;
        $students->user_birth = $request->user_birth;
        $students->user_sex = $request->user_sex;
        $students->user_ntl = $request->user_ntl;
        $students->user_address = $request->user_address;
        $students->user_status = $request->user_status;
        $students->user_work = $request->user_work;
        $students->user_period = $request->user_period;
        $students->user_tel = $request->user_tel;
        $students->user_email = $request->user_email;
        $students->user_msg = $request->user_msg;
        // $students->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $students->save();
        return redirect('/');
    }
    
    
    
    
    
    
    
    
    //更新
    public function update(Request $request) {
    //バリデーション
    $validator = Validator::make($request->all(), [
        'user_id'     => 'required|max:255',
        'user_number' => 'required|max:255',
        'user_name' => 'required|max:255',
        'user_birth' => 'max:255',
        'user_sex' => 'max:255',
        'user_ntl' => 'max:255',
        'user_address' => 'max:255',
        'user_status' => 'max:255',
        'user_work' => 'max:255',
        'user_period' => 'max:255',
        'user_tel' => 'max:255',
        'user_email' => 'max:255',
        'user_msg' => 'max:255',
    ]);
    
//     //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
//     //以下に更新処理を記述（Eloquentモデル）
//     // Eloquent モデル
        $students = Student::where('user_id', Auth::user()->id)->find($request->id);
        $students->user_number = $request->user_number;
        $students->user_name= $request->user_name;
        $students->user_birth = $request->user_birth;
        $students->user_sex = $request->user_sex;
        $students->user_ntl = $request->user_ntl;
        $students->user_address = $request->user_address;
        $students->user_status = $request->user_status;
        $students->user_work = $request->user_work;
        $students->user_period = $request->user_period;
        $students->user_tel = $request->user_tel;
        $students->user_email = $request->user_email;
        $students->user_msg = $request->user_msg;
        // $students->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $students->save();
        \Log::info(‘ここは実行された’);
        return redirect('/');
    }

    // <学生情報の更新画面表示>処理
    public function edit($students_id){
        $students::where('user_id', Auth::user()->id)->find($request->id);
        return view('studentsedit', ['student' => $student]);
    }

}