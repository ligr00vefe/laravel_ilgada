@extends("layouts/admin")

@section("title")
    기간 연장
@endsection

@push('scripts')
@endpush

@section("content")
    <div id="member_register">
        <div class="head-info">
            <h1>기간 연장</h1>
        </div>

        <form action="/admin/payments/period_proc" method="post" name="register_form" enctype="multipart/form-data" >
            <input type="hidden" name="id" value="{{ $lists->co_code }}" class="tbl-input w300" required>
            @csrf
            <div class="table-wrap table02">
                <table>
                    <tbody>
                    <tr>
                        <th>아이디</th>
                        <td><input type="text" name="user_id" value="{{ $lists->user_id }}" class="tbl-input w300" required></td>
                        <th>상호명</th>
                        <td><input type="text" name="co_name" value="{{ $lists->co_name }}" class="tbl-input w300"></td>
                    </tr>

                    <tr>
                        <th>사업자등록번호</th>
                        <td><input type="text" name="co_num" value="{{ $lists->co_num }}" class="tbl-input w300"></td>
                        <th>입금자명</th>
                        <td><input type="text" name="name" value="{{ $lists->name }}" class="tbl-input w300"></td>
                    </tr>

                    <tr>
                        <th>시작일자</th>
                        <td><input type="text" name="start_date" value="{{ $lists->start_date }}" class="tbl-input w300"></td>
                        <th>종료일자</th>
                        <td><input type="text" name="end_date" value="{{ $lists->end_date }}" class="tbl-input w300"></td>
                    </tr>



                    <tr>
                        <th>연장기간</th>
                        <td>
                            <div class="extend_terms_radio">
                                <input type="radio" id="month_1" name="period" value="1month" class="tbl-radio terms_input">
                                <label for="month_1">1개월</label>

                                <input type="radio" id="month_3" name="period" value="3month" class="tbl-radio terms_input">
                                <label for="month_3">3개월</label>

                                <input type="radio" id="month_6" name="period" value="6month" class="tbl-radio terms_input">
                                <label for="month_6">6개월</label>

                                <input type="radio" id="month_9" name="period" value="9month" class="tbl-radio terms_input">
                                <label for="month_9">9개월</label>

                                <br/>

                                <input type="radio" id="year_1" name="period" value="1year" class="tbl-radio terms_input">
                                <label for="year_1">1년</label>

                                <input type="radio" id="year_3" name="period" value="3year" class="tbl-radio terms_input">
                                <label for="year_3">3년</label>

                                <input type="radio" id="year_6" name="period" value="6year" class="tbl-radio terms_input">
                                <label for="year_6">6년</label>

                                <input type="radio" id="year_9" name="period" value="9year" class="tbl-radio terms_input">
                                <label for="year_9">9년</label>

                                <br/>

                                {{--                            <input type="radio" id="infinite" name="period" value="all" class="tbl-radio terms_input">--}}
                                {{--                            <label for="infinite">기간 제한 없음</label>--}}
                            </div>
                        </td>
                        <th>결제수단</th>
                        <td>
                            <div class="extend_terms_radio">
                                <input type="radio" id="payment_type" name="payment_type" value="bank" class="tbl-radio terms_input">
                                <label for="payment_type">무통장 입금</label>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="btn-wrap">
                <a href="/" class="btn01 btn_cancel">취소</a>
                <button type="submit" class="btn01 btn_submit">저장</button>
            </div>
        </form>
    </div>

@endsection
