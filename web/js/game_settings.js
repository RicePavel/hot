
$(document).ready(function() {
    $(".unit_radio").change(function() {
        var unit = $('input.unit_radio:checked').val();
        $.ajax({
            url: window.location.protocol + "//" + window.location.host + '/hot/web/index.php?r=game/change_unit',
            method: 'POST',
            data: {
                unit: unit
            },
            success: function(data) {
                if (data.ok) {
                    location.reload();   
                } else {
                    alert('Ошибка при выполнении запроса');
                }
            }
        });
    });
});


