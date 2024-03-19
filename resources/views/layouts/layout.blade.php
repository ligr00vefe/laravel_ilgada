<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>일가다 | @yield("title", "main")</title>

    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/import.css">
    <script src="/lib/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    {{--    <link rel="stylesheet" href="/resources/demos/style.css">--}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/js/modal.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    @stack('scripts')

</head>
<body>
<div id="app">
    <nav id="nav">
        <div class="nav-logo"><a href="/"><img src="../../img/logo.png" alt="로고 이미지"></a></div>
        <ul class="nav-list">
            <li class="">
                <span>일일정보</span>
                <ul>
                    <li><a href="/post/list">- 일일정보 조회</a></li>
                    <li><a href="/post/add">- 일일정보 등록</a></li>
                </ul>
            </li>
            <li class="">
                <a href="/post/worker_list">노무자 일정보</a>
            </li>
            <li class="">
                <a href="/post/company_list">거래처 일정보</a>
            </li>
            <li class="">
                <span>노무자관리</span>
                <ul>
                    <li><a href="/worker/list">- 노무자 조회</a></li>
                    <li><a href="/worker/add">- 노무자 등록</a></li>
                </ul>
            </li>
            <li class="">
                <span>거래처관리</span>
                <ul>
                    <li><a href="/company/list">- 거래처 조회</a></li>
                    <li><a href="/company/add">- 거래처 등록</a></li>
                </ul>
            </li>
            {{--<li class="">--}}
                {{--<span>노무자문서</span>--}}
                {{--<ul>--}}
                    {{--<li><a href="">- 영수증</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li class="">
                <a href="/post/account_list">거래처문서</a>
            </li>
            <li class="">
                <a href="/qna">문의하기</a>
            </li>
            <li class="">
                <a href="/notice">공지사항</a>
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
            <ul class="head-login-info">
                @if ( !request()->cookie("user_name") )
                    <li>
                    </li>
                    <li class="introduce">
                        <p class=""><span class="hd-login-name"></span>회원 가입 후 이용가능합니다.</p>
                    </li>
                @elseif ( request()->cookie("user_name") )
                    <li>
                        <p>이용기간 : 2021-07-01 ~ 2021-07-31<span class="d-day">(D-1)</span></p>
                        <button class="btn btn-extension" data-id="{{ request()->cookie("user_code") }}">연장</button>
                    </li>
                    <li class="introduce">
                        <p class=""><span class="hd-login-name">{{ request()->cookie("user_name") }}</span> 님 환영합니다.</p>
                    </li>
                @endif

                <li>
                    @if ( !request()->cookie("user_name") )
                    <a href="/login" class="hd-info-btn logout-btn">로그인</a>
                    <a href="/user/add" class="hd-info-btn logout-btn">회원가입</a>
                    @elseif ( request()->cookie("user_name") )
                    <a href="/confirm" class="hd-info-btn modify-btn">정보수정</a>
                    <a href="/logout" class="hd-info-btn logout-btn">로그아웃</a>
                    @endif
                </li>
            </ul>
        </header>

        <!-- body -->
        <div class="content-body">
            @yield('content')
        </div>

        <footer>
            <div>COPYRIGHT 2021 일가다 ALL RIGHTS RESERVED.</div>
        </footer>

    </main>
    <!-- end main -->

</div>


<div class="popup-container" id="extend-modal">
    <form action="/member/register" method="post" name="period_form" >
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
                        <input type="radio" id="month_1" name="extend_terms" class="frm_radio terms_input">
                        <label for="month_1">1개월</label>

                        <input type="radio" id="month_3" name="extend_terms" class="frm_radio terms_input">
                        <label for="month_3">3개월</label>

                        <input type="radio" id="month_6" name="extend_terms" class="frm_radio terms_input">
                        <label for="month_6">6개월</label>

                        <input type="radio" id="month_9" name="extend_terms" class="frm_radio terms_input">
                        <label for="month_9">9개월</label>

                        <br/>

                        <input type="radio" id="year_1" name="extend_terms" class="frm_radio terms_input">
                        <label for="year_1">1년</label>

                        <input type="radio" id="year_3" name="extend_terms" class="frm_radio terms_input">
                        <label for="year_3">3년</label>

                        <input type="radio" id="year_6" name="extend_terms" class="frm_radio terms_input">
                        <label for="year_6">6년</label>

                        <input type="radio" id="year_9" name="extend_terms" class="frm_radio terms_input">
                        <label for="year_9">9년</label>

                        <br/>

                        <input type="radio" id="infinite" name="extend_terms" class="frm_radio terms_input">
                        <label for="infinite">기간 제한 없음</label>
                    </div>

                    <div class="payment-type">
                        <h3>결제수단</h3>
                        <div class="payment_type_radio">
                            <input type="radio" id="pay_type_01" class="frm_radio" name="무통장입금">
                            <label for="pay_type_01">무통장 입금</label>
                        </div>
                        <div class="payment_type_detail">
                            <span class="payment_detail_01">하나은행 123456789 일가다</span>
                            <div class="account_name">
                                <input type="text" value="" name="" class="frm_input" placeholder="입금자명">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end box-section -->

                <div class="btn_wrap">
                    <button type="button" class="btn-close2 btn-closeExtendModal">취소</button>
                    <button type="button" class="btn-confirm">확인</button>
                </div>
            </div>
        </div><!-- #popup-wrap.popup-wrap  end -->
    </form>>
</div><!--.popup-container end -->


<script>
    $(document).ready(function(){
        /*모달창*/
        $('.btn-extension').on('click', function(){
            extendModalOpen();
        });

        $('.btn-closeExtendModal').on('click', function(){
            extendModalClose();
        });

        // 사이드 메뉴 클릭 모션
        // $('#app .nav-list li').on('click', function(){
        //     $(this).addClass('active');
        // });
    });
</script>
<script src="/js/admin.js"></script>
</body>
</html>
