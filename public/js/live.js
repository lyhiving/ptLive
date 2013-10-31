$(document).ready(function(){
    function init() {
        $('.fancybox').fancybox();
        $('a.comment').unbind('click').click(function() {;
            $(this).parent().parent().find("div.comment").slideToggle();
            return false;
        });

        // 发表评论
        var options = { 
            // target: '#output1',
            beforeSubmit: function(formData, $form, options) {
                if (formData.length == 2) {
                    for (var i=0; i < formData.length; i++) { 
                        if (formData[i].value == '') {
                            alert('评论不能留空');
                            return false;
                        }
                    }
                    $form.find('[type="submit"]').prop('disabled', true);
                } else return false;
            },
            success: function(responseText, statusText, xhr, $form) {
                if (responseText == 'ok') {
                    alert('发表成功');
                    var name = $form.find('[name="name"]').val();
                    $form.parent().find('.comment-list').append(
                        '<div class="clearfix">' +
                            '<strong>' + name + ': </strong>' +
                            '<span class="msg">' +
                            $form.find('[name="msg"]').val() +
                            '</span>' +
                    '</div>');
                    $('.comment>form>input[name="msg"]').val('');
                    $('input[name="name"]').val(name);
                }
                $form.find('[type="submit"]').prop('disabled', false);
            }
        }; 
        $('.comment>form').ajaxForm(options); 

        // 设置左右两边大小
        $('.live-pic').height($('div.live-pt').height());
    }

    init();
    
    // 加载图文
    var load_num = 10;
    $('#load-pt').click(function() {
        var $live = $(this).parent().parent().find('.live-body');
        $.get('index.php?r=site/loadPt&offset=' + load_num,
            function(data) {
                if (data != '') {
                    $live.append(data);
                    init();
                } else {
                    $('.load-pt').text('没有更多图文');
                }
            }
        );
        load_num += 10;
        return false;
    });
});
