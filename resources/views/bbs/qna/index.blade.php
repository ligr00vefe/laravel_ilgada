@extends("layouts/layout")

@section("title")
    문의사항 - 리스트
@endsection

@section("content")


    <section id="member_wrap" class="list_wrapper">

        <article id="list_head">

            <div class="head-info">
                <h1>문의사항</h1>
                <div class="action-wrap">
                    <ul>
                        <li>
                            <button class="btn-black-middle" id="btndel">선택삭제</button>
                        </li>
                        <li>
                            <button class="btn-black-middle" id="btnregister" onclick="location.href='/qna/add'">신규등록</button>
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
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="check_all" name="check_all" value="1">
                            <label for="check_all"></label>
                        </th>
                        <th>번호</th>
                        <th>제목</th>
                        <th>작성자</th>
                        <th>작성일</th>
                        <th>조회</th>
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
                            <td class="td_subject">
                                <a href="/qna/view/{{ $list->id }}">
                                    <span><i class="fas fa-lock"></i>{{ $list->subject }}</span>
                                </a>
                            </td>
                            <td class="td_userId">
                                <span>{{ $list->user_id  }}</span>
                            </td>
                            <td class="td_createdAt">
                                <span>{{ date("y-m-d", strtotime($list->created_at)) }}</span>
                            </td>
                            <td class="td_hit">
                                <span>{{ $list->hit }}</span>
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
                alert("삭제할 게시물을 선택해주세요.");
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
                url    : '{{ route('qna.del') }}',
                dataType: 'json',
                data: {
                    del_data : checkBoxArr        // folder seq 값을 가지고 있음.
                },
                success: function(data){
                    // console.log(data);
                    // console.log(1111);
                    alert("게시물이 삭제되었습니다.");
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

        document.getElementById("check_all").onclick = function (e) {
            var checked = e.target.checked;
            var checkbox = document.querySelectorAll(".user_checked");

            Array.prototype.forEach.call(checkbox, function(i, v){
                i.checked = checked;
            });
        };

        $("a.view_pop").click(function() {
            window.open(this.href, "popup", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
            return false;
        });

    </script>
@endsection
