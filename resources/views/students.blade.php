@extends('layouts.app')

@push('css')
<link href="{{ asset('css/CloudVision.css')}}" rel="stylesheet">
@endpush

@section('content')
    <h4 id='title'>画像データを使って入力・登録</h4>
    <!--- 画像をアップロードさせるためのボタンのあるエリア --->
    <div id="uploadArea">
        <l>画像データを選ぶ (.jpgか.png推奨 )</l>
        <input type="file" id="uploader">
    </div>
    
    <!--- Google Cloud Vision APIに画像ファイルを送り、得られた結果を表示するエリア --->
    <!--- 初期状態ではクラス"hidden"を付与し、CSSでhiddenクラスは表示されないよう記述します --->
    <div class="resultArea hidden">
            <!--- アップロードされた画像を表示 --->
            <table>
                <!--<th><b>here is uploaded img</b></th>-->
                <tr><td><b>アップロードしたファイル</b></td></tr>
            </table>    
                <div id="showPic"></div>
                <!--- テキスト解読の結果を表示 --->
            <h5>必要な言葉をコピーして、貼り付けて入力にお役立てください。</h5>
            <table class="textTable">
                <!--<table id="textTable">-->
                <!-- ↓ここにテキスト解読の結果が表示される。 --> 
                 <!--<tbody id="textBox"></tbody> -->
                 <p id="optional"></p>
                </table>
            </table>
    </div>
    <hr>

    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <h5><div class="card-title">
            留学生登録データ（手入力）
        </div></h5>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        
        <!-- 登録フォーム -->
        @if( Auth::check() )
        <form action="{{ url('students') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <!-- 学籍番号 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">学籍番号</label> 
                    <input type="text" name="user_id" class="form-control">
                </div>
            </div>
            <!-- 在留カード番号 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">在留カード番号</label> 
                    <input type="text" name="user_number" class="form-control">
                </div>
            </div>
            
            <!-- 名前 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">名前</label> 
                    <input type="text" name="user_name" class="form-control">
                </div>
            </div>
            <!-- 生年月日 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">生年月日</label> 
                    <input type="text" name="user_birth" class="form-control">
                </div>
            </div>
            
            <!-- 性別 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">性別</label> 
                    <input type="text" name="user_sex" class="form-control">
                </div>
            </div>
            
            <!-- 国籍 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">国籍</label> 
                    <input type="text" name="user_ntl" class="form-control">
                </div>
            </div>
            
            <!-- 住居地 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">住居地</label> 
                    <input type="text" name="user_address" class="form-control">
                </div>
            </div>
            
            <!-- 在留資格 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">在留資格</label> 
                    <input type="text" name="user_status" class="form-control">
                </div>
            </div>
            
            <!-- 就労制限の有無 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">就労制限の有無</label> 
                    <input type="text" name="user_work" class="form-control">
                </div>
            </div>
            
            <!-- 在留期間（満了日） -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-6 control-label">在留期間（満了日）</label> 
                    <input type="text" name="user_period" class="form-control">
                </div>
            </div>
            
            <!-- 電話番号 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">電話番号</label> 
                    <input type="text" name="user_tel" class="form-control">
                </div>
            </div>
            
            <!-- 学生Eメールアドレス -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">メールアドレス</label> 
                    <input type="text" name="user_email" class="form-control">
                </div>
            </div>
            
            <!-- メッセージ -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="student" class="col-sm-3 control-label">メッセージ</label> 
                    <input type="text" name="user_msg" class="form-control">
                </div>
            </div>


            <!-- 留学生登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
            
        </form>
        @endif
    </div>
    
    <!-- student: 既に登録されてる学生 -->
    @if (count($students) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">学生一覧
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>学籍番号</th>
                        <th>在留カード番号</th>
                        <th>名前</th>
                        <th>生年月日</th>
                        <th>性別</th>
                        <th>国籍</th>
                        <th>住居地</th>
                        <th>在留資格</th>
                        <th>就労制限の有無</th>
                        <th>在留期間</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>メッセージ</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <!-- 学籍番号 -->
                                <td class="table-text">
                                    <div>{{ $student->user_id }}</div>
                                </td>
                                <!-- 在留カード番号 -->
                                <td class="table-text">
                                    <div>{{ $student->user_number }}</div>
                                </td>
                                
                                <!-- 名前 -->
                                <td class="table-text">
                                    <div>{{ $student->user_name }}</div>
                                </td>
                                
                                <!-- 生年月日 -->
                                <td class="table-text">
                                    <div>{{ $student->user_birth }}</div>
                                </td>
                                
                                <!-- 性別 -->
                                <td class="table-text">
                                    <div>{{ $student->user_sex }}</div>
                                </td>
                                
                                <!-- 国籍 -->
                                <td class="table-text">
                                    <div>{{ $student->user_ntl }}</div>
                                </td>
                                
                                <!-- 住居地 -->
                                <td class="table-text">
                                    <div>{{ $student->user_address }}</div>
                                </td>
                                
                                <!-- 在留資格 -->
                                <td class="table-text">
                                    <div>{{ $student->user_status }}</div>
                                </td>
                                
                                <!-- 就労制限の有無 -->
                                <td class="table-text">
                                    <div>{{ $student->user_work }}</div>
                                </td>
                                
                                <!-- 在留期間（満了日） -->
                                <td class="table-text">
                                    <div>{{ $student->user_period }}</div>
                                </td>
                                
                                <!-- 電話番号 -->
                                <td class="table-text">
                                    <div>{{ $student->user_tel }}</div>
                                </td>
                                
                                <!-- 学生Eメールアドレス -->
                                <td class="table-text">
                                    <div>{{ $student->user_email }}</div>
                                </td>
                                
                                <!-- メッセージ -->
                                <td class="table-text">
                                    <div>{{ $student->user_msg }}</div>
                                </td>
                                
                                <!-- 更新ボタン -->
                                <td>
                                	<form action="{{ url('studentsedit/'.$student->id) }}" method="POST">
                                	    {{ csrf_field() }}
                                	    <button type="submit" class="btn btn-primary">
                                	        更新
                                	    </button>
                                	</form>
                                </td>
                                
                                
                                
                                <!-- 削除ボタン -->
                                <!--<td>-->
                                <!--    <form action="{{ url('stdnt/'.$student->id) }}" method="POST">-->
                                <!--            {{ csrf_field() }}-->
                                <!--            {{ method_field('DELETE') }}-->
                                <!--            <button type="submit" class="btn btn-danger">-->
                                <!--                削除-->
                                <!--            </button>-->
                                <!--    </form>-->
                                <!--</td>-->
                                
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>		
    @endif


<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="{{ asset('/js/CloudVision.js') }}"></script>
<script link="{{ asset('/js/app.js') }}"></script>


@endsection
