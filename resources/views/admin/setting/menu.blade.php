@extends('layouts/admin')

@section('title')
    메뉴관리
@endsection

@section('content')
    <div class="contents">
        <div class="content-left">
            <form method="POST" action="">
                @csrf
                <div>
                    <select name="depth" id="depth" required>
                        <option value="">---깊이를 선택해주세요---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <div>
                    <input type="text" name="title" id="title" class="input" placeholder="제목" required>
                </div>

                <div>
                    <input type="text" name="route" id="route" class="input" placeholder="라우트">
                </div>

                <div>
                    <input type="text" name="type" id="type" class="input" placeholder="타입">
                </div>

                <div>
                    <input type="text" name="icon" id="icon" class="input" placeholder="아이콘">
                </div>

                <div>
                    <input type="text" name="order" id="order" class="input" placeholder="순서">
                </div>
            </form>
            <div class="content-submit">
                <button>등록</button>
            </div>
        </div>

        <div class="content-right">
            <table>
                <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>분류</th>
                    <th>이름</th>
                    <th>라우트</th>
                    <th>타입</th>
                    <th>아이콘</th>
                    <th>순서</th>
                </tr>
                </thead>
                <tbody>
                @foreach($first_menus as $first_menu)
                    <tr>
                        <td><input type="checkbox" data-id="{{$first_menu['id']}}"></td>
                        <td><span class="depth first">{{$first_menu['depth']}}</span></td>
                        <td>{{$first_menu['title']}}</td>
                        <td>{{$first_menu['route']}}</td>
                        <td>{{$first_menu['type']}}</td>
                        <td>{{$first_menu['icon']}}</td>
                        <td>{{$first_menu['order']}}</td>
                    </tr>
                    @foreach($second_menus as $second_menu)
                        @if($first_menu['id'] == $second_menu['parent'])
                            <tr>
                                <td><input type="checkbox" data-id="{{$second_menu['id']}}"></td>
                                <td><span class="depth second">{{$second_menu['depth']}}</span></td>
                                <td>{{$second_menu['title']}}</td>
                                <td>{{$second_menu['route']}}</td>
                                <td>{{$second_menu['type']}}</td>
                                <td>{{$second_menu['icon']}}</td>
                                <td>{{$second_menu['order']}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                </tbody>
            </table>

            <!--next link -->
            <div>
                {{$first_menus->links()}}
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.content-submit button').addEventListener('click', function () {
            document.forms[0].submit();
        });
    </script>
@endsection
