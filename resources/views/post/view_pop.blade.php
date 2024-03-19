@extends("layouts/layout_pop")

@section("title")
    관리자페이지 - 온라인 문의 내역
@endsection

@section("content")
    <section id="inquiry-view" class="wrapper">
        <div class="title_wrap">
            <div class="title">
                <h3>온라인 문의 내역</h3>
            </div>
        </div>
        <div class="table-wrap">
            <table>
                <tr class="sub-subject-tr">
                    <th>구분</th>
                    <td colspan="3">{{ $lists->name }}</td>
                </tr>
                <tr class="sub-subject-tr">
                    <th>작성자</th>
                    <td></td>
                    <th>작성일시</th>
                    <td></td>
                </tr>
            </table>
        </div>
        <div class="form-button-wrap">
            <div class="form-button-div"><a class="list-link form-button-link" href="/admin/board/notice">목록</a></div>
            <form action="/admin/board/notice/destroy/" method="post" style="display: inline-block" onsubmit="if(!confirm('삭제하시겠습니까?')) { return false; }">
                @csrf
                @method("delete")
                <div class="form-button-div"><button class="delete-link form-button-link">삭제</button></div>
            </form>
            <div class="form-button-div"><a class="modify-link form-button-link" href="/admin/board/inquiry/modify/">수정</a></div>
        </div>
    </section>
@endsection
