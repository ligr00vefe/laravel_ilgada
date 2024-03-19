@extends("layouts/layout")

@section("title")
    노무자 조회
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

    <section id="member_wrap" class="list_wrapper">

        <article id="list_head">

            <div class="head-info">
                <h1>노무자 조회</h1>
                <div class="action-wrap">
                    <ul>
                        <li >
                            <button class="btn-black-middle" id="btndel">선택삭제</button>
                        </li>
                        {{--<li>--}}
                            {{--<button class="btn-black-middle" id="btnedit">선택수정</button>--}}
                        {{--</li>--}}
                        <li>
                            <button class="btn-black-middle" id="btnregister" onclick="location.href='{{ route("worker.list.create") }}'">신규등록</button>
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
                            <input type="text" name="from_date" id="from_date" value="">
                        </div>
                        <span class="tilde">~</span>
                        <div class="search-input">
                            <input type="text" name="to_date" id="to_date" value="">
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
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="check_all" name="check_all" value="1">
                            <label for="check_all"></label>
                        </th>
                        <th>번호</th>
                        <th>상세보기</th>
                        <th>이름</th>
                        <th>주민번호</th>
                        <th>바코드</th>
                        <th>주소</th>
                        <th>연락처1</th>
                        <th>연락처2</th>
                        <th>분야</th>
                        <th>세부분야</th>
                        <th>출근수</th>
                        <th>신용</th>
                        <th>수수료율(%)</th>
                        <th>성별</th>
                        <th>은행</th>
                        <th>계좌번호</th>
                        <th>자차유무</th>
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
                            <td class="td_num">
                                <span>{{ ($lists->total()-$loop->index)-(($lists->currentpage()-1) * $lists->perpage() ) }}</span>
                            </td>
                            <td class="td_view">
                                <a href="/worker/view/{{ $list->id }}" class="btn-view">
                                    보기
                                </a>
                                {{--<a class="view_pop"  onclick="window.open('/worker/view_pop/{{ $list->id }}', 'nanum', 'width=440, height=570'); return false" >--}}
                                    {{--보기--}}
                                {{--</a>--}}
                            </td>
                            <td class="td_name">
                                <input type="text" name="{{ "name[{$list->id}]" }}" value="{{ $list->name  }}" readonly disabled>
                            </td>
                            <td class="td_rsNo">
                                <input type="text" name="{{"rsNo[{$list->id}"}}" value="{{ $list->rsNo }}" readonly disabled>
                            </td>
                            <td class="td_targetKey">
                                <input type="text" name="{{"target_key[{$list->id}]"}}" value="{{ $list->target_key }}">
                            </td>
                            <td class="td_address">
                                <input type="text" name="{{"address[{$i}]"}}" value="{{ $list->address ?? ""  }}">
                            </td>
                            <td class="td_tel">
                                <input type="text" name="{{"tel[{$i}]"}}" value="{{ $list->tel ?? ""  }}">
                            </td>
                            <td class="td_phone">
                                <input type="text" name="{{"phone[{$i}"}}" value="{{ $list->phone ?? "" }}">
                            </td>
                            <td class="td_cate1">
                                <select name="category1">
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
                            <td class="td_cate2">
                                <input type="text" name="{{"category2[{$i}]"}}" value="{{ $list->category2 ?? "" }}">
                            </td>
                            <td class="td_chkDays">
                                <input type="text" name="{{"chk_days[{$i}]"}}" value="{{ $list->chk_days ?? "" }}">
                            </td>
                            <td class="td_credit">
                                <select name="credit">
                                    <option value="A" {{ $list->credit == "A" ? "selected" : "" }}>A</option>
                                    <option value="B" {{ $list->credit == "B" ? "selected" : "" }}>B</option>
                                    <option value="C" {{ $list->credit == "C" ? "selected" : "" }}>C</option>
                                </select>
                            </td>
                            <td class="td_percent">
                                <input type="text" name="{{"percent[{$i}]"}}" value="{{ $list->percent ?? "" }}">
                            </td>
                            <td class="td_gender">
                                <select name="gender">
                                    <option value="1" {{ $list->gender == "1" ? "selected" : "" }}>남자</option>
                                    <option value="2" {{ $list->gender == "2" ? "selected" : "" }}>여자</option>
                                </select>
                            </td>
                            <td class="td_bank">
                                <input type="text" name="{{"bank[{$i}]"}}" value="{{ $list->bank ?? "" }}">
                            </td>
                            <td class="td_bankNum">
                                <input type="text" name="{{"bank_num[{$i}]"}}" value="{{ $list->bank_num ?? "" }}">
                            </td>
                            <td class="td_carYn">
                                <select name="car_yn">
                                    <option value="Y" {{ $list->car_yn == "Y" ? "selected" : "" }}>유</option>
                                    <option value="N" {{ $list->car_yn == "N" ? "selected" : "" }}>무</option>
                                </select>
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
        $("#btndel").on("click", function () {
            // document.getElementById("btndel").onclick = function () {
            if ($(".user_checked:checked").length == 0) {
                alert("삭제할 노무자 정보를 선택해주세요.");
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
                url    : '{{ route('worker.select_del') }}',
                dataType: 'json',
                data: {
                    del_data : checkBoxArr        // folder seq 값을 가지고 있음.
                },
                success: function(data){
                    // console.log(data);
                    // console.log(1111);
                    alert("노무자 정보가 삭제되었습니다.");
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
