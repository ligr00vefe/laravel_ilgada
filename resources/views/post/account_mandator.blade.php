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
            // $('#from_date').datepicker('setDate', '-1m');
            // $('#to_date').datepicker('setDate', 'toaday');
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
                            <span><a href="/post/account_mandator?id={{ $list->co_code }}&month={{ $list->months }}">{{ $list->co_name }}</a></span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->start_date)) }}</span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->end_date)) }}</span>
                        </td>
                        <td>
                            <span>{{ date("y-m-t", strtotime($list->end_date)) }}</span>
                        </td>
                    </tr>
                @endforeach
                @if ($lists->isEmpty())
                    <tr>
                        <td colspan="5">데이터가 없습니다.</td>
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
                <li class=""><a href="/post/account_certificate">교육증</a></li>
                <li class="active"><a href="/post/account_mandator">위임장</a></li>
            </ul>

            <div class="document-tab_contents">
                {{-- 다섯번째 탭 --}}
                <div class="tab_content-05">
                    <div class="warrant-wrap">
                        <form name="myform" id="myform" method="get">
                            <input type="hidden" name="chk_com" id="chk_com" value="{{ $co_info->co_code }}" check>
                            <input type="hidden" name="chk_month" id="chk_month" value="{{ $co_info->month }}" check>
                        {{--<form id="myform">--}}
                        {{--<div class="warrant-top">--}}
                            {{--<div class="warrant-radio document-radiobox">--}}
                                {{--<span class="radio-tit">수수료 포함여부</span>--}}
                                {{--<input type="radio" name="vat" id="fees01" value="포함" check>--}}
                                {{--<label for="fees01">포함</label>--}}
                                {{--<input type="radio" name="vat" id="fees02" value="제외">--}}
                                {{--<label for="fees02">제외</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="warrant-table">
                            <h1>수임인 선택목록 {{--{{$co_info->co_code}} --}}</h1>
                            <table>
                                <colgroup>
                                    <col width="50px">
                                    <col width="100px">
                                    <col width="150px">
                                    <col width="">
                                    <col width="280px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th class="td_chk">
                                        <input type="checkbox" name="check_all" id="check_all" value="1">
                                        <label for="check_all"></label>
                                    </th>
                                    <th><span>수임인</span></th>
                                    <th><span>주민등록번호</span></th>
                                    <th><span>주소</span></th>
                                    <th><span>계좌번호</span></th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($sub_data))

                                    @foreach ($sub_data as $i => $sub_datas)
                                    <tr>
                                        <td class="td_chk">
                                            <input type="checkbox" name="check[]" id="check_{{ $i }}" value="{{ $sub_datas->id }}" class="user_checked">
                                            <label for="check_{{ $i }}"></label>
                                        </td>
                                        <td><span>{{ $sub_datas->name }}</span></td>
                                        <td><span>{{ $sub_datas->rsNo }}</span></td>
                                        <td><span>{{ $sub_datas->address }}</span></td>
                                        <td><span>{{ $sub_datas->bank }} {{ $sub_datas->bank_num}} {{ $sub_datas->name }} </span></td>
                                    </tr>
                                    @endforeach

                                @else( $view_data == "" )
                                    <tr>
                                        <td colspan="5">
                                            데이터가 없습니다.
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>{{-- //.warrant-table end --}}

                        <a href="javascript:void(0)" class="btn-create" >위임장 생성</a>

                        </form>
                    </div>
                </div>

            </div>{{-- //.document-tab_contents end --}}
        </div>{{-- //.contents-right end --}}
    </article> <!-- article list_contents end -->

    <article id="list_bottom">
       {!! pagination2(10, ceil($paging/15)) !!}
    </article> <!-- article list_bottom end -->

</section>

<style>
    textarea {
        outline: none;
    }
</style>


 <script type="text/javascript">
     $(document).ready(function() {
         let d = new Date();
         let year = d.getFullYear();
         let months = d.getMonth() ; // 월은 0에서 시작하기 때문에 +1
         let month = d.getMonth() +1; // 월은 0에서 시작하기 때문에 +1
         let day = d.getDate();
         // let from_date = year+'-'+months+'-'+day;
         // console.log(from_date);
         // $('#from_date').attr('placeholder',`${year}-${months}-${day}`);
         // $('#to_date').attr('placeholder',`${year}-${month}-${day}`);
     });

     // 팝업오픈하여 폼데이터 Post 전송
     // function openPop(){
     //
     //     var pop_title = "popupOpener" ;
     //
     //     window.open("", pop_title) ;
     //
     //     var frmData = document.frmData ;
     //     frmData.target = pop_title ;
     //     frmData.action = "popup.jsp" ;
     //
     //     frmData.submit() ;
     // }



         {{--function onSubmit(){--}}
             {{--var myForm = document.popForm;--}}

             {{--//http://www.naver.com--}}
             {{--var url = "{{ route('popup.war_document') }}";--}}

             {{--// 옵션 추가가능 window.open("" ,"popForm", "toolbar=no, width=540, height=467, directories=no, status=no,    scrollorbars=no, resizable=no");--}}
             {{--window.open("" ,"popForm");--}}

             {{--myForm.action ="{{ route('popup.war_document') }}";--}}
             {{--myForm.method="get";--}}
             {{--myForm.target="popForm";--}}
             {{--myForm.submit();--}}
         {{--}--}}

     {{--$(".btn-create").on("click", function () {--}}
         {{--var myForm = document.myform;--}}
         {{--var url = "{{ route('popup.war_document') }}";--}}

         {{--var checkBoxArr = [];--}}
         {{--$(".user_checked:checked").each(function () {--}}
         {{--checkBoxArr.push($(this).val());     // 체크된 것만 값을 뽑아서 배열에 push--}}
         {{--// console.log(checkBoxArr);--}}
         {{--})--}}

         {{--window.open(url,"popForm", "toolbar=no, width=540, height=467, directories=no, status=no, scrollorbars=no, resizable=no");--}}
         {{--myForm.action = "{{ route('popup.war_document') }}";--}}
         {{--myForm.method = "post";--}}
         {{--myForm.target = "popForm";--}}
         {{--// myForm.testVal = 'test';--}}
         {{--myForm.submit();--}}
     {{--});--}}


     $(".btn-create").on("click", function () {

         var openWin;

         if ($(".user_checked:checked").length == 0) {
             alert("출력할 노무자를 선택해주세요.");
             return false;
         }

         // var wintype = "toolbar=no,width=500,height=300,top=150,left=150,directories=no,menubar=no,scrollbars=yes";
         // window.open("/popup/warrant_document", "childwin", wintype);
         // $("#myform").submit();

         var checkBoxArr = [];
         var checkcom;
         var checkmonth;
         // var getdata;
         $(".user_checked:checked").each(function () {
             checkBoxArr.push($(this).val());     // 체크된 것만 값을 뽑아서 배열에 push
             {{--checkcom.push( {{ $request->input("check_data") }} );     // 체크된 것만 값을 뽑아서 배열에 push--}}

             // console.log(checkBoxArr);
             // console.log(checkcom);
         })

             checkcom = $('#chk_com').val();
             checkmonth = $('#chk_month').val();
             // console.log(checkBoxArr +', '+ checkcom +', '+ checkmonth);
             {{--getdata = ('<?=$_GET["company"] ?>')?'<?=$_GET["company"] ?>':'';--}}
             // checkcom = (getdata) ? getdata : checkcom;     // 체크된 것만 값을 뽑아서 배열에 push
             {{--console.log({{$request->input('company')}});--}}

             // $request->input("check_data")

             $.ajax({
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 type  : "get",
                 url    : '{{ route('popup.war_document') }}',
                 // dataType: 'json',
                 data: {
                     checkBoxArr : checkBoxArr,        // folder seq 값을 가지고 있음.
                     checkcom : checkcom,        // folder seq 값을 가지고 있음.
                     checkmonth : checkmonth        // folder seq 값을 가지고 있음.
                 },
                 success: function(result){
                     // console.log(324);
                     //  alert("성공");

                     {{--var myForm = document.myform;--}}
                     {{--var url = "{{ route('popup.war_document') }}";--}}
                     {{--var wintype = "toolbar=no,width=900,height=1000,top=150,left=150,directories=no,menubar=no,scrollbars=yes";--}}
                     {{--window.open("/popup/war_document", "childwin", wintype);--}}
                     {{--myForm.action = "/popup/war_document";--}}
                     {{--myForm.target = "childwin";--}}
                     {{--myForm.submit();--}}

                     {{--$('#myform').attr("action", "{{ route('popup.war_document') }}"+"?check_data="+checkBoxArr );--}}
                     {{--$('#myform').attr("method", "get");--}}
                     {{--$('#myform').attr("target", "formInfo");--}}
                     {{--var windowObj = window.open("", "formInfo", "height=500, width=900, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");--}}
                      // opener.document.getElementById('ttt').value = "1222";
                      // opener.document.querySelector(".ttt").val('gsdd');
                      // console.log(333);

                     // opener.document.getElementById("ttt").value = "dsds";
                     // $('#myform').submit();

                      var wintype = "toolbar=no,width=900,height=1000,top=150,left=150,directories=no,menubar=no,scrollbars=yes";
                      openWin = window.open("{{ route('popup.war_document') }}"+"?checkBoxArr="+checkBoxArr+"&checkcom="+checkcom+"&checkmonth="+checkmonth, "childwin", wintype);
                     {{--openWin = window.open("{{ route('popup.war_document') }}", "childwin", wintype);--}}
                      // openWin.document.getElementById("ttt").value = check_data;
                     {{--opener.document.getElementById("ttt").value = "dsds";--}}

                      {{--$("#myform").attr({"action": "{{ route('popup.war_document') }}", "method":"post"}).submit();--}}
                     // $("#myform").submit();
                 },
                 error: function(xhr, status, error) {
                      alert("실패");
                     // alert(error);
                 }
             });

             // document.memberUpdate.submit();
     });

    document.getElementById("check_all").onclick = function (e) {
        var checked = e.target.checked;
        var checkbox = document.querySelectorAll(".user_checked");

        Array.prototype.forEach.call(checkbox, function(i, v){
            i.checked = checked;
        });
    };

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

</script>
@endsection
