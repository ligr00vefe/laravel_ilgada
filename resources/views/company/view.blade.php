@extends("layouts/layout")

@section("title")
    거래처 상세보기
@endsection

@section("content")
    <section id="inquiry-view" class="view-wrap detail-view">
        <div class="view-title">
            <h3>거래처 상세보기</h3>
        </div>
        <div class="table-wrap table02">
            <table>
                <tr class="sub-subject-tr">
                    <th>거래처명</th>
                    <td>{{ $lists->co_name }}</td>
                    <th>사업자번호</th>
                    <td>{{ $lists->co_num }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>대표자명</th>
                    <td>{{ $lists->name }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>주소</th>
                    <td>{{ $lists->zip_code }} {{ $lists->address }} {{ $lists->address_detail }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>대표전화</th>
                    <td>{{ $lists->tel }}</td>
                    <th>팩스</th>
                    <td>{{ $lists->fax }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>메일</th>
                    <td>{{ $lists->email }}</td>
                    <th>게금계산서용 메일</th>
                    <td>{{ $lists->vat_email }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>결제유형</th>
                    <td>{{ $lists->payment_type }}</td>
                    <th>신용</th>
                    <td>{{ $lists->credit }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>등록일</th>
                    <td>{{ $lists->created_at }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>메모</th>
                    <td>{{ $lists->memo }}</td>
                </tr>
            </table>
        </div>
        <div class="btn-wrap">
            <form action="/company/del/{{ $lists->id }}" method="post" style="display: inline-block" onsubmit="if(!confirm('삭제하시겠습니까?')) { return false; }">
                @csrf
                @method("delete")
                <button class="btn-del btn01">삭제</button>
            </form>
            <a class="btn-list btn01" href="/company/list">목록</a>
            <a class="btn-modify btn01" href="/company/modify/{{ $lists->id }}">수정</a>
        </div>
    </section>
@endsection
