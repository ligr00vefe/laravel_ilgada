@extends("layouts/layout_pop")

@section("title")
    노임대장
@endsection

@section("content")
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/account_popup.css">

<section class="account-document wages-doc-wrap">
    <div class="doc-top">
        <div class="doc-tit"><h1>노임대장</h1></div>
        <a href="javascript:void(0)" class="account-close">
            <img src="../../img/close_icon.png" alt="닫기 버튼">
        </a>
        <div class="wages-option">
            <span>노임대장 : 2줄</span>
            <span>전화 : 미표시</span>
            <span>정렬순 : 단가순</span>
            <span>소액부정수 : 적용</span>
            <span>외국인고용보험 : 미포함</span>
        </div>
    </div>{{-- //.doc-top end --}}

    <div class="doc-mid">
        <div class="head-table">
            <table>
                <tbody>
                <tr>
                    <th>현장명</th>
                    <th>전체</th>
                    <th rowspan="2">기<br/>간</th>
                    <th>2021년 7월 1일</th>
                    <th rowspan="2">31일간</th>
                    <th rowspan="2" class="th_title">삼성인테리어 - 전체</th>
                    <th>원천세<br/>공제금액</th>
                    <th>국민의료<br/>정산날짜</th>
                    <th>고용보험</th>
                    <th>의료보험</th>
                    <th>정기요양</th>
                    <th>국민연금</th>
                </tr>
                <tr>
                    <th>공중명</th>
                    <td></td>
                    <td>2021년 7월 31일</td>
                    <td class="td_right"></td>
                    <td></td>
                    <td class="td_right td_insurance1">0.008</td>
                    <td class="td_right td_insurance2">0.0323</td>
                    <td class="td_right td_regular_care">0.0851</td>
                    <td class="td_right td_pension">0.045</td>
                </tr>
                </tbody>
            </table>
        </div>{{-- //.head-table end --}}

        <div class="body-table">
            <table>
                <thead>
                    <tr>
                        <th rowspan="3">순번</th>
                        <th rowspan="3">항목</th>
                        <th colspan="4">노무자정보</th>
                        <th colspan="16">출력상황</th>
                        <th rowspan="3">일수</th>
                        <th rowspan="3">공수</th>
                        <th colspan="2">노무비</th>
                        <th colspan="4">세액/보험 공제</th>
                        <th rowspan="3">차인지급액</th>
                        <th rowspan="3">영수</th>
                    </tr>
                    <tr>
                        <th rowspan="2">성명</th>
                        <th rowspan="2">주민등록번호</th>
                        <th rowspan="2">전화번호</th>
                        <th rowspan="2">주소</th>

                        {{-- 날짜 시작--}}
                        <th class="th_day th_num1">1</th>
                        <th class="th_day th_num2">2</th>
                        <th class="th_day th_num3">3</th>
                        <th class="th_day th_num4">4</th>
                        <th class="th_day th_num5">5</th>
                        <th class="th_day th_num6">6</th>
                        <th class="th_day th_num7">7</th>
                        <th class="th_day th_num8">8</th>
                        <th class="th_day th_num9">9</th>
                        <th class="th_day th_num10">10</th>
                        <th class="th_day th_num11">11</th>
                        <th class="th_day th_num12">12</th>
                        <th class="th_day th_num13">13</th>
                        <th class="th_day th_num14">14</th>
                        <th class="th_day th_num15">15</th>
                        <th class="th_day th_numEmpty"></th>

                        <th rowspan="2">단가</th>
                        <th rowspan="2">총액</th>
                        <th>갑근세</th>
                        <th>국민연금</th>
                        <th>고용보험</th>
                        <th rowspan="2">공제액계</th>
                    </tr>
                    <tr>
                        <th class="th_day th_num16">16</th>
                        <th class="th_day th_num17">17</th>
                        <th class="th_day th_num18">18</th>
                        <th class="th_day th_num19">19</th>
                        <th class="th_day th_num20">20</th>
                        <th class="th_day th_num21">21</th>
                        <th class="th_day th_num22">22</th>
                        <th class="th_day th_num23">23</th>
                        <th class="th_day th_num24">24</th>
                        <th class="th_day th_num25">25</th>
                        <th class="th_day th_num26">26</th>
                        <th class="th_day th_num27">27</th>
                        <th class="th_day th_num28">28</th>
                        <th class="th_day th_num29">29</th>
                        <th class="th_day th_num30">30</th>
                        <th class="th_day th_num31">31</th>
                        <th>주민세</th>
                        <th>건강보험</th>
                        <th>장기요양</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<5; $i++) { ?>
                    <tr>
                        <td rowspan="2" class="td_info">{{ 5 - $i }}</td>
                        <td rowspan="2" class="td_info"></td>
                        <td rowspan="2" class="td_info"></td>
                        <td rowspan="2" class="td_info"></td>
                        <td rowspan="2" class="td_info"></td>
                        <td rowspan="2" class="td_info"></td>
                        <td class="td_day td_num1"></td>
                        <td class="td_day td_num2"></td>
                        <td class="td_day td_num3"></td>
                        <td class="td_day td_num4"></td>
                        <td class="td_day td_num5"></td>
                        <td class="td_day td_num6"></td>
                        <td class="td_day td_num7"></td>
                        <td class="td_day td_num8"></td>
                        <td class="td_day td_num9"></td>
                        <td class="td_day td_num10"></td>
                        <td class="td_day td_num11"></td>
                        <td class="td_day td_num12"></td>
                        <td class="td_day td_num13"></td>
                        <td class="td_day td_num14"></td>
                        <td class="td_day td_num15"></td>
                        <td class="td_day td_numEmpty"></td>
                        <td rowspan="2" class="td_center">1</td>
                        <td rowspan="2" class="td_center">40</td>
                        <td rowspan="2" class="td_right">0</td>
                        <td rowspan="2" class="td_right">0</td>
                        <td class="td_right">0</td>
                        <td class="td_right">0</td>
                        <td class="td_right">0</td>
                        <td rowspan="2" class="td_right">0</td>
                        <td rowspan="2" class="td_right">0</td>
                        <td rowspan="2" class="td_right"></td>
                    </tr>
                    <tr>
                        <td class="td_day td_num16"></td>
                        <td class="td_day td_num17"></td>
                        <td class="td_day td_num18"></td>
                        <td class="td_day td_num19"></td>
                        <td class="td_day td_num20"></td>
                        <td class="td_day td_num21"></td>
                        <td class="td_day td_num22"></td>
                        <td class="td_day td_num23"></td>
                        <td class="td_day td_num24"></td>
                        <td class="td_day td_num25"></td>
                        <td class="td_day td_num26"></td>
                        <td class="td_day td_num27"></td>
                        <td class="td_day td_num28"></td>
                        <td class="td_day td_num29"></td>
                        <td class="td_day td_num30"></td>
                        <td class="td_day td_num31"></td>
                        <td class="td_right">0</td>
                        <td class="td_right">0</td>
                        <td class="td_right">0</td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td rowspan="2" colspan="2" class="td_info">합계</td>
                        <td rowspan="2" colspan="2" class="td_info">인원수 : 5</td>
                        <td rowspan="2" colspan="2" class="td_info"></td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum td_numEmpty"></td>
                        <td rowspan="2" class="td_center">17</td>
                        <td rowspan="2" class="td_center">20.0</td>
                        <td rowspan="2" colspan="2" class="td_right">2,240,000</td>
                        <td rowspan="2" colspan="3" class="td_right"></td>
                        <td rowspan="2" class="td_right">17,920</td>
                        <td rowspan="2" class="td_right">2,222,000</td>
                        <td rowspan="2" class="td_right"></td>
                    </tr>
                    <tr>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                        <td class="td_daySum">0.0</td>
                    </tr>
                </tfoot>
            </table>
        </div>{{-- //.body-table end --}}
    </div>

    <div class="btn-wrap">
        <a href="javascript:void(0)" class="btn-cancel btn01 account-close">취소</a>
        <a href="javascript:void(0)" class="btn-download btn01">다운로드</a>
    </div>
</section>

<script>
    $(document).ready(function(){
        $('.account-close').on('click', function(){
            -window.self.close();
        });
    })
</script>
@endsection
