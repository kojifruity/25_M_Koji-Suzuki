<?php
use App\Student;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/**
* 学生データのダッシュボード表示(students.blade.php)
// */
// Route::get('/', function () {
//     $students = Student::orderBy('created_at', 'asc')->paginate(3);
//     return view('students', [
//         'students' => $students
//     ]);
//     });
    
/**
* 新「学生データ」を登録追加
*/
Route::post('/students', function (Request $request) {
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
    
//     //以下に登録処理を記述（Eloquentモデル）
//     // Eloquent モデル
        $students = new Student;
        $students->user_id = $request->user_id;
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
    });




//* <学生情報の更新画面表示>処理
//*/
Route::post('/studentsedit/{student}',function(Student $student){

	return view('studentsedit', ['student' => $student]);

});


/**
* <学生情報の更新>処理
*/
Route::post('students/update',function(Request $request){
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
    
    //以下に更新処理を記述（Eloquentモデル）
    // Eloquent モデル
        $students = Student::find($request->id);
        $students->user_id = $request->user_id;
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
        // $stdnts->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $students->save();
        return redirect('/');
});

/**
* <学生情報の削除>処理
*/
// Route::delete('/student/{student}', function (Student $student) {
//     $student->delete();   //追加
//     return redirect('/'); //追加
// });



//ここからマルチログインのルーティング
// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'confirm'  => false,
        'reset'    => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

    });
});

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'confirm'  => false,
        'reset'    => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

    });

});
//ここまでマルチログインのルーティング

