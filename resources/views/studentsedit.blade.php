@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <form action="{{ url('students/update') }}" method="POST">
            
            <!-- 学籍番号 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">学籍番号</label>
                    <input type="text" name="user_id" class="form-control" value="{{$student->user_id}}">
                </div>
            </div>
            
            <!-- 在留カード番号 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">在留カード番号</label>
                    <input type="text" name="user_number" class="form-control" value="{{$student->user_number}}">
                </div>
            </div>
            
            <!-- 名前 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">名前</label> 
                    <input type="text" name="user_name" class="form-control" value="{{$student->user_name}}">
                </div>
            </div>
            <!-- 生年月日 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">生年月日</label> 
                    <input type="text" name="user_birth" class="form-control" value="{{$student->user_birth}}">
                </div>
            </div>
            
            <!-- 性別 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">性別</label> 
                    <input type="text" name="user_sex" class="form-control" value="{{$student->user_sex}}">
                </div>
            </div>
            
            <!-- 国籍 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">国籍</label> 
                    <input type="text" name="user_ntl" class="form-control" value="{{$student->user_ntl}}">
                </div>
            </div>
            
            <!-- 住居地 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">住居地</label> 
                    <input type="text" name="user_address" class="form-control" value="{{$student->user_address}}">
                </div>
            </div>
            
            <!-- 在留資格 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">在留資格</label> 
                    <input type="text" name="user_status" class="form-control" value="{{$student->user_status}}">
                </div>
            </div>
            
            <!-- 就労制限の有無 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">就労制限の有無</label> 
                    <input type="text" name="user_work" class="form-control" value="{{$student->user_work}}">
                </div>
            </div>
            
            <!-- 在留期間（満了日） -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-6 control-label">在留期間（満了日）</label> 
                    <input type="text" name="user_period" class="form-control" value="{{$student->user_period}}">
                </div>
            </div>
            
            <!-- 電話番号 -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">電話番号</label> 
                    <input type="text" name="user_tel" class="form-control" value="{{$student->user_tel}}">
                </div>
            </div>
            
            <!-- 学生Eメールアドレス -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">メールアドレス</label> 
                    <input type="text" name="user_email" class="form-control" value="{{$student->user_email}}">
                </div>
            </div>
            
            <!-- メッセージ -->
            <div class="form-group">
                <div class="col-sm-6">
                    <label for="students" class="col-sm-3 control-label">メッセージ</label> 
                    <input type="text" name="user_msg" class="form-control" value="{{$student->user_msg}}">
                </div>
            </div>
            
            
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}"> Back</a>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$student->id}}" />
            <!--/ id 値を送信 -->
            
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>

@endsection