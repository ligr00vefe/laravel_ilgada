@extends("layouts/layout")

@section("title")
    노무자 등록
@endsection

@section("content")

    <script>
        $(document).ready(function(){
            var fileTarget = $('.file-hidden');
            fileTarget.on('change', function(){ // 값이 변경되면
                if(window.FileReader){ // modern browser
                    var filename = $(this)[0].files[0].name;
                } else { // old IE
                    var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
                } // 추출한 파일명 삽입
                // console.log(filename);
                $(this).siblings('.file-name').val(filename);
            });

            $('.tbl-file').on('click', function(){
               $(this).siblings('.file-hidden').click();
            });

        });
    </script>

    <section id="member_register">

        <div class="head-info">
            <h1>노무자 등록</h1>
        </div>

        <div class="input-wrap table02">

            <form action="/worker/register" method="post" name="register_form" enctype="multipart/form-data">
                @csrf
                <table id="register-table">
                    <input type="hidden" name="provider_seq" value="2323">
                    <tbody>
                    <tr>
                        <th>
                            <label for="tbl-name" class="required_mark">이름</label>
                        </th>
                        <td>
                            <input type="text" name="name" id="tbl-name" class="tbl-input w300" required>
                        </td>
                        <th>
                            <label for="tbl-jumin_num" class="required_mark">주민번호</label>
                        </th>
                        <td>
                            <input type="text" name="jumin_num" id="tbl-jumin_num" class="tbl-input w300" autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="" class="required_mark">주민등록증 앞</label>
                        </th>
                        <td>
                            <input type="file" name="photo1" id="tbl-photo1" class="file-hidden" required>
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="tbl-photo1" class="btn-file btn01">파일선택</label>
                        </td>
                        <th>
                            <label for="" class="required_mark">주민등록증 뒤</label>
                        </th>
                        <td>
                            <input type="file" name="photo2" id="tbl-photo2" class="file-hidden" required>
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="tbl-photo2" class="btn-file btn01">파일선택</label>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="" class="required_mark">교육증 앞</label>
                        </th>
                        <td>
                            <input type="file" name="photo3" id="tbl-photo3" class="file-hidden" required>
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="tbl-photo3" class="btn-file btn01">파일선택</label>
                        </td>
                        <th>
                            <label for="" class="required_mark">교육증 뒤</label>
                        </th>
                        <td>
                            <input type="file" name="photo4" id="tbl-photo4" class="file-hidden" >
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." >
                            <label for="tbl-photo4" class="btn-file btn01">파일선택</label>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="" class="required_mark">기타</label>
                        </th>
                        <td>
                            <input type="file" name="photo5" id="tbl-photo5" class="file-hidden" >
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." >
                            <label for="tbl-photo5" class="btn-file btn01">파일선택</label>
                        </td>
                        <th>
                            <label for="tbl-barcode" class="required_mark">바코드</label>
                        </th>
                        <td>
                            <input type="text" name="barcode" id="tbl-barcode" class="tbl-input w300" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="sample6_address">주소</label>
                        </th>
                        <td colspan="3">
                            <input type="text" id="sample6_postcode" name="zip_code" class="tbl-input w100" placeholder="우편번호" required>
                            <input type="button" class="btn-find btn01" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
                            <input type="text" class="tbl-input w600" name="address" id="sample6_address" placeholder="주소" required><br>
                            <input type="text" id="sample6_detailAddress" name="address_detail" class="tbl-input w600" placeholder="상세주소" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-tel1">연락처</label>
                        </th>
                        <td>
                            <input type="hidden" name="tel" id="tbl-tel" class="tbl-input w80">
                            <input type="text" name="tel1" id="tbl-tel1" class="tbl-input w80" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="tel2" id="teg-tel2" class="tbl-input w80" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="tel3" id="tbl-tel3" class="tbl-input w80" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                        </td>
                        <th>
                            <label for="tbl-phone1">휴대전화</label>
                        </th>
                        <td>
                            <input type="hidden" name="phone" id="tbl-phone" class="tbl-input w80">
                            <input type="text" name="phone1" id="tbl-phone1" class="tbl-input w80" maxlength="3" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="phone2" id="teg-phone2" class="tbl-input w80" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                            <span class="hyphen">-</span>
                            <input type="text" name="phone3" id="tbl-phone3" class="tbl-input w80" maxlength="4" oninput="maxLengthCheck(this)" onkeyup="onlynumberic(event)" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-category1" class="required_mark">분야</label>
                        </th>
                        <td>
                            <select name="category1" id="tbl-category1" class="tbl-select w300" required>
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
                            <label for="tbl-category2" class="required_mark">세부분야</label>
                        </th>
                        <td>
                            <input name="category2" id="tbl-category2" class="tbl-input w300" required>
                        </td>
                    </tr>
                    <tr>
{{--                        <th>--}}
{{--                            <label for="tbl-chk_day">출근수</label>--}}
{{--                        </th>--}}
{{--                        <td>--}}
{{--                            <input type="text" name="chk_day" id="tbl-chk_day" class="tbl-input w300">--}}
{{--                        </td>--}}
                        <th>
                            <label for="tbl-credit">신용</label>
                        </th>
                        <td>
                            <select name="credit" id="tbl-credit" class="tbl-select w300" required>
                                <option disabled>선택하세요</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </td>
                        <th>
                            <label for="tbl-percent">수수료율(%)</label>
                        </th>
                        <td>
                            <input type="text" name="percent" id="tbl-percent" class="tbl-input w300" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-bank">은행</label>
                        </th>
                        <td>
                            <input type="text" name="bank" id="tbl-bank" class="tbl-input w300" required>
                        </td>
                        <th>
                            <label for="tbl-bank_num">계좌번호</label>
                        </th>
                        <td>
                            <input type="text" name="bank_num" id="tbl-bank_num" class="tbl-input w300" required>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-gender">성별</label>
                        </th>
                        <td>
                            <select name="gender" id="tbl-gender" class="tbl-select w300" required>
                                <option disabled>선택하세요</option>
                                <option value="1">남자</option>
                                <option value="2">여자</option>
                            </select>
                        </td>
                        <th>
                            <label for="tbl-car_yn">자차유무</label>
                        </th>
                        <td>
                            <select name="car_yn" id="tbl-car_yn" class="tbl-select w300" required>
                                <option disabled>선택하세요</option>
                                <option value="Y">유</option>
                                <option value="N">무</option>
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-personal_information">개인정보수집동의</label>
                        </th>
                        <td>
                            <input type="file" name="personal_information" id="tbl-personal_information" class="file-hidden">
                            <input name="ori_photo6" class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="tbl-personal_information" class="btn-file btn01">파일선택</label>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="tbl-memo" class="required_mark">메모</label>
                        </th>
                        <td colspan="3">
                            <textarea name="memo" id="tbl-memo" class="unpaid_price tbl-textarea w1400" required></textarea>
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
                    <a href="/worker" class="btn01 btn_cancel">취소</a>
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
    </script>


@endsection
