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
            // $('#from_date').datepicker('setDate', '-7D');
            // $('#to_date').datepicker('setDate', 'toaday');
            // $('.input-datepicker').();
            // $(".input-datepicker").datepicker('setDate', new Date());
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
                            <span><a href="/post/account_list?id={{ $list->co_code }}&month={{ $list->months }}">{{ $list->co_name }}</a></span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->start_date)) }}</span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->end_date)) }}</span>
                        </td>
                        <td>
                            <span>{{ date("y-m-d", strtotime($list->start_date)) }}</span>
                        </td>
                    </tr>
                @endforeach

                @if ($lists == "")
                    <tr>
                        <td colspan="17">데이터가 없습니다 .</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="content-right">
            <ul class="document-tab">
                <li class="active"><a href="/post/account_list">노무비 청구서</a></li>
                <li class=""><a href="/post/account_wageslist">노임대장</a></li>
                <li class=""><a href="/post/account_identity">신분증</a></li>
                <li class=""><a href="/post/account_certificate">교육증</a></li>
                <li class=""><a href="/post/account_mandator">위임장</a></li>
            </ul>

            <div class="document-tab_contents">
                {{-- 첫번째 탭 --}}
                <div class="tab_content-01">
                    {{-- 첫번째 탭 첫번째 테이블 --}}
                    <table class="work-bill in-input table-2x-large">
                        <colgroup>
                            <col width="110px">
                            <col width="220px">
                            <col width="50px">
                            <col width="100px">
                            <col width="135px">
                            <col width="100px">
                            <col width="135px">
                        </colgroup>
                        <tr>
                            <th colspan="7">
                                <span>
                                    {{--{{ date("m", strtotime($list->months)) }}--}}
                                    월 노무비 청구서
                                </span>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <span>일자</span>
                            </td>
                            <td>
                                <p>
                                    {{ date("Y년 m월 t일", strtotime($co_info->end_date)) }}
                                </p>
                            </td>
                            <td rowspan="5">
                                <span>공<br>급<br>자</span>
                            </td>
                            <td class="td-text_center">
                                <span>등록번호</span>
                            </td>
                            <td colspan="3">
                                <span>{{$mem_info->co_num}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">
                                <span>회사명</span>
                            </td>
                            <td rowspan="2">
                                <p>{{$com_info->co_name}}</p>
                                <p class="float-right">귀하</p>
                            </td>
                            <td class="td-text_center">
                                <span>상호</span>
                            </td>
                            <td>
                                <span>{{$mem_info->co_name}}</span>
                            </td>
                            <td class="td-text_center">
                                <span>대표자</span>
                            </td>
                            <td>
                                <span>{{$mem_info->name}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-text_center">
                                <span>주소</span>
                            </td>
                            <td colspan="3">
                                <span>{{$mem_info->address}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="2">
                                <span>현장소재지</span>
                            </td>
                            <td rowspan="2">{{$com_info->address}}</td>
                            <td class="td-text_center">
                                <span>업태</span>
                            </td>
                            <td>
                                <span>{{$mem_info->business_type}}</span>
                            </td>
                            <td class="td-text_center">
                                <span>종목</span>
                            </td>
                            <td>
                                <span>{{$mem_info->business_item}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-text_center">
                                <span>연락처</span>
                            </td>
                            <td colspan="3" class="td-tel_num">
                                <span>{{$mem_info->tel}}</span>
                                <span>HP) {{$mem_info->phone}}</span>
                                <span>Fax) {{$mem_info->fax}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span>연락처</span>
                            </td>
                            <td>
                                <p></p>
                            </td>
                            <td colspan="2" rowspan="2" class="td-text_center">
                                <span>합계금액</span>
                            </td>
                            <td colspan="3" class="td-text_center">
                                <span>농협 000-00-000000 예금주 000</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>아래와 같이 계산 청구합니다.</p>
                            </td>
                            <td colspan="3">
                                <span>&#8361; 1,000</span>
                                <p class="float-right">원정</p>
                            </td>
                        </tr>
                    </table>

                    {{-- 첫번째 탭 두번째 테이블 --}}
                    <table class="work-calendar in-input table-2x-large">
                        <colgroup>
                            <col width="50px">
                            <col width="50px">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="">
                            <col width="50px">
                            <col width="100px">
                        </colgroup>
                        <tr>
                            <td rowspan="2">
                                <span>현장</span>
                            </td>
                            <td rowspan="2">
                                <span>직종</span>
                            </td>
                            <th colspan="31" class="th-title">
                                <span>출력상황</span>
                                <span class="work-days">{{ $co_info->start_date }} ~ {{ $co_info->end_date }}</span>
                            </th>
                            <td>
                                <span>출력</span>
                            </td>
                            <td rowspan="2">
                                <span>단가</span>
                            </td>
                            <td rowspan="2">
                                <span>노무비<br>총액</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span>1</span></td>
                            <td><span>2</span></td>
                            <td><span>3</span></td>
                            <td><span>4</span></td>
                            <td><span>5</span></td>
                            <td><span>6</span></td>
                            <td><span>7</span></td>
                            <td><span>8</span></td>
                            <td><span>9</span></td>
                            <td><span>10</span></td>
                            <td><span>11</span></td>
                            <td><span>12</span></td>
                            <td><span>13</span></td>
                            <td><span>14</span></td>
                            <td><span>15</span></td>
                            <td><span>16</span></td>
                            <td><span>17</span></td>
                            <td><span>18</span></td>
                            <td><span>19</span></td>
                            <td><span>20</span></td>
                            <td><span>21</span></td>
                            <td><span>22</span></td>
                            <td><span>23</span></td>
                            <td><span>24</span></td>
                            <td><span>25</span></td>
                            <td><span>26</span></td>
                            <td><span>27</span></td>
                            <td><span>28</span></td>
                            <td><span>29</span></td>
                            <td><span>30</span></td>
                            <td><span>31</span></td>
                            <td>
                                <span>공수</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span></span></td>
                            <td><span>
                            </span></td>

                            @for($i = 1; $i <= 31; $i++)
                                <td>
                                @foreach ( $tot_data as $key => $tot_datas)
                                    @if( $key>0)
                                        @if( $i == $tot_datas->day && $tot_datas->work_day>0)
                                                <span class="work_day">
                                                        {{ $tot_datas->work_day }}
                                                </span>
                                        @elseif($key == 1 && $i != $tot_datas->day)
                                                <span class="work_day">
                                                </span>
                                        @else

                                        @endif
                                    @endif
                                @endforeach
                                        </td>
                            @endfor

                            <td>
                                <span class="tot_work_day"></span>
                            </td>
                            <td>
                                <span class="day_price"></span>
                            </td>
                            <td>
                                <span class="tot_work_price"></span>
                            </td>
                        </tr>

                        {{----}}
                        <tr>
                            <td colspan="2"><span>합계</span></td>

                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td><span></span></td>
                            <td>
                                <span class="tot_work_day"></span>
                            </td>
                            <td>
                                <span class="day_price"></span>
                            </td>
                            <td>
                                <span class="tot_work_price"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34">
                            {{--<table>--}}
                                {{--<tr>--}}
                        {{--@foreach ($tot_data as $i => $tot_datas)--}}
                                {{--<td>--}}
                                    {{--<span>{{ $tot_datas->work_day }}</span>--}}
                                {{--</td>--}}
                            {{--@endforeach--}}
                                {{--</tr>--}}
                            {{--</table>--}}


                            </td>
                            <td>
                                <span class="day_price">합계</span>
                            </td>
                            <td>
                                <span class="tot_work_price"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34">

                            </td>
                            <td>
                                <span></span>
                            </td>
                            <td>
                                <span></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34">
                            </td>
                            <td>
                                <span class="day_price">총합계</span>
                            </td>
                            <td>
                                <span class="tot_work_price"></span>
                            </td>
                        </tr>

                    </table>
                </div>{{-- //.tab_content-01 end --}}

            </div>{{-- //.document-tab_contents end --}}
        </div>{{-- //.contents-right end --}}
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
