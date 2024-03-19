@extends("layouts/layout")

@section("title")
    일일정보 등록
@endsection

@section("content")
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/post.js"></script>
    <script>
        $(document).ready(function() {
            $( ".tbl-datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

            $('.tbl-linkRelay').on('click', function(){
                $(this).siblings('.tbl-isLinked').click();
            });
        });
    </script>

    <section id="member_register">

        <div class="head-info">
            <h1>일일정보 등록</h1>
        </div>

        <div class="input-wrap table02">

            <form action="/post/register" method="post" name="register_form" >
                @csrf
                <table id="register-table">
                    <input type="hidden" name="provider_seq" value="{{session()->get("user_code")}}">
                    <tbody>
                    <tr>
                        <th>
                            <label for="tbl-work_date" class="required_mark">작업일</label>
                        </th>
                        <td>
                            <input type="text" name="work_date" id="tbl-work_date" required class="tbl-datepicker w300" autocomplete="off" value="{{ $_GET['from_date'] ?? "" }}">
                        </td>
                        <th>
                            <label for="tbl-chk_date" class="required_mark">출석여부</label>
                        </th>
                        <td>
                            <select name="chk_date" id="tbl-chk_date" class="tbl-select w300" required>
                                <option disabled>선택하세요</option>
                                <option value="1">출석함</option>
                                <option value="0">미출석</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-category1" class="required_mark">분야</label>
                        </th>
                        <td>
                            <select name="category1" class="tbl-select w300" required>
                                <option disabled>선택하세요</option>
                                <option value="1">동바리</option>
                                <option value="2">경량</option>
                                <option value="3">타일</option>
                                <option value="4">목공</option>
                                <option value="5">미장</option>
                                <option value="6">조적</option>
                                <option value="7">조경</option>
                                <option value="8">덕트</option>
                                <option value="9">금속</option>
                                <option value="10">전기</option>
                                <option value="11">청소</option>
                                <option value="12">잡일</option>
                                <option value="13">기타</option>
                            </select>
                        </td>
                        <th>
                            <label for="tbl-work_field" class="required_mark">작업현장</label>
                        </th>
                        <td>
                            <input type="text" name="work_field" id="tbl-work_field" class="tbl-input w500" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-name" class="required_mark">노무자이름</label>
                        </th>
                        <td>
                            <input type="text" name="name" id="tbl-name" required class="tbl-input w300 tbl-linkRelay" readonly>
                            <input type="hidden" name="user_code" id="tbl-id" value="">
                            <input type="button" class="btn-search btn01 tbl-isLinked" onclick="window.open('/popup/user_list/', 'nanum', 'width=1200, height=600'); return false" value="검색"><br>
                        </td>
                        <th>
                            <label for="tbl-worker_memo" class="required_mark">노무자 설명</label>
                        </th>
                        <td>
                            <input type="text" name="worker_memo" id="tbl-worker_memo" class="tbl-input w500" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-co_name" class="required_mark">거래처명</label>
                        </th>
                        <td>
                            <input type="text" name="co_name" id="tbl-co_name" required class="tbl-input w300 tbl-linkRelay" readonly>
                            <input type="hidden" name="co_code" id="tbl-co_id" value="">
                            <input type="button" class="btn-search btn01 tbl-isLinked" onclick="window.open('/popup/co_list/', 'nanum', 'width=1200, height=600'); return false" value="검색"><br>
                        </td>
                        <th>
                            <label for="tbl-work_memo" class="required_mark">거래처 설명</label>
                        </th>
                        <td>
                            <input type="text" name="work_memo" id="tbl-work_memo" class="tbl-input w500" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-tel">거래처 연락처</label>
                        </th>
                        <td>
                            <input type="hidden" name="tel" id="tbl-tel" class="tbl-input w80">
                            <input type="text" name="tel1" id="tbl-tel1" class="tbl-input w80 type_tel" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="tel2" id="tbl-tel2" class="tbl-input w80 type_tel" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="tel3" id="tbl-tel3" class="tbl-input w80 type_tel" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                        </td>
                        <th>
                            <label for="tbl-phone">거래처 휴대전화</label>
                        </th>
                        <td>
                            <input type="hidden" name="phone" id="tbl-phone" class="tbl-input w80">
                            <input type="text" name="phone1" id="tbl-phone1" class="tbl-input w80 type_tel" maxlength="3" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="phone2" id="tbl-phone2" class="tbl-input w80 type_tel" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="phone3" id="tbl-phone3" class="tbl-input w80 type_tel" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="sample6_address">거래처 주소</label>
                        </th>
                        <td colspan="3">
                            <input type="text" id="sample6_postcode" name="zip_code" class="tbl-input w100" placeholder="우편번호" required>
                            <input type="button" class="btn-find btn01" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                            <input type="text" class="tbl-input w500" name="address" id="sample6_address" placeholder="주소" required><br>
                            <input type="text" id="sample6_detailAddress" name="address_detail" class="tbl-input w500" placeholder="상세주소" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-day_price" class="required_mark">단가</label>
                        </th>
                        <td>
                            <input type="text" name="day_price" id="tbl-day_price" value="0" required class="tbl-input w300" onchange="autoPriceCalc()" onkeyup="onlynumberic(event)">
                        </td>
                        <th>
                            <label for="tbl-work_day" class="required_mark">공수</label>
                        </th>
                        <td>
                            <select name="work_day" id="tbl-work_day" class="tbl-select w300" onchange="autoPriceCalc()" required>
                                <option disabled>선택하세요</option>
                                <option value="0.5">0.5</option>
                                <option value="1.0">1.0</option>
                                <option value="1.5">1.5</option>
                                <option value="2.0">2.0</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-tot_price" class="required_mark">총노임</label>
                        </th>
                        <td>
                            <span id="tbl-tot_price" class="tbl-span tot_price w300" required></span>
                        </td>
                        <th>
                            <label for="tbl-vat_price" class="required_mark">수수료</label>
                        </th>
                        <td>
                            <span id="tbl-vat_price" class="tbl-span percent w300"></span>
                            <input type="hidden" name="percent" value="" id="tbl-vat_percent" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-calc_price" class="required_mark">지불금액</label>
                        </th>
                        <td>
                            <span id="tbl-calc_price" class="tbl-span calc_price w300" required></span>
                        </td>
                        <th>
                            <label for="tbl-company_price" class="required_mark">거래처입금</label>
                        </th>
                        <td>
                            <input type="text" name="company_price" id="tbl-company_price" value="0" class="tbl-input w300" onkeyup="onlynumberic(event)" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-deposit_price" class="required_mark">지불처리</label>
                        </th>
                        <td>
                            <input type="text" name="deposit_price" id="tbl-deposit_price" value="0" class="tbl-input w300" onchange="autoPriceCalc()" onkeyup="onlynumberic(event)" required>
                        </td>
                        <th>
                            <label for="tbl-add_price" class="required_mark">추가지불</label>
                        </th>
                        <td>
                            <input type="text" name="add_price" id="tbl-add_price" value="0" class="tbl-input w300" onchange="autoPriceCalc()" onkeyup="onlynumberic(event)" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-unpaid_price" class="required_mark">총 미지불금액</label>
                        </th>
                        <td colspan="3">
                            <span id="tbl-unpaid_price" class="unpaid_price w300"></span>
                        </td>
                    </tr>
                    <script>
                        $("#rsdnt_number_1").on("keyup", function () {
                            if ($(this).val().length >= 6) {
                                $("#rsdnt_number_2").focus();
                            }
                        })
                    </script>

{{--                    <tr>--}}
{{--                        <th>--}}
{{--                            <label for="sample6_address">제공자우편번호</label>--}}
{{--                        </th>--}}
{{--                        <td colspan="3">--}}
{{--                            <input type="text" id="sample6_postcode" name="zip_code" class="tbl-input w100" placeholder="우편번호">--}}
{{--                            <input type="button" class="btn-find btn01" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>--}}
{{--                            <input type="text" class="tbl-input w600" name="address" id="sample6_address" placeholder="주소"><br>--}}
{{--                            <input type="text" id="sample6_detailAddress" name="address_detail" class="tbl-input w600" placeholder="상세주소">--}}
{{--                        </td>--}}
{{--                    </tr>--}}

                    <tr>
{{--                        <th>--}}
{{--                            <label for="tbl-regdate">접수일</label>--}}
{{--                        </th>--}}
{{--                        <td colspan="3">--}}
{{--                            <input type="text" name="regdate" id="tbl-regdate" class="w300 input-datepicker">--}}
{{--                        </td>--}}
                    </tr>

                    </tbody>
                </table>

                <div class="btn-wrap">
                    <a href="/worker" class="btn01 btn_cancel">취소</a>
                    <button type="submit" class="btn01 btn_submit">저장</button>
                </div>

            </form>

        </div> <!-- input-wrap end -->

    </section>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        $(document).ready(function() {

        });

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function percent(par,total) {
            return (par * total) / 100
        }

        function sample6_execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        //document.getElementById("sample6_extraAddress").value = extraAddr;

                    } else {
                        //document.getElementById("sample6_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('sample6_postcode').value = data.zonecode;
                    document.getElementById("sample6_address").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("sample6_detailAddress").focus();
                }
            }).open();
        }
    </script>

    <script>
        // maxlength 체크
        function maxLengthCheck(object){
            if (object.value.length > object.maxLength){
                object.value = object.value.slice(0, object.maxLength);
            }
        }
        // 숫자만 남기고 제거, 숫자가 아니면 입력이 안되도록
        function onlynumberic(event) {
            event.target.value = event.target.value.replace(/[^0-9]/g, "");
        }

        //전화번호 자동포커스
        $(function() {
            $(".type_tel").keyup (function () {
                var charLimit = $(this).attr("maxlength");
                if (this.value.length >= charLimit) {
                    $(this).next().next('.type_tel').focus();
                    return false;
                }
            });
        });

        $('#tbl-day_price').on('keyup', function(){
            var num = $('#tbl-day_price').val();
            num.trim(); // 스페이스바 제거
            this.value = comma(num) ;
        });
        $('#tbl-company_price').on('keyup', function(){
            var num = $('#tbl-company_price').val();
            num.trim(); // 스페이스바 제거
            this.value = comma(num) ;
        });
        $('#tbl-deposit_price').on('keyup', function(){
            var num = $('#tbl-deposit_price').val();
            num.trim(); // 스페이스바 제거
            this.value = comma(num) ;
        });
        $('#tbl-add_price').on('keyup', function(){
            var num = $('#tbl-add_price').val();
            num.trim(); // 스페이스바 제거
            this.value = comma(num) ;
        });


        // function userPopup() {
        //     var popUrl = "/popup/user_list/";
        //     var popOption = "top=10, left=10, width=500, height=600, status=no, menubar=no, toolbar=no, resizable=no";
        //     window.open(popUrl, popOption);
        // }
        //
        // function companyPopup() {
        //     var popUrl = "/popup/co_list/";
        //     var popOption = "top=10, left=10, width=500, height=600, status=no, menubar=no, toolbar=no, resizable=no";
        //     window.open(popUrl, popOption);
        // }
    </script>

@endsection
