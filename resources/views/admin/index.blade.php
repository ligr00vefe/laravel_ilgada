@extends("layouts/admin")

@section("title")
    메인
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link rel="stylesheet" href="/js/modal.js">
@endpush

@section("content")
    <div class="main-contents">
        <div class="content-top">
            <div class="content-full">
                <!-- start 인원수 -->
                <div class="quantity-wrap">
                    <div class="quantity-box">
                        <div class="text-wrap">
                            <h2><img src="../img/main_user.png" alt="">신규 회원 수</h2>
                            <span class="quantity--personnel">
                                <strong>{{$new_cnt ?? ''}}</strong> <p>명</p>
                            </span>
                        </div>
                    </div>
                    <!-- end 신규 노무자 수 -->

                    <div class="quantity-box">
                        <div class="text-wrap">
                            <h2><img src="../img/main_company.png" alt="">신규 연장 횟수</h2>
                            <span class="quantity--personnel">
                            <strong>{{$new_pay}}</strong> <p>건</p>
                        </span>
                        </div>
                    </div>
                    <!-- end 신규 거래처 수 -->

                    <div class="quantity-box">
                        <div class="text-wrap">
                            <h2><img src="../img/main_company.png" alt="">신규 문의글</h2>
                            <span class="quantity--personnel">
                            <strong>20</strong> <p>건</p>
                        </span>
                        </div>
                    </div>
                    <!-- end 신규 거래처 수 -->

                </div>
                <!-- end 인원수(quantity-box) -->

                <div class="dailyInfo-box table01">
                    <h3>신규 회원 조회</h3>
                    <a href="/admin/member" class="btn_list">더보기</a>
                    <table class="">
                        <colgraoup>
                            <col width="3%">
                            <col width="3%">
                            <col width="3%">
                            <col width="3%">
                            <col width="3%">
                            <col width="3%">
                        </colgraoup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>아이디</th>
                            <th>업체명</th>
                            <th>사업자등록번호</th>
                            <th>연락처</th>
                            <th>이용기간</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($members as $i => $member)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{ $member->user_id}}</td>
                                <td><a href="/admin/member/view/{{$member->id}}">{{$member->co_name}}</a></td>
                                <td>{{$member->co_num}}</td>
                                <td>{{$member->tel}}</td>
                                <td>{{date("y-m-d", strtotime($member->start_date))}} ~ {{date("y-m-d", strtotime($member->end_date))}}</td>
                            </tr>
                        @endforeach
                        @if ($members->isEmpty())
                            <tr>
                                <td colspan="6">데이터가 없습니다.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- end 일일 정보 조회 -->

            </div>
            <!-- end content-full -->

        </div>{{-- //.content-top end --}}

        <div class="content-bottom">

            <div class="content-half">
                <div class="employee-box table01">
                    <h3>최신 문의글</h3>
                    <a href="/admin/qna" class="btn_list">더보기</a>

                    <table class="">
                        <colgroup>
                            <col width="10%">
                            <col width="">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>조회</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($qnas as $i => $qna)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td><a href="/admin/qna/view/{{$qna->id}}">{{ $qna->subject}}</a></td>
                                <td>{{$qna->user_id}}</td>
                                <td>{{date("y-m-d", strtotime($qna->created_at))}}</td>
                                <td>{{$qna->hit}}</td>
                            </tr>
                        @endforeach
                        @if ($qnas->isEmpty())
                            <tr>
                                <td colspan="6">데이터가 없습니다.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-half -->

        </div>{{-- //.content-bottom end --}}

    </div>
    <!-- end main-contents -->

    <script>
        Highcharts.chart('graph', {
            chart: {
                type: 'area'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
            },
            credits: {
                enabled: false
            },
            series: [{
                name: '신규 노무자 수',
                data: [-50, -100, -40, -20, 80, 50, 120, 150, 100, 60, 75, 90]
            }, {
                name: '신규 거래처 수',
                data: [-100, 20, 50, -70, -100, -30, 0, 30, 80, 120, 130, 110]
            }]
        });
    </script>

    <script>
        $(document).ready(function(){
            /*모달창*/
            $('.btn-extension').on('click', function(){
                extendModalOpen();
            });

            $('.btn-closeExtendModal').on('click', function(){
                extendModalClose();
            });
        });
    </script>
@endsection
