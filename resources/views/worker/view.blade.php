@extends("layouts/layout")

@section("title")
    노무자 상세보기
@endsection

@section("content")
    <section id="inquiry-view" class="view-wrap detail-view">
        <div class="view-title">
            <h3>노무자 상세보기</h3>
        </div>
        <div class="table-wrap table04">
            <table>
                <tr>
                    <td class="td-tab">
                        <button class="photo1" data-img="{{ $lists->photo1 }}" onclick="selectImg(this)">주민 앞</button>
                        <button class="photo2" data-img="{{ $lists->photo2 }}" onclick="selectImg(this)">주민 뒤</button>
                        <button class="photo3" data-img="{{ $lists->photo3 }}" onclick="selectImg(this)">교육 앞</button>
                        <button class="photo4" data-img="{{ $lists->photo4 }}" onclick="selectImg(this)">교육 뒤</button>
                        <button class="photo5" data-img="{{ $lists->photo5 }}" onclick="selectImg(this)">기타</button>
                    </td>
                </tr>
                <tr>
                    <td class="td-changeImg">
                        <img src="{{asset('/storage/'.$lists->photo1)}}" id="changePhoto">
                    </td>
                </tr>
            </table>
        </div>
        <div class="table-wrap table02">
            <table>
                <tr>
                    <th>이름</th>
                    <td>{{ $lists->name }}</td>
                    <th>주민등록번호</th>
                    <td>{{ $lists->rsNo }}</td>
                </tr>
                <tr>
                    <th>성별</th>
                    <td>{{ $lists->gender }}</td>
                    <th>주소</th>
                    <td>{{ $lists->zip_code }}{{ $lists->address }}{{ $lists->address_detail }}</td>
                </tr>
                <tr>
                    <th>연락처1</th>
                    <td>{{ $lists->tel }}</td>
                    <th>연락처2</th>
                    <td>{{ $lists->phone }}</td>
                </tr>
                <tr>
                    <th>분야</th>
                    <td>{{ $lists->category1 }}</td>
                    <th>세부분야</th>
                    <td>{{ $lists->category2 }}</td>
                </tr>
                <tr>
                    <th>출근수</th>
                    <td>{{ $lists->chk_days }}</td>
                    <th>신용</th>
                    <td>{{ $lists->credit }}</td>
                </tr>
                <tr>
                    <th>수수료율(%)</th>
                    <td>{{ $lists->percent }}</td>
                    <th>바코드</th>
                    <td>{{ $lists->target_key }}</td>
                </tr>
                <tr>
                    <th>은행</th>
                    <td>{{ $lists->bank }}</td>
                    <th>계좌번호</th>
                    <td>{{ $lists->bank_num }}</td>
                </tr>
                <tr>
                    <th>자차유무</th>
                    <td>{{ $lists->car_yn }}</td>
                    <th>등록일</th>
                    <td>{{ $lists->created_at }}</td>
                </tr>
                <tr>
                    <th>메모</th>
                    <td>{{ $lists->memo }}</td>
                </tr>
                <tr>
                    <th>개인정보 수집동의</th>
                    <td class="td-upload_file"><input type="file" id="file-hidden"><label for="file-hidden" class="upload-file">{{ $lists->personal_information }}</label></td>
                </tr>
            </table>
        </div>
        <div class="btn-wrap">
            <form action="/worker/del/{{ $lists->id }}" method="post" style="display: inline-block" onsubmit="if(!confirm('삭제하시겠습니까?')) { return false; }">
                @csrf
                @method("delete")
                <button class="btn-del btn01">삭제</button>
            </form>
            <a class="btn-list btn01" href="/worker/list">목록</a>
            <a class="btn-modify btn01" href="/worker/modify/{{ $lists->id }}">수정</a>

        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.td-tab button:first').addClass('active');
        });
        function selectImg(obj) {
            var img_url = $(obj).attr('data-img');
            $('.td-tab button').removeClass('active');
            $(obj).addClass('active');

            $('#changePhoto').attr('src',"/storage/"+img_url);
        }
    </script>

@endsection
