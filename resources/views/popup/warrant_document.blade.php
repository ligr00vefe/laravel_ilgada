@extends("layouts/layout_pop")

@section("title")
    위임장
@endsection

@section("content")
    <link rel="stylesheet" href="http://{{$_SERVER['HTTP_HOST']}}/css/account_popup.css">

<section class="account-document warrant-doc-wrap">
    <div class="doc-top">
{{--        <div class="doc-tit"><h1>위임장</h1></div>--}}
        <a href="javascript:void(0)" class="account-close">
            <img src="../../img/close_icon.png" alt="닫기 버튼">
        </a>
    </div>{{-- //.doc-top end --}}
<input type="text" name="ttt" id="ttt">
    <div class="doc-mid">
        <div class="head-table">
            <div class="head-title">
                <h1>위임장</h1>
            </div>
            <table>
                <tbody>
                    <tr>
                        <td><span><b>성명 : </b><p></p></span><span class="float_right"><b>공사현장 : </b><p>삼성인테리어전체</p></span></td>
                    </tr>
                    <tr>
                        <td><span><b>주민번호 : </b><p></p></span><span class="float_right"><b>근로기간 : </b><p>2021-07-01 ~ 2021-07-31</p></span></td>
                    </tr>
                    <tr>
                        <td><span><b>주소 : </b><p></p></span><span class="float_right"><b>위임금액 : </b><p>별첨1 참조</p></span></td>
                    </tr>
                    <tr>
                        <td>
                            <p class="warrant-content">
                                상기 본인은 상기 공사현장에 직접 참여한 근로자로서 상기 근로기간 동안의 임금 전액을 수량함에 있어, 본인의
                                사정으로 인하여 아래 수임인에게 위임하며(노임수령, 확인서, 각서작성), 추후 귀사에 대하여 민·형사상 어떠한
                                이의를 제기치 않을 것임을 확약합니다. 임금금액은 별첨자료로 첨부합니다.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td><span><b>[수임인]</b></span></td>
                    </tr>
                    <tr>
                        <td><span><b>성명 : </b><p>홍길동</p></span></td>
                    </tr>
                    <tr>
                        <td><span><b>주민번호 : </b><p>020201-1234567</p></span></td>
                    </tr>
                    <tr>
                        <td><span><b>주소 : </b><p>부산시 00구 00길 00번지</p></span></td>
                    </tr>
                    <tr>
                        <td><span><b>계좌번호 : </b><p>농협 821084-5-8545621 홍길동</p></span></td>
                    </tr>
                </tbody>
            </table>
            <div class="head-date"><h1>2021년 7월 31일</h1></div>
        </div>{{-- //.head-table end --}}

        <div class="body-table">
            <div class="list-title"><h2>위임자 목록</h2></div>
            <table>
                <thead>
                    <tr>
                        <td colspan="8">
                            <span>회사 : 삼성 인테리어</span>
                            <span>현장 : 전체</span>
                            <span class="float_right">기간 : 2021-07-01 ~ 2021-07-31</span>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>순번</th>
                        <th>성명</th>
                        <th>주민등록번호</th>
                        <th>전화번호</th>
                        <th>주소</th>
                        <th>출력일수</th>
                        <th>총금액</th>
                        <th>영수인</th>
                    </tr>
                    <?php for($i = 0; $i < 4; $i++) { ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>홍길동</td>
                        <td>650415-1235454</td>
                        <td>010-1234-1234</td>
                        <td>서울시 동대문구 동대문동</td>
                        <td>5</td>
                        <td class="td_right">520,000</td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td colspan="5">
                            <span>합계</span>
                        </td>
                        <td class="td_right">2,080,000</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="warrant-note">
                <p>
                    위의 위임자 모곡에서 각 근로자의 서명을 받고 인력사장님의 이름 옆에 서명을 한 후
                    건설사로 보내주시면 됩니다.
                    건설사에서 사실증명 확인을 위해서 위임장을 요구하고 있습니다.
                </p>
            </div>
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
