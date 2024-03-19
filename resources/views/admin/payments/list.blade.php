@extends("layouts/admin")

@section("title")
    결제 정보
@endsection

@section("content")

    <style>
        table {
            width: 100%;
            border: 0px solid #444444;
            margin-bottom: 10px;
        }
        th, td {
            border: 0px solid #444444;
        }
    </style>

<section id="member_wrap" class="list_wrapper">

    <article id="list_head">

        <div class="head-info">
            <h1>결제 정보</h1>
            <div class="action-wrap">
                <ul>
                    <li>
                        <button class="btn-black-middle" id="btndel">선택삭제</button>
                    </li>
                    <li>
                        <button class="btn-black-middle" id="btnregister" onclick="location.href='{{ route("admin.payments.add") }}'">내역추가</button>
                    </li>

                </ul>
            </div>
        </div>

    </article> <!-- article list_head end -->

    <article id="list_contents" class="table03" style="overflow-x: auto;">
        <form action="" method="post" name="memberUpdate">
            @csrf
            @method("put")
            <table class="member-list in-input table-2x-large">
                {{--<colgroup>--}}
                    {{--<col width="2%">--}}
                    {{--<col width="3%">--}}
                    {{--<col width="3%">--}}
                    {{--<col width="5%">--}}
                    {{--<col width="3%">--}}
                    {{--<col width="4%">--}}
                    {{--<col width="4%">--}}
                    {{--<col width="5%">--}}
                    {{--<col width="6%">--}}
                    {{--<col width="6%">--}}
                    {{--<col width="6%">--}}
                    {{--<col width="6%">--}}
                    {{--<col width="7%">--}}
                {{--</colgroup>--}}
                <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="check_all" name="check_all" value="1">
                        <label for="check_all"></label>
                    </th>
                    <th>번호</th>
                    <th>아이디</th>
                    <th>업체명</th>
                    <th>사업자번호</th>
                    <th>연장기간</th>
                    <th>결제수단</th>
                    <th>입금자명</th>
                    <th>신청일</th>
                    <th>입금일</th>
                    <th>상태</th>
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
                        <td class="td_num"><span>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</span></td>
                        <td class="td_userId">
                            <span>{{ $list->user_id }}</span>
                        </td>
                        <td class="td_coName">
                            <span>{{ $list->co_name }}</span>
                        </td>
                        <td class="td_coNum">
                            <span>{{ $list->co_num }}</span>
                        </td>
                        <td class="td_period">
                            <span>{{ $list->period }}</span>
                        </td>
                        <td class="td_paymentType">
                            <span>{{ $list->payment_type }}</span>
                        </td>
                        <td class="td_name">
                            <span>{{ $list->name }}</span>
                        </td>
                        <td class="td_createdAt">
                            <span>{{ $list->created_at ?? "" }}</span>
                        </td>
                        <td class="td_paymentDate">
                            <span>{{ $list->payment_date }}</span>
                        </td>
                        <td class="td_status">
                            <select name="status">
                                <option value="N" {{ $list->status == "N" ? "selected" : "" }} >입금전
                                <option value="Y" {{ $list->status == "Y" ? "selected" : "" }}>입금완료
                            </select>
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
    $("#btndel").on("click", function () {
    // document.getElementById("btndel").onclick = function () {
        if ($(".user_checked:checked").length == 0) {
            alert("삭제할 거래처를 선택해주세요.");
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
            url    : '{{ route('admin.payments.delete') }}',
            dataType: 'json',
            data: {
                del_data : checkBoxArr
            },
            success: function(data){
                // console.log(data);
                // console.log(1111);
                alert("성공적으로 삭제했습니다.");
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
        dateFormat:"yyyy-mm",
        view: 'months',
        minView: 'months',
        clearButton: false,
        autoClose: true,
        onSelect: function(dateText, inst) {
            $("input[name='to_date']").datepicker({
                minDate: new Date(dateText),
                dateFormat:"yyyy-mm",
                clearButton: false,
                autoClose: true,
            })
        }
    });


    $("input[name='to_date']").datepicker({
        language: 'ko',
        dateFormat:"yyyy-mm",
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

</script>
@endsection
