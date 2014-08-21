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

            $this.html('').addClass('install-loading');
            $.ajax({
                type: 'GET',
                cache: false,
                url: url,
                data: {'module': module, 'disabled': disabled},
                success: function (data) {
                    _switchStatus($this, disabled);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert('启用失败，请重请点击启用');
                }
            }).always(function(){
                $this.removeClass('install-loading');

            });
        });
    };

    var _switchStatus = function (target, status){
        switch (parseInt(status)){
            case 1:
                target.html('禁用').removeClass('label-success').addClass('label-default').attr('data-param',0);
                break;
            case 0:
                target.html('启用').removeClass('label-default').addClass('label-success').attr('data-param',1);
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