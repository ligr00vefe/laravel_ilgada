@extends("layouts/layout")

@section("title")
    노무자 일정보 조회
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
                <h1>노무자 일정보</h1>
                <div class="action-wrap">
                    <ul>
{{--                        <li>--}}
{{--                            <button class="btn-black-middle" id="btncopy">선택복사</button>--}}
{{--                        </li>--}}
                        <li>
                            <button class="btn-black-middle" id="btndel">선택삭제</button>
                        </li>
                        {{--<li>
                            <button class="btn-black-middle" id="btnedit">선택수정</button>
                        </li>--}}
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
                        <img src="/img/main_user.png" alt="노무자 아이콘">
                        <span>노무자검색</span>
                        <div class="search-input">
                            <input type="text" name="term" value="" placeholder="노무자 검색어">
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
                            <th>총미지불금액</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($lists as $i => $list)

{{--                        $category_arr = ["동바리","경량", "타일", "목공", "미장", "조적", "조경", "덕트", "금속", "전기", "청소", "잡일", "기타"];--}}
                        <tr>
                            <td class="td_chk">
                                <input type="checkbox" name="check[]" id="check_{{$list->id}}" value="{{ $list->id }}" class="user_checked" onclick="itemSum(this);">
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
                                <input type="hidden" name="tot_price" class="tot_price" value="{{ ($list->day_price * $list->work_day) }}">
                                <input type="hidden" name="percent" value="{{ $list->percent}}" class="tbl-vat_percent" required>
                            </td>
                            <td class="td_vatPrice">
                                <span class="tbl-vat_price">{{ number_format( ( $list->day_price * $list->work_day ) / 100 ) }}</span>
                                <input type="hidden" name="vat_price" class="vat_price" value="{{ ( $list->day_price * $list->work_day ) / 100  }}">
                            </td>
                            <td class="td_calcPrice">
                                <span class="tbl-calc_price">{{ number_format( $list->day_price * $list->work_day - ( ( $list->day_price * $list->work_day ) / 100 ) ) }}</span>
                                <input type="hidden" name="calc_price" class="calc_price" value="{{ $list->day_price * $list->work_day - ( ( $list->day_price * $list->work_day ) / 100 )  }}">
                            </td>
                            <td class="td_companyPrice">
                                <input type="text" class="tbl-company_price" name="{{"company_price[{$i}]"}}" value="{{ number_format($list->company_price ? $list->company_price:'0') }}">
                                <input type="hidden" name="company_price" class="company_price" value="{{ $list->company_price ? $list->company_price:'0' }}">
                            </td>
                            <td class="td_depositPrice">
                                <input type="text" class="tbl-deposit_price" name="{{"deposit_price[{$i}]"}}" value="{{ number_format($list->deposit_price ? $list->deposit_price:'0') }}">
                                <input type="hidden" name="deposit_price" class="deposit_price" value="{{ $list->company_price ? $list->company_price:'0' }}">
                            </td>
                            <td class="td_addPrice">
                                <input type="text" class="tbl-add_price" name="{{"add_price[{$i}]"}}" value="{{ number_format($list->add_price ? $list->add_price:'0') }}">
                                <input type="hidden" name="add_price" class="add_price" value="{{ $list->add_price ? $list->add_price:'0' }}">
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
            <div class="worker-result ">
                <table>
                    <tbody>
                        <tr>
                            <th>총계</th>
                            <td>총 <strong class="colored_blue total_cnt">0</strong> 개의 회사</td>
                            <td>총 노임 <strong class="total_tot_price">0</strong> 원</td>
                            <td>총 수수료 <strong class="total_vat_price">0</strong> 원</td>
                            <td>총 지불금액 <strong class="total_calc_price">0</strong> 원</td>
                            <td>총 거래처입금 <strong class="total_company_price">0</strong> 원</td>
                            <td>총 지불처리 <strong class="total_deposit_price">0</strong> 원</td>
                            <td>총 추가지불 <strong class="total_add_price">0</strong> 원</td>
                            <td>총 미지불금 <strong class="total_unpaid_price">0</strong> 원</td>
                        </tr>
                    </tbody>
                </table>
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
            $(".user_checked:checked").each(function () {
                checkBoxArr.push($(this).val());     // 체크된 것만 값을 뽑아서 배열에 push
                // console.log(checkBoxArr);
            });

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST",
                url: '{{ route('post.select_del') }}',
                dataType: 'json',
                data: {
                    del_data: checkBoxArr        // folder seq 값을 가지고 있음.
                },
                success: function (data) {
                    // console.log(data);
                    // console.log(1111);
                    alert("일정보가 삭제되었습니다.");
                    location.reload();
                },
                error: function (err) {
                    // console.log(err);
                    // console.log(result);
                    // console.log(2222);
                    alert("삭제에 실패했습니다. 다시 시도해 주세요.");
                    // alert(error);
                }
            });
        });

        $(".btn-calc").on("click", function () {
            // document.getElementById("btndel").onclick = function () {
            if ($(".user_checked:checked").length == 0) {
                alert("계산할 일정보를 선택해주세요.");
                return false;
            }

            var total_tot_price = 0;
            var total_vat_price = 0;
            var total_calc_price = 0;
            var total_company_price = 0;
            var total_deposit_price = 0;
            var total_add_price = 0;
            var total_unpaid_price = 0;
            var count = $(".user_checked:checked").length;
            for(var i=0; i < count; i++ ){
                if( $(".user_checked:checked") ){
                    // var ds = $(".user_checked:checked").attr('data-tot_price');
                    // var ds = $(".user_checked:checked").find('.tbl-day_price').val();
                    // var ds = $(".user_checked:checked").parent.find('.tbl-day_price');
                    var parent_data = $(".user_checked:checked").parent().parent();
                    var tot_price = parent_data.find('.tot_price').val();
                    var vat_price = parent_data.find('.vat_price').val();
                    var calc_price = parent_data.find('.calc_price').val();
                    var company_price = parent_data.find('.company_price').val();
                    var deposit_price = parent_data.find('.deposit_price').val();
                    var add_price = parent_data.find('.add_price').val();
                    var unpaid_price = parent_data.find('.unpaid_price').val();

                    total_tot_price += parseInt(tot_price);
                    total_vat_price += parseInt(vat_price);
                    total_calc_price += parseInt(calc_price);
                    total_company_price += parseInt(company_price);
                    total_deposit_price += parseInt(deposit_price);
                    total_add_price += parseInt(add_price);
                    total_unpaid_price += parseInt(unpaid_price);
                }
            }
            $('.total_cnt').html('<strong class="total_cnt">'+numberWithCommas(count)+'</strong>');
            $('.total_tot_price').html('<strong class="total_tot_price">'+numberWithCommas(total_tot_price)+'</strong>');
            $('.total_vat_price').html('<strong class="total_vat_price">'+numberWithCommas(total_vat_price)+'</strong>');
            $('.total_calc_price').html('<strong class="total_calc_price">'+numberWithCommas(total_calc_price)+'</strong>');
            $('.total_company_price').html('<strong class="total_company_price">'+numberWithCommas(total_company_price)+'</strong>');
            $('.total_deposit_price').html('<strong class="total_deposit_price">'+numberWithCommas(total_deposit_price)+'</strong>');
            $('.total_add_price').html('<strong class="total_add_price">'+numberWithCommas(total_add_price)+'</strong>');
            $('.total_unpaid_price').html('<strong class="total_unpaid_price">'+numberWithCommas(total_unpaid_price)+'</strong>');

        });

        // function itemSum(obj)
        // {
        //     var total_tot_price = 0;
        //     var total_vat_price = 0;
        //     var total_calc_price = 0;
        //     var total_company_price = 0;
        //     var total_deposit_price = 0;
        //     var total_add_price = 0;
        //     var total_unpaid_price = 0;
        //     var count = $(".user_checked:checked").length;
        //     for(var i=0; i < count; i++ ){
        //         if( $(".user_checked:checked") ){
        //             // var ds = $(".user_checked:checked").attr('data-tot_price');
        //             // var ds = $(".user_checked:checked").find('.tbl-day_price').val();
        //             // var ds = $(".user_checked:checked").parent.find('.tbl-day_price');
        //             var parent_data = $(".user_checked:checked").parent().parent();
        //             var tot_price = parent_data.find('.tot_price').val();
        //             var vat_price = parent_data.find('.vat_price').val();
        //             var calc_price = parent_data.find('.calc_price').val();
        //             var company_price = parent_data.find('.company_price').val();
        //             var deposit_price = parent_data.find('.deposit_price').val();
        //             var add_price = parent_data.find('.add_price').val();
        //             var unpaid_price = parent_data.find('.unpaid_price').val();
        //
        //             total_tot_price += parseInt(tot_price);
        //             total_vat_price += parseInt(vat_price);
        //             total_calc_price += parseInt(calc_price);
        //             total_company_price += parseInt(company_price);
        //             total_deposit_price += parseInt(deposit_price);
        //             total_add_price += parseInt(add_price);
        //             total_unpaid_price += parseInt(unpaid_price);
        //         }
        //     }
        //     $('.total_cnt').html('<span class="total_cnt">'+numberWithCommas(count)+'</span>');
        //     $('.total_tot_price').html('<span class="total_tot_price">'+numberWithCommas(total_tot_price)+'</span>');
        //     $('.total_vat_price').html('<span class="total_vat_price">'+numberWithCommas(total_vat_price)+'</span>');
        //     $('.total_calc_price').html('<span class="total_calc_price">'+numberWithCommas(total_calc_price)+'</span>');
        //     $('.total_company_price').html('<span class="total_company_price">'+numberWithCommas(total_company_price)+'</span>');
        //     $('.total_deposit_price').html('<span class="total_deposit_price">'+numberWithCommas(total_deposit_price)+'</span>');
        //     $('.total_add_price').html('<span class="total_add_price">'+numberWithCommas(total_add_price)+'</span>');
        //     $('.total_unpaid_price').html('<span class="total_unpaid_price">'+numberWithCommas(total_unpaid_price)+'</span>');
        // }

        function itemSum() {
            var chkItem = document.querySelectorAll('.user_checked:checked');
            // console.log(chkItem);
            var count = chkItem.length;
            var total_tot_price = 0;
            var total_vat_price = 0;
            var total_calc_price = 0;
            var total_company_price = 0;
            var total_deposit_price = 0;
            var total_add_price = 0;
            var total_unpaid_price = 0;
            var totCntNode = document.getElementsByClassName('total_cnt');
            var totTotPriceNode = document.getElementsByClassName('total_tot_price');
            var totVatPriceNode = document.getElementsByClassName('total_vat_price');
            var totCalcPriceNode = document.getElementsByClassName('total_calc_price');
            var totCompanyPriceNode = document.getElementsByClassName('total_company_price');
            var totDepositPriceNode = document.getElementsByClassName('total_deposit_price');
            var totAddPriceNode = document.getElementsByClassName('total_add_price');
            var totUnpaidPriceNode = document.getElementsByClassName('total_unpaid_price');

            chkItem.forEach(function (item) {
                var itemParentTr = item.parentNode.parentNode;

                var totPriceItem = itemParentTr.getElementsByClassName('tbl-tot_price');
                var vatPriceItem = itemParentTr.getElementsByClassName('tbl-vat_price');
                var calcPriceItem = itemParentTr.getElementsByClassName('tbl-calc_price');
                var companyPriceItem = itemParentTr.getElementsByClassName('tbl-company_price');
                var depositPriceItem = itemParentTr.getElementsByClassName('tbl-deposit_price');
                var addPriceItem = itemParentTr.getElementsByClassName('tbl-add_price');
                var unpaidPriceItem = itemParentTr.getElementsByClassName('tbl-unpaid_price');

                var totPriceRawValue = totPriceItem[0].innerHTML;
                var vatPriceRawValue = vatPriceItem[0].innerHTML;
                var calcPriceRawValue = calcPriceItem[0].innerHTML;
                var companyPriceRawValue = companyPriceItem[0].value;
                var depositPriceRawValue = depositPriceItem[0].value;
                var addPriceRawValue = addPriceItem[0].value;
                var unpaidPriceRawValue = unpaidPriceItem[0].innerHTML;

                var totPriceValue = totPriceRawValue.replace(',', '');
                var vatPriceValue = vatPriceRawValue.replace(',', '');
                var calcPriceValue = calcPriceRawValue.replace(',', '');
                var companyPriceValue = companyPriceRawValue.replace(',', '');
                var depositPriceValue = depositPriceRawValue.replace(',', '');
                var addPriceValue = addPriceRawValue.replace(',', '');
                var unpaidPriceValue = unpaidPriceRawValue.replace(',', '');


                total_tot_price += parseInt(totPriceValue);
                total_vat_price += parseInt(vatPriceValue);
                total_calc_price += parseInt(calcPriceValue);
                total_company_price += parseInt(companyPriceValue);
                total_deposit_price += parseInt(depositPriceValue);
                total_add_price += parseInt(addPriceValue);
                total_unpaid_price += parseInt(unpaidPriceValue);

                console.log('chkItem : ', chkItem);
                console.log('count : ', count);
                console.log('itemParentTr : ', itemParentTr);
                console.log('unpaidItem : ', unpaidPriceItem);
                console.log('unpaidValue : ', unpaidPriceRawValue);
                console.log('unpaidValue type : ', typeof unpaidPriceValue);

                console.log('미수금 : ', unpaidPriceValue);
                return false;
            });
            console.log('미수금합계 노드 : ', );

            totCntNode[0].innerHTML = '<strong class="total_cnt">'+numberWithCommas(count)+'</strong>';
            totTotPriceNode[0].innerHTML = '<strong class="total_tot_price">'+numberWithCommas(total_tot_price)+'</strong>';
            totVatPriceNode[0].innerHTML = '<strong class="total_vat_price">'+numberWithCommas(total_vat_price)+'</strong>';
            totCalcPriceNode[0].innerHTML ='<strong class="total_calc_price">'+numberWithCommas(total_calc_price)+'</strong>';
            totCompanyPriceNode[0].innerHTML ='<strong class="total_company_price">'+numberWithCommas(total_company_price)+'</strong>';
            totDepositPriceNode[0].innerHTML ='<strong class="total_deposit_price">'+numberWithCommas(total_deposit_price)+'</strong>';
            totAddPriceNode[0].innerHTML = '<strong class="total_add_price">'+numberWithCommas(total_add_price)+'</strong>';
            totUnpaidPriceNode[0].innerHTML = '<strong class="total_unpaid_price">'+numberWithCommas(total_unpaid_price)+'</strong>';
        }

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



    </script>
@endsection
