@extends("layouts/layout")

@section("title")
    비밀번호 확인
@endsection

@section("content")
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/login.css">
    <div class="confirm-content">
        <form name="flogin" action="/confirm_proc" method="post">
        @csrf
            <p class="pass-confirm-tit">회원 비밀번호 확인</p>

            <div class="content-guide">
                <p>비밀번호를 한번 더 입력해주세요.</p>
                <p>회원님의 정보를 안전하게 보호하기 위해 비밀번호를 한번 더 확인합니다.</p>
            </div>

            <div class="confirm-info">
                <div>회원아이디</div>
                <span>{{request()->cookie("user_id") }}</span>
                <input type="password" class="frm_input" name="mb_password" placeholder="비밀번호">
            </div>

            <div class="confirm-box">
                <button type="button" class="" onclick="location.href='/'">취소</button>
                <button type="submit" class="btn_confirm" >확인</button>
            </div>
        </form>
    </div>
@endsection
