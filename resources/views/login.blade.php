<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>로그인</title>

    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/reset.css">
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/login.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/compile/fontawesome.css">
</head>

<body>

<div class="login-container">
    <div class="login-box">

        <!-- start box-logo -->
        <div class="box-logo">
            <a href="/"><img src="../img/login_logo.png" alt="로고"/></a>
            <p>고객여러분의 방문을 환영합니다</p>
        </div>
        <!-- end box-logo -->

        <form name="flogin" action="/loginAction" method="post">
            @csrf
            <div class="box-content">

                <div>
                    <input type="text" name="mb_id" id="login_id" required class="frm_input input-text" placeholder="아이디">
                </div>
                <div>
                    <input type="password" name="mb_password" id="login_pw" required class="frm_input input-text" placeholder="비밀번호">
                </div>
                <!-- start content-guide -->
                <div class="content-guide">
{{--                    <button type="submit" class="btn_submit" onclick="location.href='/'">로그인</button>--}}
                    <button type="submit" class="btn_submit" >로그인</button>
                    <div class="content-guide-info">
                        <a href="" id="">아이디/비밀번호 찾기</a>
                        <a href="/user/add" class="btn-register">회원가입</a>
                    </div>
                </div>
                <!-- end content-guide -->
            </div>
        </form>
    </div>

</div>

</body>
</html>
