@extends("layouts/layout")

@section("title")
    거래처 문서
@endsection

@section("content")
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    {{--    <link rel="stylesheet" href="/resources/demos/style.css">--}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/post.js"></script>
    <script>
        $(document).ready(function(){
            // $('.input-datepicker').('setDate', new Date());
            $('#from_date').datepicker('setDate', '-7D');
            $('#to_date').datepicker('setDate', 'toaday');
            // $('.input-datepicker').();
            // $(".input-datepicker").datepicker('setDate', new Date());
        });
    </script>

<style>

</style>


<section id="member_wrap" class="list_wrapper">
    <article id="list_head">
        <div class="head-info">
            <h1>거래처 문서</h1>
            <div class="action-wrap">
                <ul>
                    {{--<li>--}}
                        {{--<button class="btn-black-middle" id="btndel">선택삭제</button>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<button class="btn-black-middle" id="btnregister" onclick="location.href='{{ route("company.list.create") }}'">문서추가</button>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>

        <div class="search-wrap">
            <form action="" method="" name="member_list_search">
                <div class="search-con search-date">
                    <img src="/img/calendar_icon2.png" alt="달력 아이콘">
                    <span>날짜검색</span>
                    <div class="search-input">
                        <input type="text" name="from_date" id="from_date" value="">
                    </div>
                    <span class="tilde">~</span>
                    <div class="search-input">
                        <input type="text" name="to_date" id="to_date" value="">
                    </div>
                </div>

                <div class="search-con">
                    <img src="/img/company_icon.png" alt="노무자 아이콘">
                    <span>거래처검색</span>
                    <div class="search-input">
                        <input type="text" name="company" value="" placeholder="거래처 검색어">
                        <button type="submit">검색</button>
                    </div>
                </div>
            </form>
        </div>
    </article> <!-- article list_head end -->

    <article id="company-document" class="" style="overflow-x: auto;">

        {{-- 거래처문서 좌측면 --}}
        <div class="content-left table03">
            <table class="company-list in-input table-2x-large">
                <thead>
                <tr>
                    {{--<th>--}}
                        {{--<input type="checkbox" id="check_all" name="check_all" value="1">--}}
                        {{--<label for="check_all"></label>--}}
                    {{--</th>--}}
                    <th>번호</th>
                    <th>거래처명</th>
                    <th>시작일</th>
                    <th>종료일</th>
                    <th>문서 생성일</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $i => $list)
                    <tr>
                        {{--<td>--}}
                            {{--<input type="checkbox" name="check[]" id="check_{{$list->co_code}}" value="{{ $list->co_code }}" class="user_checked">--}}
                            {{--<label for="check_{{$list->co_code}}"></label>--}}
                        {{--</td>--}}
                        <td>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                        <td>
                            <span><a href="/post/account_certificate?id={{ $list->co_code }}">{{ $list->co_name }}</a></span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->start_date)) }}</span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->end_date)) }}</span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->months)) }}</span>
                        </td>
                    </tr>
                @endforeach
                @if ($lists->isEmpty())
                    <tr>
                        <td colspan="17">데이터가 없습니다.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="content-right">
            <ul class="document-tab">
                <li class=""><a href="/post/account_list">노무비 청구서</a></li>
                <li class=""><a href="/post/account_wageslist">노임대장</a></li>
                <li class=""><a href="/post/account_identity">신분증</a></li>
                <li class="active"><a href="/post/account_certificate">교육증</a></li>
                <li class=""><a href="/post/account_mandator">위임장</a></li>
            </ul>

            <div class="document-tab_contents">

                {{-- 네번째 탭 --}}
                <div class="tab_content-04">
                    <div class="card-wrap edu-card-info">
                        <ul>

                            @if(!empty($view_data))

                                @foreach ($view_data as $i => $view_datas)
                                    <li>
                                        {{--<div>--}}
                                            {{--<input type="checkbox" name="check[]" id="check_{{$j}}" value="" class="card_checked">--}}
                                            {{--<label for="check_{{$j}}"></label>--}}
                                        {{--</div>--}}
                                        <div class="img-wrap">
                                            <div class="edu-card-img">
                                                <img src="{{asset('/storage/'.$view_datas->photo3)}}" id="changePhoto">
                                            </div>
                                        </div>
                                        <div class="text-wrap">
                                            <p><span>이름</span><sapn>{{ $view_datas->name }}</sapn></p>
                                            <p><span>주번</span><span>{{ $view_datas->rsNo }}</span></p>
                                            <p><span>주소</span><span>{{ $view_datas->address }}</span></p>
                                        </div>
                                    </li>
                                @endforeach

                            @else( $view_data == "" )
                                <li>
                                    <div class="img-wrap">
                                        데이터가 없습니다.
                                    </div>
                                </li>
                            @endif

                        </ul>
                    </div>{{-- //.card-wrap end --}}
                </div>{{-- //.tab_content-04 end --}}

            </div>{{-- //.document-tab_contents end --}}
        </div>{{-- //.contents-right end --}}
    </article> <!-- article list_contents end -->

    <article id="list_bottom">
       {{ pagination2(10, ceil($paging/15)) }}
    </article> <!-- article list_bottom end -->

</section>

<style>
    textarea {
        outline: none;
    }
</style>


<script>
    // document.getElementById("check_all").onclick = function (e) {
    //     var checked = e.target.checked;
    //     var checkbox = document.querySelectorAll(".user_checked");
    //
    //     Array.prototype.forEach.call(checkbox, function(i, v){
    //         i.checked = checked;
    //     });
    // };

    $("input[name='from_date']").datepicker({
        language: 'ko',
        dateFormat:"yy-mm-dd",
        view: 'months',
        minView: 'months',
        clearButton: false,
        autoClose: true,
        onSelect: function(dateText, inst) {
            $("input[name='to_date']").datepicker({
                minDate: new Date(dateText),
                dateFormat:"yy-mm-dd",
                clearButton: false,
                autoClose: true,
            })
        }
    });


    $("input[name='to_date']").datepicker({
        language: 'ko',
        dateFormat:"yy-mm-dd",
        view: 'months',
        minView: 'months',
        clearButton: false,
        autoClose: true,
        onSelect: function(dateText, inst) {

        }
    });

    $("a.view_pop").click(function() {
        window.open(this.href, "popup", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    document.querySelector('.document-tab').addEventListener('click', function (e) {
        tabMenuActive(this, e.target.dataset.visible);
        tabContentsOpen(e.target.dataset.visible);

        console.log('탭 값 : ', e.target.dataset.visible);
        console.log('탭 클릭시 오픈 유무');
    });

    function tabMenuActive(t, visible) {
        var targets = t.children;

        for (var i = 0; i < targets.length; i++) {
            if (i == visible) {
                targets[i].classList.add('active');
                continue;
            }

            targets[i].classList.remove('active');
        }
    }

    function tabContentsOpen(visible) {
        var targets = [
            document.querySelector('tab_contents-01'),
            document.querySelector('tab_contents-02'),
            document.querySelector('tab_contents-03'),
            document.querySelector('tab_contents-04'),
            document.querySelector('tab_contents-05')
        ];

        for (var i = 0; i < targets.length; i++) {
            if (i == visible) {
                targets[i].classList.add('visible');
                continue;
            }

            targets[i].classList.remove('visible');
            targets[i].classList.add('invisible');
        }
    }

    $(document).ready(function(){
        var eduCard = $('.document-tab_contents .card-wrap ul li .img-wrap .edu-card-img');
        var cardWidth = eduCard.width();
        var cardHeight = cardWidth * 0.625;

        console.log('신분증 width: ', cardWidth);
        console.log('신분증 height: ', cardHeight);
        eduCard.height(cardHeight);
    });

</script>
@endsection
