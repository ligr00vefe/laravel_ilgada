@extends("layouts/admin")

@section("title")
    회원정보 수정
@endsection

@push('scripts')
@endpush

@section("content")
    <div id="member_register">
        <div class="head-info">
            <h1>회원정보 수정</h1>
        </div>
        <form name="register_form" method="post" action="/admin/member/update_proc" enctype="multipart/form-data" >
            @csrf
            <div class="table-wrap table02">
                <table>
                <tbody>
                <input type="hidden" name="id" value="{{ $lists->id}}" required>
                <tr>
                    <th>아이디</th>
                    <td>
                        <span>{{ $lists->user_id}}</span>
                        <input type="hidden" name="user_id" value="{{ $lists->user_id}}" class="tbl-input w300" required>
                    </td>
                    <th>비밀번호</th>
                    <td> 비밀번호 변경</td>
                </tr>

                <tr>
                    <th>대표자명</th>
                    <td><input type="text" name="name" value="{{ $lists->name}}" class="tbl-input w300" required></td>
                    <th>상호명</th>
                    <td><input type="text" name="co_name" value="{{ $lists->co_name}}" class="tbl-input w300" required></td>
                </tr>

                <tr>
                    <th>업태</th>
                    <td><input type="text" name="business_type" value="{{ $lists->business_type}}" class="tbl-input w300" required></td>
                    <th>업종</th>
                    <td><input type="text" name="business_item" value="{{ $lists->business_item}}" class="tbl-input w300" required></td>
                </tr>

                <tr>
                    <th>사업자등록번호</th>
                    <td><input type="text" name="co_num" value="{{ $lists->co_num}}" class="tbl-input w300" required></td>
                    <th>사업자등록증</th>
                    <td>
                        @if ($lists->ori_photo1)
                            <div class="file-info">
                                <input type="hidden" name="photo1" value="{{ $lists->photo1}}" class="">
                                <input type="hidden" name="ori_photo1" value="{{ $lists->ori_photo1}}" class="">
                                <input type="file" name="photo1" id="photo1" class="file-hidden" value="{{ $lists->photo1}}" required>
                                <input type="text" class="file-name tbl-file w300" value="{{ $lists->photo1}}">
                                <div class="file-del">
                                    <input id="upload-fileChk" type="checkbox">
                                    <label for="upload-fileChk" class="upload-fileName">
                                        {{ $lists->ori_photo1}}(53.7M)
                                        <span>파일 삭제</span>
                                    </label>
                                </div>
                            </div>
                        @else
{{--                            <input type="file" name="photo1" value="{{ $lists->photo1}}" class="tbl-input w300">--}}
{{--                            <input type="hidden" name="ori_photo1" value="{{ $lists->ori_photo1}}" class="tbl-input w300">--}}
                            <input type="file" name="photo1" id="photo1" class="file-hidden" value="{{ $lists->photo1}}" required>
                            <input type="text" class="file-name tbl-file w300">
                            <label for="photo1" class="btn-file btn01">파일선택</label>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>연락처</th>
                    <td>
                        <input type="text" name="tel1" value="{{ $tel_info->tel1}}" class="tbl-input w80" required>
                        <span class="hyphen">-</span>
                        <input type="text" name="tel2" value="{{ $tel_info->tel2}}" class="tbl-input w80" required>
                        <span class="hyphen">-</span>
                        <input type="text" name="tel3" value="{{ $tel_info->tel3}}" class="tbl-input w80" required>
                    </td>
                    <th>휴대전화</th>

                    <td>
                        <input type="text" name="phone1" value="{{ $phone_info->phone1}}" class="tbl-input w80" required>
                        <span class="hyphen">-</span>
                        <input type="text" name="phone2" value="{{ $phone_info->phone2}}" class="tbl-input w80" required>
                        <span class="hyphen">-</span>
                        <input type="text" name="phone3" value="{{ $phone_info->phone3}}" class="tbl-input w80" required>
                    </td>
                </tr>

                <tr>
                    <th>이메일</th>
                    <td colspan="3">
                        <input type="text" name="email1" value="{{ $email_info->email1}}" id="tbl-email1" class="tbl-input w100" required>
                        <span class="at">@</span>
                        <input type="text" name="email2" value="{{ $email_info->email2}}" id="tbl-email2" class="tbl-input w150" required>
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
                </tr>

                <tr>
                    <th>업체주소</th>
                    <td colspan="3">
                        <input type="text" id="sample6_postcode" name="zip_code" value="{{ $lists->zip_code}}" class="tbl-input w100" placeholder="우편번호" required>
                        <input type="button" class="btn-find btn01" onclick="sample6_execDaumPostcode()" value="우편번호 찾기" required><br>
                        <input type="text" name="address" value="{{ $lists->address}}" class="tbl-input w500" id="sample6_address" placeholder="주소" required><br>
                        <input type="text" name="address_detail" value="{{ $lists->address_detail}}" class="tbl-input w500" id="sample6_detailAddress" placeholder="상세주소" required>
                    </td>
                </tr>

                <tr>
                    <th>이용기간</th>
                    <td>
                        <span class="tbl-usePeriod">{{ date("Y-m-d", strtotime($lists->start_date)) }} ~ {{ date("Y-m-d", strtotime($lists->end_date)) }}</span>
                        <a href="javascript:void({{ $lists->id }})" onClick="extendModalOpen(this);" class="btn-extension2 btn01" data-id="{{ $lists->id }}">연장</a>
                    </td>
                </tr>

                <tr>
                    <th>최초가입일</th>
                    <td><span>{{ $lists->created_at }}</span></td>
                    <th>마지막 접속일</th>
                    <td><span>{{ $lists->created_at }}</span></td>
                </tr>

                </tbody>
            </table>
            </div>
            <div class="btn-wrap">
                <a href="/admin/member" class="btn01 btn_cancel">취소</a>
                <button type="submit" class="btn01 btn_submit">저장</button>
            </div>
        </form>
    </div>

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
@endsection
