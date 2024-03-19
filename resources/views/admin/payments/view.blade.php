@extends("layouts/admin")

@section("title")
    거래처 상세보기
@endsection

@section("content")
    <section id="inquiry-view" class="wrapper">
        <div class="title_wrap">
            <div class="title">
                <h3>거래처 상세보기</h3>
            </div>
        </div>
        <div class="table-wrap">
            <table cellspacing="1" cellpadding="0" border="1">
                <tr class="sub-subject-tr">
                    <th>거래처명</th>
                    <td>{{ $lists->co_name }}</td>
                    <th>사업자번호</th>
                    <td>{{ $lists->co_num }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>대표자명</th>
                    <td colspan="3">{{ $lists->name }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>주소</th>
                    <td colspan="3">{{ $lists->zip_code }}{{ $lists->address }}{{ $lists->address_detail }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>대표전화</th>
                    <td colspan="3">{{ $lists->tel }}</td>
                    <th>팩스</th>
                    <td colspan="3">{{ $lists->fax }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>메일</th>
                    <td colspan="3">{{ $lists->email }}</td>
                    <th>게금계산서용 메일</th>
                    <td colspan="3">{{ $lists->vat_email }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>결제유형</th>
                    <td colspan="3">{{ $lists->payment_type }}</td>
                    <th>신용</th>
                    <td colspan="3">{{ $lists->credit }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>등록일</th>
                    <td colspan="3">{{ $lists->created_at }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>메모</th>
                    <td colspan="3">{{ $lists->memo }}</td>
                </tr>
            </table>
        </div>
        <div class="form-button-wrap">
            <div class="form-button-div"><a class="list-link form-button-link" href="/company/list">목록</a></div>
            <form action="/company/del/{{ $lists->id }}" method="post" style="display: inline-block" onsubmit="if(!confirm('삭제하시겠습니까?')) { return false; }">
                @csrf
                @method("delete")
                <div class="form-button-div"><button class="delete-link form-button-link">삭제</button></div>
            </form>
            <div class="form-button-div"><a class="modify-link form-button-link" href="/company/modify/{{ $lists->id }}">수정</a></div>
        </div>
    </section>
@endsection
