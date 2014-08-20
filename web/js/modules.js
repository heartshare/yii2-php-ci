yii.modules = (function ($) {

    //模块安装
    var moduleInstall = function (target){
        var $target = $(target);
        var loadingClass = 'install-loading';
        $target.click(function(){
            $this = $(this);
            if($this.hasClass(loadingClass)){
                return false;
            }
            //disable a status
            $this.children().eq(0).hide();
            $this.addClass(loadingClass);

            var url = $(this).attr('data-action');
            var module = $(this).attr('data-module');
            $.ajax({
                type: 'POST',
                cache: false,
                url: url,
                data: {'module': module},
                success: function (data) {
                   $this.append('<span class="label label-success">安装成功</span>');
                   $this.unbind('click');
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    $this.children().eq(0).show();
                    $this.append('<span class="label label-danger">安装失败</span>')
                }
            }).always(function(){
                $this.removeClass(loadingClass);
            });
        })
    };

    //模块开关
    var moduleSwitch = function (target){
        var $target = $(target);
        $target.click(function(){
            var $this = $(this);
            var url = $this.attr('data-action');
            var module = $this.attr('data-module');
            var disabled = $this.attr('data-param');
            $.ajax({
                type: 'POST',
                cache: false,
                url: url,
                data: {'module': module, 'disabled': disabled},
                success: function (data) {
                    _switchStatus(target, disabled);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('启用失败，请重请点击启用');
                }
            }).always(function(){

            });
        });
    };

    var _switchStatus = function (target, status){
        switch (parseInt(status)){
            case 1:
                target.text('启用').removeClass('label-default').addClass('label-success');
                break;
            case 0:
                target.text('禁用').removeClass('label-success').addClass('label-default');
                break;
        }
    };

    return {
        moduleInstall : function (target){
            moduleInstall(target);
        },

        moduleSwitch : function (target)
        {
            moduleSwitch(target);
        }
    }
})(jQuery)