
$(document).ready(function() {
    
    $('.active_blocks .city_block').click(function() {
        var block = $(this);
        var headerWin = $("#header_win");
        var headerLose = $("#header_lose");
        var headerQuestion = $("#header_question");
        var activeBlocks = $(".active_blocks");
        var resultBlocks = $(".result_blocks");
        var selected = block.attr('data-number');
        $.ajax({
            url: window.location.protocol + "//" + window.location.host + '/hot/web/index.php?r=game/select',
            method: 'POST',
            data: {
                selected: selected
            },
            success: function(data) {
                activeBlocks.hide();
                resultBlocks.show();
                resultBlocks.find("div").removeClass("win_block");
                resultBlocks.find("div").removeClass("lose_block");
                var cssClass = data.win ? 'win_block' : 'lose_block';
                var selectedBlock = resultBlocks.find(".block_" + data.selected);
                selectedBlock.addClass(cssClass);
                resultBlocks.find(".block_1").text(data.temp_1);
                resultBlocks.find(".block_2").text(data.temp_2);
                headerQuestion.hide();
                if (data.win) {
                    headerWin.show();
                } else {
                    headerLose.show();
                }
            }
        });
    });
    
});

