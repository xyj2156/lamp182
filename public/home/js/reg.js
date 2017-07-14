/**
 * Created by JiefKing on 2017/6/27.
 */

$(function(){
    $('#reg_choose li:not(:eq(0))').click(function (){
        $(this).addClass('active').siblings().removeClass('active');
        var a = $('#reg_all');
        if(this.innerHTML == '邮箱注册'){
            a.removeAttr('style');
        }else if(this.innerHTML == '手机注册') {
            a.css('transform', 'rotateY(180deg)');
        }
    });
});
