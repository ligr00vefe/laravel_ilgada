<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>관리자 | @yield("title", "main")</title>

    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/reset.css">
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/admin.css">
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/font/font.css">
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/login.css">
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/compile/fontawesome.css">
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/modal.css">
    <script src="/lib/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="/js/modal.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    @stack('scripts')

</head>
<body>
<div id="app">
    <nav id="nav">
        <div class="nav-logo">
            <a href="/admin">
                <img src="../../img/logo.png" alt="로고 이미지">
                <span>ADMIN</span>
            </a>
        </div>
        <ul class="nav-list">
            <li class="">
                <a href="/admin/member">인력사무소</a>
            </li>
            <li class="">
                <a href="/admin/payments">결제정보</a>
            </li>
            <li class="">
                <a href="/admin/qna">문의사항</a>
            </li>
            <li class="">
                <a href="/admin/notice">공지사항</a>
            </li>
        </ul>
        <!-- end .nav-list -->
    </nav>

    {{--   <ol class="nav-sub-menu">
           <i class="fas fa-minus"></i>
           <li><a href="admin/"></a></li>
       </ol>--}}

    <main id="main">

        <!--head-->
        <header>
            @if (session()->get("user_token"))
                <ul class="head-login-info">
                    <li class="introduce">
                        <p class=""><span class="hd-login-name">{{session()->get("user_name")}}</span> 님 환영  합니다.</p>
                    </li>
                    <li>
                        <a href="/logout" class="hd-info-btn logout-btn">로그아웃</a>
                    </li>
                </ul>
            @else
                <ul class="head-login-info">
                    <li class="introduce">
                        <p class=""><span class="hd-login-name">로그인 후 이용 가능합니다.</span></p>
                    </li>
                    <li>
                        <a href="/login" class="hd-info-btn logout-btn">로그인</a>
                    </li>
                </ul>
            @endif
        </header>

        <!-- body -->
        <div class="content-body">
            @yield('content')
        </div>
    </main>
    <!-- end main -->

    <footer>
        <div>COPYRIGHT 2021 일가다 ALL RIGHTS RESERVED.</div>
    </footer>
</div>

<div class="popup-container" id="extend-modal">
    <form action="/admin/payments/period_proc" method="post" name="period_form" >
        @csrf
        <input type="hidden" name="id" class="period_id">
        <div class="popup-wrap">
            <div class="wrap-box">

                <!-- start box-head -->
                <div class="box-head">
                    <span class="head-title">연장신청</span>
                    <img src="../img/popup_close.png" class="btn-close btn-closeExtendModal">
                </div>
                <!-- end box-head -->

                <div class="box-section">
                    <h3>기간선택</h3>
                    <div class="extend_terms_radio">
                        <input type="radio" id="month_1" name="period" value="1month" class="frm_radio terms_input">
                        <label for="month_1">1개월</label>

                        <input type="radio" id="month_3" name="period" value="3month" class="frm_radio terms_input">
                        <label for="month_3">3개월</label>

                        <input type="radio" id="month_6" name="period" value="6month" class="frm_radio terms_input">
                        <label for="month_6">6개월</label>

                        <input type="radio" id="month_9" name="period" value="9month" class="frm_radio terms_input">
                        <label for="month_9">9개월</label>

                        <br/>

                        <input type="radio" id="year_1" name="period" value="1year" class="frm_radio terms_input">
                        <label for="year_1">1년</label>

                        <input type="radio" id="year_3" name="period" value="3year" class="frm_radio terms_input">
                        <label for="year_3">3년</label>

                        <input type="radio" id="year_6" name="period" value="6year" class="frm_radio terms_input">
                        <label for="year_6">6년</label>

                        <input type="radio" id="year_9" name="period" value="9year" class="frm_radio terms_input">
                        <label for="year_9">9년</label>

                        <br/>

                        <input type="radio" id="infinite" name="period" value="all" class="frm_radio terms_input">
                        <label for="infinite">기간 제한 없음</label>
                    </div>

                    <div class="payment-type">
                        <h3>결제수단</h3>
                        <div class="payment_type_radio">
                            <input type="radio" id="payment_type" name="payment_type" value="bank" class="tbl-radio terms_input">
                            <label for="payment_type">무통장 입금</label>
                        </div>
                        <div class="payment_type_detail">
                            <span class="payment_detail_01">하나은행 123456789 일가다</span>
                            <div class="account_name">
                                <input type="text" name="name" class="frm_input" placeholder="입금자명">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end box-section -->

                <div class="btn_wrap">
                    <button type="button" class="btn-close2 btn-closeExtendModal">취소</button>
                    <button type="submit" class="btn-confirm">확인</button>
                </div>
            </div>
        </div><!-- #popup-wrap.popup-wrap  end -->
    </form>
</div><!--.popup-container end -->


<script>
    $(document).ready(function(){
        /*모달창*/
        $('.btn-extension').on('click', function(){
            // var code = $(obj).attr('data-id');
            extendModalOpen();
        });

        $('.btn-closeExtendModal').on('click', function(){
            extendModalClose();
        });
    });
</script>
<!-- end app -->
{{--<script src="http://{{$_SERVER['HTTP_HOST']}}/js/admin.js"></script>--}}
</body>
</html>
