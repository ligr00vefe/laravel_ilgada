@extends("layouts/layout")

@section("title")
    메인
@endsection

@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endpush

@section("content")
    <div class="main-contents">
        <div class="content-top">
            <div class="content-half">
                <!-- start 인원수 -->
                <div class="quantity-wrap">
                    <div class="quantity-box">
                        <div class="text-wrap">
                            <h2><img src="../img/main_user.png" alt="">신규 노무자 수</h2>
                            <span class="quantity--personnel">
                                <strong>{{$count }}</strong> 명
                            </span>
                        </div>
                    </div>
                    <!-- end 신규 노무자 수 -->

                    <div class="quantity-box">
                        <div class="text-wrap">
                            <h2><img src="../img/main_company.png" alt="">신규 거래처 수</h2>
                            <span class="quantity--personnel">
                            <strong>{{$new }}</strong> 명
                        </span>
                        </div>
                    </div>
                    <!-- end 신규 거래처 수 -->
                </div>
                <!-- end 인원수(quantity-box) -->

                <div class="dailyInfo-box table01">
                    <h3>일일정보 조회</h3>
                    <table class="">
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>작업일</th>
                            <th>노무자이름</th>
                            <th>거래처명</th>
                            <th>총노임</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($post as $i => $list)
                            <tr>
                                <td><?php echo 30 - $i ?></td>
                                <td>{{ date("y-m-d", strtotime($list->work_date))}}</td>
                                <td><a href="/post/list">{{$list->name}}</a></td>
                                <td>{{$list->co_name}}</td>
                                <td>{{number_format($list->day_price)}}</td>
                            </tr>
                        @endforeach
                        @if ($post->isEmpty())
                            <tr>
                                <td colspan="5">데이터가 없습니다.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <!-- end 일일 정보 조회 -->

                <div class="bill-down-box">
                    <img src="../img/main_group.png" alt="">
                </div>

            </div>
            <!-- end content-left -->

            <div class="content-half content-right">

                <!-- start graph -->
                <div id="graph"></div>
                <!-- end graph -->

                <!-- start laborer-box -->
                <div class="laborer-box">
                    <a href="/post/account_list">
                        <img src="../img/main_money.png" alt="">
                        <span>노무비 청구서</span>
                    </a>

                    <a href="/post/account_wageslist">
                        <img src="../img/main_tong.png" alt="">
                        <span>노무비 노임대장</span>
                    </a>

                    <a href="/post/account_mandator">
                        <img src="../img/main_tax.png" alt="">
                        <span>노무자 위임장</span>
                    </a>
                </div>
                <!-- end laborer-box -->

            </div>
            <!-- end content-half -->
        </div>{{-- //.content-top end --}}

        <div class="content-bottom">

            <div class="content-half">
                <div class="employee-box table01">
                    <h3>노무자 정보</h3>
                    <table class="">
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>가입일</th>
                            <th>노무자</th>
                            <th>분야</th>
                            <th>출근수</th>
                            <th>신용</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($workers as $i => $worker)
                            @php
                             $data = array('','동바리','경량','타일','목공','미장','조적','조경','덕트','금속','전기','청소','잡일','기타');
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{ date("y-m-d", strtotime($worker->created_at))}}</td>
                                <td><a href="/worker/view/{{$worker->id}}">{{$worker->name}}</a></td>
                                <td>{{$data[$worker->category1]}}</td>
                                <td>{{$worker->chk_days}}</td>
                                <td>{{$worker->credit}}</td>
                            </tr>
                        @endforeach
                        @if ($workers->isEmpty())
                            <tr>
                                <td colspan="6">데이터가 없습니다.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end content-half -->

            <div class="content-half content-right">
                <div class="account-box table01">
                    <h3>거래처 정보</h3>
                    <table class="">
                        <thead>
                        <tr>
                            <th>번호</th>
                            <th>가입일</th>
                            <th>거래처명</th>
                            <th>신용</th>
                            <th>주소지</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($companys as $i => $company)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{ date("y-m-d", strtotime($company->created_at))}}</td>
                                <td><a href="/company/view/{{$company->id}}">{{$company->co_name}}</a></td>
                                <td>{{$company->credit}}</td>
                                <td>{{$company->address}}</td>
                            </tr>
                        @endforeach
                        @if ($companys->isEmpty())
                            <tr>
                                <td colspan="5">데이터가 없습니다.</td>
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

        {{--var a = JSON.parse(<?=$a?>);--}}

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

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function percent(par,total) {
            return (par * total) / 100
        }

    </script>
@endsection
