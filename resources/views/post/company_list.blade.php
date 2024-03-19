@extends("layouts/layout")

@section("title")
    거래처 일정보 조회
@endsection

@section("content")
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    {{--    <link rel="stylesheet" href="/resources/demos/style.css">--}}
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/post.js"></script>
    <script>
        $(document).ready(function() {
            let d = new Date();
            let year = d.getFullYear();
            let months = d.getMonth() ; // 월은 0에서 시작하기 때문에 +1
            let month = d.getMonth() +1; // 월은 0에서 시작하기 때문에 +1
            let day = d.getDate();
            $('#from_date').val(`${year}-${months}-${day}`);
            $('#to_date').val(`${year}-${month}-${day}`);
        });
    </script>
    <?
        $category_arr = ["동바리","경량", "타일", "목공", "미장", "조적", "조경", "덕트", "금속", "전기", "청소", "잡일", "기타"];
    ?>
    <section id="member_wrap" class="list_wrapper">

        <article id="list_head">

            <div class="head-info">
                <h1>거래처 일정보</h1>
                <div class="action-wrap">
                    <ul>
{{--                        <li>--}}
{{--                            <button class="btn-black-middle" id="btncopy">선택복사</button>--}}
{{--                        </li>--}}
                        <li>
                            <button class="btn-black-middle" id="btndel">선택삭제</button>
                        </li>
                        {{--<li>--}}
                            {{--<button class="btn-black-middle" id="btnedit">선택수정</button>--}}
                        {{--</li>--}}
{{--                        <li>--}}
{{--                            <button class="btn-black-middle" id="btnconfirm">작업확인서</button>--}}
{{--                        </li>--}}
                        {{--<li>--}}
                            {{--<button class="btn-black-middle" id="btnexcel">엑셀출력</button>--}}
                        {{--</li>--}}
                        <li>
                            <button class="btn-black-middle" id="btnregister" onclick="location.href='{{ route("post.list.create") }}'">신규등록</button>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="search-wrap">
                <form action="" method="" name="search-form">
                    <div class="search-con search-date">
                        <img src="/img/calendar_icon2.png" alt="달력 아이콘">
                        <span>날짜검색</span>
                        <div class="search-input">
                            <input type="text" name="from_date" id="from_date" class="input-datepicker" value="">
                        </div>
                        <span class="tilde">~</span>
                        <div class="search-input">
                            <input type="text" name="to_date" id="to_date" class="input-datepicker" value="">
                        </div>
                    </div>

                    <div class="search-con">
                        <img src="/img/company_icon.png" alt="거래처 아이콘">
                        <span>거래처 검색</span>
                        <div class="search-input">
                            <input type="text" name="term" value="" placeholder="거래처 검색어">
                            <button type="submit">검색</button>
                        </div>
                    </div>
                </form>
            </div>

        </article> <!-- article list_head end -->

        <article id="list_contents" class="table03" style="overflow-x: auto;">
            <form action="" method="post" name="memberUpdate">
                @csrf
                @method("put")
                <table class="member-list in-input table-2x-large">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="check_all" name="check_all" value="1">
                                <label for="check_all"></label>
                            </th>
                            <th>번호</th>
                            <th>작업일</th>
                            <th>노무자이름</th>
                            <th>분야</th>
                            <th>출석여부</th>
                            <th>노무자설명</th>
                            <th>거래처명</th>
                            <th>거래처설명</th>
                            <th>작업현장</th>
                            <th>단가</th>
                            <th>공수</th>
                            <th>총노임</th>
                            <th>수수료</th>
                            <th>지불금액</th>
                            <th>거래처입금</th>
                            <th>지불처리</th>
                            <th>추가지불</th>
                            <th>미수금</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($lists as $i => $list)
{{--                        $category_arr = ["동바리","경량", "타일", "목공", "미장", "조적", "조경", "덕트", "금속", "전기", "청소", "잡일", "기타"];--}}
                        @php
                        @endphp
                        <tr>
                            <td class="td_chk">
                                <input type="checkbox" name="check[]" id="check_{{$list->id}}" value="{{ $list->id }}" data-tot_price="{{ ($list->day_price) }}" class="user_checked" onclick="itemSum(this);">
                                <label for="check_{{$list->id}}"></label>
                            </td>
                            <td class="td_num"><span>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</span></td>
                            <td class="td_workDate">
                                <span class="tbl-span">{{ $list->work_date }}</span>
                            </td>
                            <td class="td_userCode">
                                <a href="/worker/view/{{ $list->user_code }}">{{ $list->name }}</a>
                            </td>
                            <td class="td_cate1">
                                <select name="category1" class="tbl-category1">
                                    <option value="1" {{ $list->category1 == "1" ? "selected" : "" }}>동바리</option>
                                    <option value="2" {{ $list->category1 == "2" ? "selected" : "" }}>경량</option>
                                    <option value="3" {{ $list->category1 == "3" ? "selected" : "" }}>타일</option>
                                    <option value="4" {{ $list->category1 == "4" ? "selected" : "" }}>목공</option>
                                    <option value="5" {{ $list->category1 == "5" ? "selected" : "" }}>미장</option>
                                    <option value="6" {{ $list->category1 == "6" ? "selected" : "" }}>조적</option>
                                    <option value="7" {{ $list->category1 == "7" ? "selected" : "" }}>조경</option>
                                    <option value="8" {{ $list->category1 == "8" ? "selected" : "" }}>덕트</option>
                                    <option value="9" {{ $list->category1 == "9" ? "selected" : "" }}>금속</option>
                                    <option value="10" {{ $list->category1 == "10" ? "selected" : "" }}>전기</option>
                                    <option value="11" {{ $list->category1 == "11" ? "selected" : "" }}>청소</option>
                                    <option value="12" {{ $list->category1 == "12" ? "selected" : "" }}>잡일</option>
                                    <option value="13" {{ $list->category1 == "13" ? "selected" : "" }}>기타</option>
                                </select>
                            </td>
                            <td class="td_chkDay">
                                <select name="chk_day" class="tbl-chk_day">
                                    <option value="0" {{ $list->chk_day == 0 ? "selected" : "" }}>미출석</option>
                                    <option value="1" {{ $list->chk_day == 1 ? "selected" : "" }}>출석</option>
                                </select>
                            </td>
                            <td class="td_workerMemo">
                                <input type="text" name="{{"worker_memo[{$i}]"}}" value="{{ $list->worker_memo ?? ""  }}">
                            </td>
                            <td class="td_coCode">
                                <a href="/company/view/{{ $list->co_code }}">{{ $list->co_name }}</a>
                            </td>
                            <td class="td_workMemo">
                                <input type="text" name="{{"work_memo[{$i}"}}" value="{{ $list->work_memo ?? "" }}">
                            </td>
                            <td  class="td_workField">
                                <input type="text" name="{{"work_field[{$i}]"}}" value="{{ $list->work_field ?? "" }}">
                            </td>
                            <td class="td_dayPrice">
                                <input type="text" class="tbl-day_price" name="{{"day_price[{$i}]"}}" value="{{ ($list->day_price) }}">
                            </td>
                            <td class="td_workDay">
                                <select name="work_day" class="tbl-work_day">
                                    <option value="0.5" {{ $list->work_day == "0.5" ? "selected" : "" }}>0.5</option>
                                    <option value="1.0" {{ $list->work_day == "1.0" ? "selected" : "" }}>1.0</option>
                                    <option value="1.5" {{ $list->work_day == "1.5" ? "selected" : "" }}>1.5</option>
                                    <option value="2.0" {{ $list->work_day == "2.0" ? "selected" : "" }}>2.0</option>
                                </select>
                            </td>
                            <td class="td_totPrice">
                                <span class="tbl-tot_price">{{ number_format($list->day_price * $list->work_day) }}</span>
                                <input type="hidden" name="percent" value="{{ $list->percent}}" class="tbl-vat_percent" required>
                            </td>
                            <td class="td_vatPrice">
                                <span class="tbl-vat_price">{{ number_format( ( $list->day_price * $list->work_day ) / 100 ) }}</span>
                            </td>
                            <td class="td_calcPrice">
                                <span class="tbl-calc_price">{{ number_format( $list->day_price * $list->work_day - ( ( $list->day_price * $list->work_day ) / 100 ) ) }}</span>
                            </td>
                            <td class="td_companyPrice">
                                <input type="text" name="{{"company_price[{$i}]"}}" value="{{ number_format($list->company_price ? $list->company_price:'0') }}">
                            </td>
                            <td class="td_depositPrice">
                                <input type="text" class="tbl-deposit_price" name="{{"deposit_price[{$i}]"}}" value="{{ number_format($list->deposit_price ? $list->deposit_price:'0') }}">
                            </td>
                            <td class="td_addPrice">
                                <input type="text" class="tbl-add_price" name="{{"add_price[{$i}]"}}" value="{{ number_format($list->add_price ? $list->add_price:'0') }}">
                            </td>
                            <td class="td_unpaidPrice">
                                <span class="tbl-unpaid_price">{{ number_format( ( $list->day_price * $list->work_day ) - ($list->company_price ? $list->company_price:'0') ) }}</span>
                                <input type="hidden" name="unpaid_price" class="unpaid_price" value="{{ ( ( $list->day_price * $list->work_day ) - ($list->company_price ? $list->company_price:'0') ) }}">
                            </td>
                        </tr>
                    @endforeach
                    @if ($lists->isEmpty())
                        <tr>
                            <td colspan="19">데이터가 없습니다.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </form>
        </article> <!-- article list_contents end -->

        <article id="list-result">
            <div class="company-result">
                <span>선택항목 미수금</span>
                <a href="javascript:void(0)" class="btn-calc">계산하기</a>
                <span class="result-value">총 미수금<strong class="total_sum">0</strong> 원</span>
            </div>
        </article>

        <article id="list_bottom">
            {!! pagination2(10, ceil($paging/15)) !!}
        </article> <!-- article list_bottom end -->

    </section>

    <style>
        textarea {
            outline: none;
        }
    </style>


    <script>
        $("#btndel").on("click", function () {
            // document.getElementById("btndel").onclick = function () {
            if ($(".user_checked:checked").length == 0) {
                alert("삭제할 일정보를 선택해주세요.");
                return false;
            }

            var checkBoxArr = [];
            $(".user_checked:checked").each(function() {
                checkBoxArr.push($(this).val());     // 체크된 것만 값을 뽑아서 배열에 push
                console.log(checkBoxArr);
            });

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type  : "POST",
                url    : '{{ route('post.select_del') }}',
                dataType: 'json',
                data: {
                    del_data : checkBoxArr        // folder seq 값을 가지고 있음.
                },
                success: function(data){
                    // console.log(data);
                    // console.log(1111);
                    alert("일정보가 삭제되었습니다.");
                    location.reload();
                },
                error: function(err) {
                    // console.log(err);
                    // console.log(result);
                    // console.log(2222);
                    alert("삭제에 실패했습니다. 다시 시도해 주세요.");
                    // alert(error);
                }
            });

            // document.memberUpdate.submit();
        });

        $(".btn-calc").on("click", function () {
            // document.getElementById("btndel").onclick = function () {
            if ($(".user_checked:checked").length == 0) {
                alert("계산할 일정보를 선택해주세요.");
                return false;
            }

            var sum = 0;
            var count = $(".user_checked:checked").length;
            for(var i=0; i < count; i++ ){
                if( $(".user_checked:checked") ){
                    // var ds = $(".user_checked:checked").find('data-tot_price');
                    // var ds = $(".user_checked:checked").find('tbl-tot_price').val();
                    var ds = $(".user_checked:checked").parent().parent();
                    var ds_data = ds.find('.unpaid_price').val();
                    sum += parseInt(ds_data);
                }
            }
            $('.total_sum').html('<strong class="total_sum">'+numberWithCommas(sum)+'</strong>');

        });

        // function itemSum(obj)
        // {
        //     var sum = 0;
        //     var count = $(".user_checked:checked").length;
        //     for(var i=0; i < count; i++ ){
        //         if( $(".user_checked:checked") ){
        //             // var ds = $(".user_checked:checked").attr('data-tot_price');
        //             // var ds = $(".user_checked:checked").find('.tbl-day_price').val();
        //             // var ds = $(".user_checked:checked").parent.find('.tbl-day_price');
        //              var ds = $(".user_checked:checked").parent().parent();
        //              var ds_data = ds.find('.unpaid_price').val();
        //             sum += parseInt(ds_data);
        //         }
        //     }
        //      $('.total_sum').html('<span class="total_sum">'+numberWithCommas(sum)+'</span>');
        // }

        function itemSum() {
            var chkItem = document.querySelectorAll('.user_checked:checked');
            console.log(chkItem);
            var sum = 0;
            var totalSum = document.getElementsByClassName('total_sum');

            chkItem.forEach(function (item) {
                var itemParentTr = item.parentNode.parentNode;
                var unpaidItem = itemParentTr.getElementsByClassName('tbl-unpaid_price');
                var unpaidRawValue = unpaidItem[0].innerHTML;
                var unpaidValue = unpaidRawValue.replace(',', '');

                sum += parseInt(unpaidValue);

                console.log('chkItem : ', chkItem);
                console.log('itemParentTr : ', itemParentTr);
                console.log('unpaidItem : ', unpaidItem);
                console.log('unpaidValue : ', unpaidValue);
                console.log('unpaidValue type : ', typeof unpaidValue);

                console.log('미수금 : ', unpaidValue);
                return false;
            });
            console.log('최종 미수금 합계 : ', sum);
            console.log('미수금합계 노드 : ', totalSum);

            totalSum[0].innerHTML='<strong class="total_sum">'+numberWithCommas(sum)+'</strong>';
        }

        // document.getElementById("btnedit").onclick = function () {
        //     if ($(".user_checked:checked").length == 0) {
        //         alert("수정할 거래처를 선택해주세요.");
        //         return false;
        //     }
        //
        //     var checkBoxArr = [];
        //     $(".user_checked:checked").each(function() {
        //         checkBoxArr.push($(this).val());     // 체크된 것만 값을 뽑아서 배열에 push
        //         console.log(checkBoxArr);
        //     })
        //
        //     // $.ajax({
        //     //     type  : "POST",
        //     //     url    : "<c:url value='/folderDelete.do'/>",
        //     //     data: {
        //     //         checkBoxArr : checkBoxArr        // folder seq 값을 가지고 있음.
        //     //     },
        //     //     success: function(result){
        //     //         console.log(result);
        //     //     },
        //     //     error: function(xhr, status, error) {
        //     //         alert(error);
        //     //     }
        //     // });
        //
        //     // document.memberUpdate.submit();
        // };

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
            autoClose: true
        });

        $("input[name='to_date']").datepicker({
            language: 'ko',
            dateFormat:"yy-mm-dd",
            view: 'months',
            minView: 'months',
            clearButton: false,
            autoClose: true
        });

        $("a.view_pop").click(function() {
            window.open(this.href, "popup", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
            return false;
        });

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function percent(par,total) {
            return (par * total) / 100
        }

        function convertToNumber(x){
            return Number(x.replace(',',''));
        }



    </script>
@endsection
