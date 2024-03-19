@extends("layouts/admin")

@section("title")
    관리자 공지사항 수정
@endsection

@push("scripts")
    <script type="text/javascript"
            src="/storage/plugin/smarteditor2-master/workspace/static/js/service/HuskyEZCreator.js"
            charset="utf-8"></script>

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
            <h3>공지사항 글수정</h3>
        </div>
        <form action="/admin/notice/update_proc" method="post" name="register_form" enctype="multipart/form-data" >
            @csrf
            <div class="table-wrap table02">
                <table class="write-table">
                    <input type="hidden" name="id" value="{{ $lists->id}}">
                    <tbody>
                    <tr>
                        <th>
                            <label for="tbl-subject" class="required_mark">제목</label>
                        </th>
                        <td colspan="3">
                            <input type="text" name="subject" id="tbl-subject"  required />
                        </td>
                    </tr>
                    <tr>
                        {{--<th><label for="tbl-contents" class="required_mark">내용</label></th>--}}
                        <td class="td-editor" colspan="4">
                            <textarea name="contents" id="contents" class="tbl-textarea w100p" required />{{ $lists->contents }}</textarea>
                        </td>
                    </tr>
                    <tr class="write-table-tr table-file-tr-01">
                        <th class="write-table-th">첨부파일1</th>
                        <td class="write-file-td-01" colspan="3">
{{--                            <input type="text" readonly="readonly" id="attachments1" name="file1name" placeholder="선택된 파일 없음" value="{{ $lists->ori_photo1 }}">--}}
{{--                            <label class="file-label">찾아보기<input class="file-01 file-hidden" type="file" name="photo1" onchange="javascript:document.getElementById('attachments1').value=$(this).val().split('/').pop().split('\\').pop();"></label>--}}
                            <input type="file" id="attachments1" name="file1name" class="file-hidden" value="{{ $lists->ori_photo1 }}" readonly>
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="attachments1" class="btn-file btn01" name="photo1" onchange="javascript:document.getElementById('attachments1').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                        </td>
                    </tr>
                    <tr class="write-table-tr table-file-tr-02">
                        <th class="write-table-th">첨부파일2</th>
                        <td class="write-file-td-02" colspan="3">
{{--                            <input type="text" readonly="readonly" id="attachments2" name="file2name" placeholder="선택된 파일 없음" value="{{ $lists->ori_photo2 }}">--}}
{{--                            <label class="file-label">찾아보기<input class="file-02 file-hidden" type="file" name="photo2" onchange="javascript:document.getElementById('attachments2').value=$(this).val().split('/').pop().split('\\').pop();"></label>--}}
                            <input type="file" id="attachments2" name="file2name" class="file-hidden" value="{{ $lists->ori_photo2 }}" readonly>
                            <input class="file-name tbl-file w300" placeholder="선택된 파일이 없습니다." readonly>
                            <label for="attachments2" class="btn-file btn01" onchange="javascript:document.getElementById('attachments2').value=$(this).val().split('/').pop().split('\\').pop();">파일선택</label>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> <!-- table-wrap end -->
            <div class="btn-wrap">
                <a href="/admin/notice" class="btn01 btn_cancel">취소</a>
                <button type="submit" name="send" class="btn01 btn_submit confirm-link">저장</button>
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
