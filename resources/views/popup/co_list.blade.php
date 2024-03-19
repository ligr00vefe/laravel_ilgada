@extends("layouts/layout_pop")

@section("title")
    거래처 목록
@endsection

@section("content")

<section id="member_wrap" class="list_wrapper post_search_wrap">

    <article id="list_head">

        <div class="head-info">
            <h1>등록된 거래처 목록</h1>
        </div>

        <div class="search-wrap">
            <form action="" method="" name="member_list_search">
                <div class="search-con search-date">
                    <img src="/img/calendar_icon2.png" alt="달력 아이콘">
                    <span>날짜검색</span>
                    <div class="search-input">
                        <input type="text" name="from_date" value="">
                        <span class="tilde">~</span>
                        <input type="text" name="to_date" value="">
                        <button type="submit">검색</button>
                    </div>
                </div>

                <div class="search-con">
                    <img src="/img/company_icon.png" alt="거래처 아이콘">
                    <span>거래처검색</span>
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
{{--                    <th>번호</th>--}}
                    <th>선택</th>
                    <th>거래처명</th>
                    <th>사업자번호</th>
                    <th>대표전화</th>
                    <th>결제유형</th>
                    <th>신용</th>
                    <th>메모</th>
                    <th>주소</th>
                    <th>등록일</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $i => $list)
                    <tr>
{{--                        <td>{{ (($page - 1) * 15) + $loop->iteration  }}</td>--}}
                        <td>
                            <a onclick="selectOpener(this)" data-id="{{ $list->id }}" data-name="{{ $list->co_name }}" data-tel="{{ $list->tel }}" data-phone="{{ $list->phone }}" data-zip_code="{{ $list->zip_code }}" data-address="{{ $list->address }}" data-detail="{{ $list->address_detail }}" data-memo="{{ $list->memo }}" class="btn-view">
                                선택
                            </a>
                        </td>
                        <td>
                            {{ $list->co_name  }}
                        </td>
                        <td>
                            {{ $list->co_num }}
                        </td>
                        <td>
                            {{ $list->tel }}
                        </td>
                        <td>
                            {{ $list->payment_type }}
                        </td>
                        <td>
                            {{ $list->credit }}
                        </td>
                        <td>
                            {{ $list->memo }}
                        </td>
                        <td>
                            {{ $list->address }}
                        </td>
                        <td>
                            <span>{{ \Carbon\Carbon::parse($list->created_at)->format('Y-m-d') }}</span>
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
       {{ pagination2(10, ceil($paging/15)) }}
    </article> <!-- article list_bottom end -->

</section>

<style>
    textarea {
        outline: none;
    }
</style>


<script>
    document.getElementById("btndel").onclick = function () {
        if ($(".user_checked:checked").length == 0) {
            alert("삭제할 거래처를 선택해주세요.");
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
        dateFormat:"yyyy-mm-dd",
        view: 'months',
        minView: 'months',
        clearButton: false,
        autoClose: true,
        onSelect: function(dateText, inst) {
            $("input[name='to_date']").datepicker({
                minDate: new Date(dateText),
                dateFormat:"yyyy-mm-dd",
                clearButton: false,
                autoClose: true,
            })
        }
    });


    $("input[name='to_date']").datepicker({
        language: 'ko',
        dateFormat:"yyyy-mm-dd",
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

    function selectOpener(obj) {
        var data_name = $(obj).attr('data-name');
        var data_id = $(obj).attr('data-id');
        var data_tel = $(obj).attr('data-tel').split('-');
        var data_phone = $(obj).attr('data-phone').split('-');
        var data_memo = $(obj).attr('data-memo');
        var data_zip_code = $(obj).attr('data-zip_code');
        var data_address = $(obj).attr('data-address');
        var data_detail = $(obj).attr('data-detail');

        // console.log(data_tel[0]+'-'+data_tel[1]+'-'+data_tel[2]);

        // console.log(data_zip_code+data_address+data_detail);

        $('#tbl-co_name',parent.opener.document).val(data_name);
        $('#tbl-co_id',parent.opener.document).val(data_id);
        $('#tbl-tel1',parent.opener.document).val(data_tel[0]);
        $('#tbl-tel2',parent.opener.document).val(data_tel[1]);
        $('#tbl-tel3',parent.opener.document).val(data_tel[2]);
        $('#tbl-phone1',parent.opener.document).val(data_phone[0]);
        $('#tbl-phone2',parent.opener.document).val(data_phone[1]);
        $('#tbl-phone3',parent.opener.document).val(data_phone[2]);
        $('#tbl-work_memo',parent.opener.document).val(data_memo);
        $('#sample6_postcode',parent.opener.document).val(data_zip_code);
        $('#sample6_address',parent.opener.document).val(data_address);
        $('#sample6_detailAddress',parent.opener.document).val(data_detail);

         window.self.close();
    }

</script>
@endsection
