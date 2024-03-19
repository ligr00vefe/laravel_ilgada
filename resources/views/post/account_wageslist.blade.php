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

    <script>
        $(document).ready(function() {
            // datepicker
            $(".input-datepicker").datepicker('setDate', new Date());
        });
    </script>

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
                            <span><a href="/post/account_list?id={{ $list->co_code }}">{{ $list->co_name }}</a></span>
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
                <li class="active"><a href="/post/account_wageslist">노임대장</a></li>
                <li class=""><a href="/post/account_identity">신분증</a></li>
                <li class=""><a href="/post/account_certificate">교육증</a></li>
                <li class=""><a href="/post/account_mandator">위임장</a></li>
            </ul>

            <div class="document-tab_contents">
                {{-- 두번째 탭 --}}
                <div class="tab_content-02">
                    <div class="wage-document">
                        <div class="document-radiobox">
                            <form action="">
                                <ul>
                                    <li>
                                        <span class="radio-tit">노임대장</span>
                                        <input type="radio" name="radio_01" id="radio_01_01" value="2줄" checked>
                                        <label for="radio_01_01">2줄</label>
                                        {{--<input type="radio" name="radio_01" id="radio_01_02" value="2줄(세금/보험)">--}}
                                        {{--<label for="radio_01_02">2줄(세금/보험)</label>--}}
                                        {{--<input type="radio" name="radio_01" id="radio_01_03" value="1줄">--}}
                                        {{--<label for="radio_01_03">1줄</label>--}}
                                    </li>
                                    <li>
                                        <spans class="radio-tit">전화</spans>
                                        <input type="radio" name="radio_02" id="radio_02_01" value="미표시" checked>
                                        <label for="radio_02_01">미표시</label>
                                        {{--<input type="radio" name="radio_02" id="radio_02_02" value="표시">--}}
                                        {{--<label for="radio_02_02">표시</label>--}}
                                    </li>
                                    <li>
                                        <span class="radio-tit">정렬순</span>
                                        <input type="radio" name="radio_03" id="radio_03_01" value="단가순" checked>
                                        <label for="radio_03_01">단가순</label>
                                        {{--<input type="radio" name="radio_03" id="radio_03_02" value="이름순">--}}
                                        {{--<label for="radio_03_02">이름순</label>--}}
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <span class="radio-tit">소액부정수</span>
                                        {{--<input type="radio" name="radio_04" id="radio_04_01" value="적용" checked>--}}
                                        {{--<label for="radio_04_01">적용</label>--}}
                                        <input type="radio" name="radio_04" id="radio_04_02" value="미적용" checked>
                                        <label for="radio_04_02">미적용</label>
                                    </li>
                                    <li>
                                        <span class="radio-tit">외국인고용보험</span>
                                        <input type="radio" name="radio_05" id="radio_05_01" value="미포함" checked>
                                        <label for="radio_05_01">미포함</label>
                                        {{--<input type="radio" name="radio_05" id="radio_05_02" value="포함">--}}
                                        {{--<label for="radio_05_02">포함</label>--}}
                                    </li>
                                </ul>

                                <a href="javascript:void(0)" class="btn-create" onclick="window.open('/popup/wages_document', 'nanum', 'width=1500, height=750'); return false">노임대장 생성</a>

                            </form>
                        </div>{{-- //.wage-doc-chkbox end --}}
                        <div class="wage-note">
                            <h5 class="wage-note-tit">일용직 원천세 계산법</h5>
                            <p>
                                1. 원천세 = (임금-15만원)*0.027(2.7%) [18년기준 10만원 공공제]<br/>
                                2. 지방세 = 원천세의 10% <br/>
                                3. 국민, 의료보험 = 건설일용 8일이상인 경우(7일까지는 정산안함) <br/>
                                4. 고용보험 제외 = 외국인, 65세이상의 경우 <br/>
                                5. 의료보험 - 3.23%(18년기준 3.12%) 장기요양보험 = 건강보험료의 8.51%(18년기준 7.38%), 국민연금 - 4.5% <br/>
                                <br/>
                                참고<br/>
                                1. 소액부(不)징수 1,000원미만 소액 징수안함(187,000원의 원천세는 999원) <br/>
                                2. 일용근로자의 경우 하루단위로 정산(당일모든세금계산이 끝남)<br/>
                            </p>
                        </div>
                    </div>{{-- //.wage-document end --}}
                </div>{{-- //.tab_content-02 end --}}

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


<script>
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

</script>
@endsection
