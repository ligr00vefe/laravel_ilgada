@extends("layouts/layout")

@section("title")
    거래처 등록
@endsection

@section("content")

    <script>

    </script>

    <section id="member_register">

        <div class="head-info">
            <h1>거래처 등록</h1>
        </div>

        <div class="input-wrap table02">

            <form action="/company/register" method="post" name="register_form" >
                @csrf
                <table id="register-table">
                    <input type="hidden" name="provider_seq" value="2323">
                    <tbody>
                    <tr>
                        <th>
                            <label for="tbl-co_name" class="required_mark">거래처명</label>
                        </th>
                        <td>
                            <input type="text" name="co_name" id="tbl-co_name " required class="tbl-input w300" autocomplete="off" value="{{ $_GET['from_date'] ?? "" }}">
                        </td>
                        <th>
                            <label for="tbl-co_num" class="required_mark">사업자등록 번호</label>
                        </th>
                        <td>
                            <input type="text" name="co_num" id="tbl-co_num" class="tbl-input w300" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-name" class="required_mark">대표자명</label>
                        </th>
                        <td>
                            <input type="text" name="name" id="tbl-name" class="tbl-input w300" required>
                        </td>
                        <th>
                            <label for="tbl-tel" class="required_mark">대표전화</label>
                        </th>
                        <td>
                            <input type="hidden" name="tel" id="tbl-tel" class="tbl-input w90">
                            <input type="text" name="tel1" id="tbl-tel1" class="tbl-input w90" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="tel2" id="teg-tel2" class="tbl-input w90" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="tel3" id="tbl-tel3" class="tbl-input w90" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-phone" class="required_mark">휴대폰번호</label>
                        </th>
                        <td>
                            <input type="hidden" name="phone" id="tbl-phone" class="tbl-input w90">
                            <input type="text" name="phone1" id="tbl-phone1" class="tbl-input w90" maxlength="3" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="phone2" id="teg-phone2" class="tbl-input w90" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="phone3" id="tbl-phone3" class="tbl-input w90" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                        </td>
                        <th>
                            <label for="tbl-fax" class="required_mark">fax</label>
                        </th>
                        <td>
                            <input type="hidden" name="fax" id="tbl-fax" class="tbl-input w90">
                            <input type="text" name="fax1" id="tbl-fax1" class="tbl-input w90" maxlength="3" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="fax2" id="teg-fax2" class="tbl-input w90" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="fax3" id="tbl-fax3" class="tbl-input w90" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-email" class="required_mark">메일</label>
                        </th>
                        <td>
                            <input type="hidden" name="email" id="tbl-email">
                            <input type="text" name="email1" id="tbl-email1" class="tbl-input w100" required>
                            <span class="at">@</span>
                            <input type="text" name="email2" id="tbl-email2" class="tbl-input w150" required>
                            <span class="empty"></span>
                            <select name="email3" id="tbl-email3" class="tbl-select w150" onchange="$('#tbl-email2').val($(this).val())">
                                <option value="">직접입력</option>
                                <option value="naver.com">naver.com</option>
                                <option value="daum.net">daum.net</option>
                                <option value="hanmail.net">hanmail.net</option>
                                <option value="gmail.com">gmail.com</option>
                                <option value="nate.com">nate.com</option>
                            </select>
                        </td>
                        <th>
                            <label for="tbl-vat_email" class="required_mark">세금계산서 메일</label>
                        </th>
                        <td>
                            <input type="hidden" name="vat_email" id="tbl-vat_email">
                            <input type="text" name="vat_email1" id="tbl-vat_email1" class="tbl-input w100" required>
                            <span class="at">@</span>
                            <input type="text" name="vat_email2" id="tbl-vat_email2" class="tbl-input w150" required>
                            <span class="empty"></span>
                            <select name="vat_email3" id="tbl-vat_email3" class="tbl-select w150" onchange="$('#tbl-vat_email2').val($(this).val())">
                                <option value="">직접입력</option>
                                <option value="naver.com">naver.com</option>
                                <option value="daum.net">daum.net</option>
                                <option value="hanmail.net">hanmail.net</option>
                                <option value="gmail.com">gmail.com</option>
                                <option value="nate.com">nate.com</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="sample6_address" class="required_mark">주소</label>
                        </th>
                        <td colspan="3">
                            <input type="text" id="sample6_postcode" name="zip_code" class="tbl-input w100" placeholder="우편번호" required>
                            <input type="button" class="btn-find btn01" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                            <input type="text" class="tbl-input w600" name="address" id="sample6_address" placeholder="주소" required><br>
                            <input type="text" id="sample6_detailAddress" name="detail" class="tbl-input w600" placeholder="상세주소" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-payment_type" class="required_mark">결제유형</label>
                        </th>
                        <td>
                            <select name="payment_type" id="tbl-payment_type" class="tbl-select w300" required>
                                <option disabled>선택하세요</option>
                                <option value="1">당일 결제</option>
                                <option value="2">15일 결제</option>
                                <option value="3">말일 결제</option>
                            </select>
                        </td>
                        <th>
                            <label for="tbl-credit" class="required_mark">신용</label>
                        </th>
                        <td>
                            <select name="credit" id="tbl-credit" class="tbl-select w300" required>
                                <option disabled>선택하세요</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-memo" class="required_mark">메모</label>
                        </th>
                        <td colspan="3">
                            <textarea name="memo" id="tbl-memo" class="tbl-textarea w1400 unpaid_price" required></textarea>
                        </td>
                    </tr>
                    <script>
                        $("#rsdnt_number_1").on("keyup", function () {
                            if ($(this).val().length >= 6) {
                                $("#rsdnt_number_2").focus();
                            }
                        })
                    </script>

                    </tbody>
                </table>

                <div class="btn-wrap">
                    <a href="/company" class="btn01 btn_cancel">취소</a>
                    <button type="submit" class="btn01 btn_submit">저장</button>
                </div>

            </form>

        </div> <!-- input-wrap end -->

    </section>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
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
    </script>

@endsection
