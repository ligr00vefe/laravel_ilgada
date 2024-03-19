@extends("layouts/admin")

@section("title")
    관리자 공지사항 등록
@endsection

@push("scripts")
    <script type="text/javascript" src="/storage/plugin/smarteditor2-master/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
    <script>
        $(document).ready(function() {
            var fileTarget = $('.file-hidden');
            fileTarget.on('change', function () { // 값이 변경되면
                if (window.FileReader) { // modern browser
                    var filename = $(this)[0].files[0].name;
                } else { // old IE
                    var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
                } // 추출한 파일명 삽입
                // console.log(filename);
                $(this).siblings('.file-name').val(filename);
            });

            $('.tbl-file').on('click', function () {
                $(this).siblings('.file-hidden').click();
            });
        });
    </script>
@endpush
@section("content")

    <style>

    </style>

    <section id="archives-write" class="board-wrap">
        <div class="board-title">
            <h3>공지사항 글쓰기</h3>
        </div>
        <form action="/admin/notice/register" method="post" id="form" enctype="multipart/form-data">
            @csrf
            @if (isset($edit))
                @method("put")
                <input type="hidden" name="id" value="{{ $post->id }}">
            @endif
            <div class="table-wrap table02">
                <table class="write-table">
                    <tr class="write-table-tr write-subject-tr">
                        <th class="write-table-th table-title-th">제목</th>
                        <td colspan="3">
                            <input type="text" class="write-table-input tbl-input w100p" name="subject" value="{{ $post->subject ?? "" }}" required / >
                        </td>
                    </tr>
                    <tr class="write-table-tr write-content-th">
{{--                        <th class="write-table-th">내용</th>--}}
                        <td class="td-editor" colspan="4">
                            <textarea class="write-content-textarea tbl-textarea w100p" id="contents" name="contents" required>{{ $post->content ?? "" }}</textarea>
                        </td>
                    </tr>
                    <tr class="write-table-tr table-file-tr-01">
                        <th class="write-table-th">첨부파일1</th>
                        <td class="write-file-td-01" colspan="3">
                            <input type="file" id="attachments1" name="file1name" class="file-hidden" value="{{ $post->file1name ?? "" }}" readonly>
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="attachments1" class="btn-file btn01" onchange="javascript:document.getElementById('attachments1').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                        </td>
                    </tr>
                    <tr class="write-table-tr table-file-tr-02">
                        <th class="write-table-th">첨부파일2</th>
                        <td class="write-file-td-02" colspan="3">
                            <input type="file" id="attachments2" name="file2name" class="file-hidden" value="{{ $post->file2name ?? "" }}" readonly>
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="attachments2" class="btn-file btn01" onchange="javascript:document.getElementById('attachments2').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="btn-wrap">
                <a class="btn_cancel btn01" href="/admin/notice">취소</a>
                <button type="button" class="btn_submit btn01 confirm-link">글쓰기</button>
            </div>
        </form>
    </section>

    <script>
        window.addEventListener('load', function () {
            // 에디터
            var oEditors = [];
            nhn.husky.EZCreator.createInIFrame({
                oAppRef: oEditors,
                elPlaceHolder: "contents",
                // sSkinURI: "/storage/app/public/plugin/smarteditor2-master/workspace/static/SmartEditor2Skin.html",
                sSkinURI: "/storage/plugin/smarteditor2-master/workspace/static/SmartEditor2Skin.html",
                fCreator: "createSEditor2"
            });


            document.querySelector('.confirm-link').addEventListener('click', function () {
                oEditors.getById['contents'].exec("UPDATE_CONTENTS_FIELD", []);
                document.getElementById('form').submit();
            })

        });
    </script>
@endsection
