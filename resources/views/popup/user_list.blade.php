@extends("layouts/layout_pop")

@section("title")
    노무자 검색
@endsection

@section("content")

<script>
    $(document).ready(function() {
        // datepicker
        $(".input-datepicker").datepicker('setDate', new Date());
    });
</script>

<section id="member_wrap" class="list_wrapper post_search_wrap">

    <article id="list_head">

        <div class="head-info">
            <h1>등록된 노무자 목록</h1>
        </div>

        <div class="search-wrap">
            <form action="" method="" name="member_list_search">
                <div class="search-con search-date">
                    <img src="/img/calendar_icon2.png" alt="달력 아이콘">
                    <span>날짜검색</span>
                    <div class="search-input">
                        <input type="text" name="from_date" value="" placeholder="시작날짜">
                        <span class="tilde">~</span>
                        <input type="text" name="to_date" value="" placeholder="완료날짜">
                        <button type="submit">검색</button>
                    </div>
                </div>

                <div class="search-con">
                    <img src="/img/main_user.png" alt="노무자 아이콘">
                    <span>노무자검색</span>
                    <div class="search-input">
                        <input type="text" name="worker" value="" placeholder="노무자 검색어">
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
                <colgroup>
                    <col width="3%">
                    <col width="3%">
                    <col width="5%">
                    <col width="3%">
                    <col width="4%">
                    <col width="4%">
                    <col width="5%">
                    <col width="6%">
                </colgroup>
                <thead>
                <tr>
{{--                    <th>번호</th>--}}
                    <th>선택</th>
                    <th>노무자명</th>
                    <th>생년월일</th>
                    <th>성별</th>
                    <th>연락처</th>
                    <th>출근수</th>
                    <th>신용</th>
                    <th>등록일</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lists as $i => $list)
                    <tr>
{{--                        <td>{{ (($page - 1) * 15) + $loop->iteration  }}</td>--}}
                        <td>
                            <a onclick="selectOpener(this)" data-id="{{ $list->id }}" data-name="{{ $list->name }}" data-percent="{{ $list->percent }}" data-memo="{{ $list->memo }}" class="btn-view">
                                선택
                            </a>
                        </td>
                        <td>
                            {{ $list->name  }}
                        </td>
                        <td>
                            {{ $list->rsNo  }}
                        </td>
                        <td>
                            {{ $list->gender  }}
                        </td>
                        <td>
                            {{ $list->phone  }}
                        </td>
                        <td>
                            {{ $list->chk_days  }}
                        </td>
                        <td>
                            {{ $list->credit  }}
                        </td>
                        <td>
                            {{ $list->created_at }}
                        </td>
                    </tr>
                @endforeach
                @if ($lists->isEmpty())
                    <tr>
                        <td colspan="8">데이터가 없습니다.</td>
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

    $(document).ready(function() {
    });

    function selectOpener(obj) {
        var data_name = $(obj).attr('data-name');
        var data_id = $(obj).attr('data-id');
        var data_percent = $(obj).attr('data-percent');
        var data_memo = $(obj).attr('data-memo');

        // console.log(data_name);

        $('#tbl-name',parent.opener.document).val(data_name);
        $('#tbl-id',parent.opener.document).val(data_id);
        $('#tbl-vat_percent',parent.opener.document).val(data_percent);
        $('#tbl-worker_memo',parent.opener.document).val(data_memo);

        window.self.close();
    }

</script>
@endsection
