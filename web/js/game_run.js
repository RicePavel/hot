
$(document).ready(function() {
    
    $('.city_block').click(function() {
        var block = $(this);
        var selected = block.attr('data-number');
        $.ajax({
            url: window.location.protocol + "//" + window.location.host + '/hot/web/index.php?r=game/select',
            method: 'POST',
            data: {
                selected: selected
            },
            success: function(data) {
                var cssClass = data.win ? 'win_block' : 'lose_block';
                block.addClass(cssClass);
                $("#block_1 .temp").text(data.temp_1);
                $("#block_2 .temp").text(data.temp_2);
            }
        });
    });
    
});

