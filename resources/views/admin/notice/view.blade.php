@extends("layouts/admin")

@section("title")
    공지사항 글보기
@endsection

<?php
use App\Classes\Custom;
use App\Classes\Input;
?>

@section("content")
    <section id="inquiry-view" class="board-wrap">
        {{--<div class="board-title">--}}
        {{--<h3>문의사항 글보기</h3>--}}
        {{--</div>--}}

        <div class="view-wrap">
            <div class="view-head">
                <div class="view-subject"><h2>{{ $lists->subject }}</h2></div>
                <ul class="write-info">
                    <li><span>작성일.{{ $lists->created_at }}</span></li>
                    <li><span>작성자.{{ $lists->user_id }}</span></li>
                    <li><span>조회.{{ $lists->hit }}</span></li>
                </ul>
            </div>

            <div class="view-body">
                {{--<div class="view-file">--}}
                {{-- @if ($lists->ori_photo1)
                     <tr class="sub-subject-tr file-link-tr">
                         <th class="file-link-th">파일링크1</th>
                         <td colspan="3">
                             <a href="{{asset('/storage/'.$lists->photo1)}}">{{ $lists->ori_photo1 }}</a>
                         </td>
                     </tr>
                 @endif
                 @if ($lists->ori_photo2)
                     <tr class="sub-subject-tr file-link-tr">
                         <th class="file-link-th">파일링크2</th>
                         <td colspan="3">
                             <a href="{{asset('/storage/'.$lists->photo2)}}">{{ $lists->ori_photo2 }}</a>
                         </td>
                     </tr>
                 @endif--}}
                {{--</div>--}}
                <div class="view-content">
                    <p>{!! $lists->contents !!}</p>
                </div>
            </div>

            <div class="btn-wrap right-list">
                <a class="btn_list btn01" href="/admin/qna/">목록</a>
                <form action="/admin/qna/del" method="post" style="display: inline-block" onsubmit="if(!confirm('삭제하시겠습니까?')) { return false; }">
                    @csrf
                    {{--                    @method("delete")--}}
                    <button class="btn_delete btn01">삭제</button>
                    <input type="hidden" name="id" value="{{ $lists->id}}">
                </form>
                <a class="btn_modify btn01" href="/admin/qna/modify/{{$lists->id}}">수정</a>
                <a class="btn_write btn01" href="/admin/qna/add">글쓰기</a>
            </div>
        </div>{{-- //.view-wrap end --}}
    </section>
@endsection
