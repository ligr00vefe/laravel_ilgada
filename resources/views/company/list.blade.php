@extends("layouts/layout")

@section("title")
    거래처 조회
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
            $('#from_date').datepicker('setDate', '-1M');
            $('#to_date').datepicker('setDate', 'toaday');
            // $('.input-datepicker').();
        });
    </script>

<section id="member_wrap" class="list_wrapper">

    <article id="list_head">

        <div class="head-info">
            <h1>거래처 조회</h1>
            <div class="action-wrap">
                <ul>
                    <li>
                        <button class="btn-black-middle" id="btndel">선택삭제</button>
                    </li>
                    {{--<li>--}}
                        {{--<button class="btn-black-middle" id="btnedit">선택수정</button>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<button class="btn-black-middle" id="btnexcel">엑셀출력</button>--}}
                    {{--</li>--}}
                    <li>
                        <button class="btn-black-middle" id="btnregister" onclick="location.href='{{ route("company.list.create") }}'">신규등록</button>
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
                        <input type="text" name="from_date" id="from_date" class="input-datepicker" autocomplete="off" value="" placeholder="2022-02-22">
                    </div>
                    <span class="tilde">~</span>
                    <div class="search-input">
                        <input type="text" name="to_date" id="to_date" class="input-datepicker" autocomplete="off" value="" placeholder="2022-02-22">
                    </div>
                </div>

                <div class="search-con">
                    <img src="/img/main_user.png" alt="노무자 아이콘">
                    <span>거래처 검색</span>
                    <div class="search-input">
                        <input type="text" name="company" value="" placeholder="거래처 검색어">
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
                    <th>상세보기</th>
                    <th>거래처명</th>
                    <th>사업자번호</th>
                    <th>대표전화</th>
                    <th>팩스</th>
                    <th>메일</th>
                    <th>세금계산서 메일</th>
                    <th>결제유형</th>
                    <th>신용</th>
                    <th>주소</th>
                    <th>등록일</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $i => $list)
                    <tr>
                        <td class="td_chk">
{{--                            <input type="hidden" name="target_key[{{$list->id}}]" value="{{ $helper->target_key }}">--}}
                            <input type="checkbox" name="check[]" id="check_{{$list->id}}" value="{{ $list->id }}" class="user_checked">
                            <label for="check_{{$list->id}}"></label>

{{--                            <input type="checkbox" id="check_{{$i}}" name="id[]" value="{{$list->id}}">--}}
{{--                            <label for="check_{{$i}}"></label>--}}
                        </td>
                        <td class="td_num">{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</td>
                        <td class="td_view">
                            <a href="/company/view/{{ $list->id }}" class="btn-view">
                                보기
                            </a>
{{--                            <a class="view_pop"  onclick="window.open('/company/view_pop/{{ $list->id }}', 'nanum', 'width=440, height=570'); return false" >--}}
{{--                                보기--}}
{{--                            </a>--}}
                        </td>
                        <td class="td_coName">
                            <input type="text" name="{{ "name[{$list->id}]" }}" value="{{ $list->co_name }}">
                        </td>
                        <td class="td_coNum">
                            <input type="text" name="{{"co_num[{$list->id}"}}" value="{{ $list->co_num }}">
                        </td>
                        <td class="td_tel">
                            <input type="text" name="{{"tel[{$list->id}]"}}" value="{{ $list->tel }}">
                        </td>
                        <td class="td_fax">
                            <input type="text" name="{{"fax[{$i}]"}}" value="{{ $list->fax ?? ""  }}">
                        </td>
                        <td class="td_email">
                            <input type="text" name="{{"email[{$i}]"}}" value="{{ $list->email ?? ""  }}">
                        </td>
                        <td class="td_vatEmail">
                            <input type="text" name="{{"vat_email[{$i}]"}}" value="{{ $list->vat_email ?? "" }}">
                        </td>
                        <td class="td_paymentType">
                            <select name="payment_type" value="{{ $list->payment_type }}" id="tbl-payment_type" class="tbl-select w300">
                                <option value="1" {{ $list->payment_type == 1 ? "selected" : "" }}>당일 결제</option>
                                <option value="2" {{ $list->payment_type == 2 ? "selected" : "" }}>15일 결제</option>
                                <option value="3" {{ $list->payment_type == 3 ? "selected" : "" }}>말일 결제</option>
                            </select>
                        </td>
                        <td class="td_credit">
                            <select name="credit" value="{{ $list->credit }}" id="tbl-credit" class="tbl-select w300">
                                <option value="A" {{ $list->credit == "A" ? "selected" : "" }}>A</option>
                                <option value="B" {{ $list->credit == "B" ? "selected" : "" }}>B</option>
                                <option value="C" {{ $list->credit == "C" ? "selected" : "" }}>C</option>
                            </select>
                        </td>
                        <td class="t-left td_address">
                            <input name="{{"address[{$i}]"}}" value="{{ $list->address ?? "" }}">
                        </td>
                        <td class="td_createdAt">
                            <span>{{ $list->created_at ?? "" }}</span>
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
        </form>
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


<script>
    $(document).ready(function() {
        let d = new Date();
        let year = d.getFullYear();
        let months = d.getMonth() ; // 월은 0에서 시작하기 때문에 +1
        let month = d.getMonth() +1; // 월은 0에서 시작하기 때문에 +1
        let day = d.getDate();
        // let from_date = year+'-'+months+'-'+day;
        // console.log(from_date);
        $('#from_date').attr('placeholder',`${year}-${months}-${day}`);
        $('#to_date').attr('placeholder',`${year}-${month}-${day}`);
    });

    $("#btndel").on("click", function () {
        // document.getElementById("btndel").onclick = function () {
        if ($(".user_checked:checked").length == 0) {
            alert("삭제할 거래처 정보를 선택해주세요.");
            return false;
        }

        var checkBoxArr = [];
        $(".user_checked:checked").each(function() {
            checkBoxArr.push($(this).val());     // 체크된 것만 값을 뽑아서 배열에 push
            console.log(checkBoxArr);
        })

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type  : "POST",
            url    : '{{ route('company.select_del') }}',
            dataType: 'json',
            data: {
                del_data : checkBoxArr        // folder seq 값을 가지고 있음.
            },
            success: function(data){
                // console.log(data);
                // console.log(1111);
                alert("거래처 정보가 삭제되었습니다.");
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

    document.getElementById("btnedit").onclick = function () {
        if ($(".user_checked:checked").length == 0) {
            alert("수정할 거래처를 선택해주세요.");
            return false;
        }

        var checkBoxArr = [];
        $(".user_checked:checked").each(function() {
            checkBoxArr.push($(this).val());     // 체크된 것만 값을 뽑아서 배열에 push
            console.log(checkBoxArr);
        })

        // $.ajax({
        //     type  : "POST",
        //     url    : "<c:url value='/folderDelete.do'/>",
        //     data: {
        //         checkBoxArr : checkBoxArr        // folder seq 값을 가지고 있음.
        //     },
        //     success: function(result){
        //         console.log(result);
        //     },
        //     error: function(xhr, status, error) {
        //         alert(error);
        //     }
        // });

        // document.memberUpdate.submit();
    };

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

</script>
@endsection
