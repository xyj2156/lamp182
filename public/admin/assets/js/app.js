$(function() {
    // 读取body data-type 判断是哪个页面然后执行相应页面方法，方法在下面。
    // var dataType = $('body').attr('data-type');
    // console.log(dataType);
    // for (key in pageData) {
    //     if (key == dataType) {
    //         pageData[key]();
    //     }
    // }
    //     // 判断用户是否已有自己选择的模板风格
    //    if(storageLoad('SelcetColor')){
    //      $('body').attr('class',storageLoad('SelcetColor').Color)
    //    }else{
    //        storageSave(saveSelectColor);
    //        $('body').attr('class','theme-black')
    //    }

    autoLeftNav();
    $(window).resize(function() {
        autoLeftNav();
        console.log($(window).width())
    });

    //    if(storageLoad('SelcetColor')){

    //     }else{
    //       storageSave(saveSelectColor);
    //     }
});

// 风格切换

$('.tpl-skiner-toggle').on('click', function() {
    $('.tpl-skiner').toggleClass('active');
})

$('.tpl-skiner-content-bar').find('span').on('click', function() {
    $('body').attr('class', $(this).attr('data-color'))
    saveSelectColor.Color = $(this).attr('data-color');
    // 保存选择项
    storageSave(saveSelectColor);

})




// 侧边菜单开关


function autoLeftNav() {



    $('.tpl-header-switch-button').on('click', function() {
        if ($('.left-sidebar').is('.active')) {
            if ($(window).width() > 1024) {
                $('.tpl-content-wrapper').removeClass('active');
            }
            $('.left-sidebar').removeClass('active');
        } else {

            $('.left-sidebar').addClass('active');
            if ($(window).width() > 1024) {
                $('.tpl-content-wrapper').addClass('active');
            }
        }
    })

    if ($(window).width() < 1024) {
        $('.left-sidebar').addClass('active');
    } else {
        $('.left-sidebar').removeClass('active');
    }
}


// 侧边菜单
$('.sidebar-nav-sub-title').on('click', function() {
    $(this).siblings('.sidebar-nav-sub').slideToggle(80)
        .end()
        .find('.sidebar-nav-sub-ico').toggleClass('sidebar-nav-sub-ico-rotate');
});

setTimeout(function (){
//    获取网址来设定展开的菜单
    var path = location.pathname.split('/')[2];
    var arr = {
        'user'    : 1,
        'film'    : 2,
        'cast'    : 3,
        'type'    : 4,
        'config'  : 5,
        'link'    : 6
    };
    var li = $('.left-sidebar>.sidebar-nav>.sidebar-nav-link');
    li.eq(arr[path]).find('span.am-icon-chevron-down').addClass('sidebar-nav-sub-ico-rotate');
    li.eq(arr[path]).find('ul.sidebar-nav').css('display', 'block');
},0);