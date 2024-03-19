window.addEventListener('load', function () {

    menuActive(); // 메뉴 활성화

});
//--- 메뉴 클릭 이벤트
document.querySelector('.nav-list').addEventListener('click', function(e){

    if (this.classList.contains('.nav-list'))
        return

    //--- 이벤트 대상체
    let menu = e.target;
    let secondMenu = undefined; // 2차메뉴
    let menuList = document.querySelectorAll('.nav-list > li');
    let check = true; // 이미 선택한 메뉴가 있다면 false

    //--- 클릭한 메뉴의 대상체의 active 효과를 주기위해 LI 태그를 저장시킨다.
    switch (menu.nodeName) {
        case "LI":
            secondMenu = menu.nextElementSibling;
            break;


        case "SPAN":
            secondMenu = menu.parentNode;
            break;
    }

    if (secondMenu) {

        // 기존에 active 효과를 주었던 li들을 제거 합니다.
        menuList.forEach(function (list) {

            // active 되어 있던 메뉴를 클릭했을 시
            if (list.classList.contains('active') && secondMenu == list) {
                check = false;
            }

            // 모든 메뉴의 클래스 active를 제거
            list.classList.remove('active');
        });


        if (check) {
            // 클릭한 리스트에 active 합니다.
            secondMenu.classList.add('active');
        }
    }
});

//--- 메뉴 활성화시킵니다.
function menuActive(e) {

    // 이동한 메뉴 활성화 시키기
    var path = document.location;

    var menuList1 = document.querySelectorAll('.nav-list li a');
    var menuList2 = document.querySelectorAll('.nav-list li ul a');

    menuList1.forEach(function (list) {
        if (list.href === path.href) {
            list.parentNode.classList.add('active');
            return false;
        }
    });

    menuList2.forEach(function (list) {
        if (list.href === path.href) {
            list.parentNode.classList.add('active');
            list.parentNode.parentNode.parentNode.classList.add('active');
            return false;
        }
    });
}


/**
 * active 일때 화살표모양 변경 함수
 * @param target : LI tag (메뉴리스들)
 * @param arrow  : I tag (up, down 아이콘)
 */
function arrowChange(target, arrow) {

    if (target.classList.contains('active')) {
        arrow.classList.remove('fa-caret-up');
        arrow.classList.add('fa-caret-down');

        return false;
    }

    arrow.classList.remove('fa-caret-down');
    arrow.classList.add('fa-caret-up');
}

/**
 * 메뉴 클릭시 활성화 되어있는 메뉴를 비활성화 시키고, 화살표방향을 위로 다올립니다.
 * @param menus : menu ul tag (.nav-list)
 */
function menuDisabled(menus) {

    for (let menu of menus) {

        //--- 최상단 메인명은 제외 합니다. ex) 사이트관리
        if (menu.classList.contains('nav-info'))
            continue;

        //--- 모든 active 메뉴 비활성화
        menu.classList.remove('active');

        //---
        if (menu.nodeName === 'OL')
            continue;

        //--- 모든 화살표 방향을 위로 향하게 바꿉니다.
        menu.children[2].classList.remove('fa-caret-down');
        menu.children[2].classList.add('fa-caret-up');
    }
}

