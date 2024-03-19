    <?php $type = $attributes['type']; ?>

<nav id="nav">

    <ul class="nav-list">
        @foreach($first_menus as $first_menu)
            <li class="{{$type == $first_menu['type']? 'active':''}}">
                <i class="fas {{$first_menu['icon']}}"></i>
                <span>{{$first_menu['title']}}</span>
                <i class="fas fa-caret-{{$type == $first_menu['type']? 'down':'up'}} arrow"></i>
            </li>
            @foreach($second_menus as $second_menu)
                @if($first_menu['id'] == $second_menu['parent'])
                    <ol class="{{$type == $first_menu['type']? 'on':''}} nav-sub-menu">
                        <li><a href="admin/{{$second_menu['route']}}">{{$second_menu['title']}}</a></li>
                    </ol>
                @endif
            @endforeach
        @endforeach
    </ul>
    <!-- end .nav-list -->
</nav>
