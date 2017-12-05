$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    /**
     * Show delete confimation when click button delete
     */
    $('.btn-delete-item').bind('click', function(e){
        e.preventDefault();
        var form = $(this.form);
        var title = $(this).attr('data-title');
        var body = '<i>' + $(this).attr('data-confirm') + '</i>';
        $('#title-content').html(title);
        $('#body-content').html(body);
        $('#confirm').modal('show');
        $('#delete-btn').one('click', function(){
            form.submit();
            $('#confirm').modal('hide');
        })
    });

    /**
    * Get value of city and put in route
    */
    $('#city').change(function (event) {
        let id = this.value;
        $.ajax({
            url: baseURL+'/admin/cities/'+id,
            type: 'get',
            dataType: 'text',
            success : function (result){
                let data = JSON.parse(result);
                $('#cinema_id option[value!="0"]').remove();
                $.each(data.cinemas, function(i, $value) {
                    let $option = $("<option></option>");
                    $option.html($value.name);
                    $option.attr('value', $value.id);
                    $('#cinema_id').append($option);
                });
            }
        });
    });

    /**
    * Create form seat
    */
    var arr_seats = [ 
        'A', 'B', 'C',
        'D', 'E', 'F',
        'G', 'H', 'I', 'J'
    ];
    var type = [
        'Normal', 'VIP', 'Couple'
    ];
    $('#max_seats').change(function () {
        $('#list_seats').html('');
    });
    $('#btn-add-seats').click(function (event) {
        let amount = $('#max_seats').val();
        if (amount > 10){
            $(".message").html('<small style="color:red">Max Seats is not equal 10</small>');
        } else {
            for(let i =0 ; i < amount; i++) {
                let $div = $('<div></div>');
                $div.attr('name', 'list_seats');

                let $spanSeat = $('<span></span>');
                $spanSeat.attr('class', 'fs');
                $spanSeat.attr('name', 'y_axist');
                $spanSeat.html(arr_seats[i]);
                $div.append($spanSeat);
                $('#list_seats').append($div);

                var $number = $("<select></select>");
                $number.attr("name", "seats[" + arr_seats[i] + "][x_axist]");
                $number.attr("class", "fs seats ");
                for(var j =1; j<=15; j++) {
                    let $option = $("<option></option>");
                    $option.html(j);
                    $option.attr('value', j);
                    $number.append($option);
                }

                $div.append($number);
                var $types = $("<select></select>");
                $types.attr("class", "fs type");
                $types.attr("name", "seats[" + arr_seats[i] + "][type]");
                for(var k =0; k<type.length; k++) {
                    let $optionType = $("<option></option>");
                    $optionType.attr("value", k+1);
                    $optionType.html(type[k]);
                    $types.append($optionType);
                }
                $div.append($types);
            }
        }
    });

    /* update seat rows*/
    var oldAmount = $('#max_seats_update').val();
    $('.list_seats div select').each( function ($i, $value) {
        if ($i%2 == 0) {
            $(this).attr("name", "seats[" +arr_seats[$i/2]+ "][x_axist]");  
        } else {
            $(this).attr("name", "seats[" +arr_seats[parseInt($i/2)]+ "][type]");
        }
    });
    $('#btn-update-seats').click(function (event) {
        let amount = $('#max_seats_update').val();
        if (amount <= 10){
            if (amount > oldAmount) {
                var $addSeats = oldAmount; 
                for(let i =0 ; i < amount - oldAmount ; i++) {
                    var $div = $('<div></div>');
                    $div.attr('name', 'new_seats');
                    let $spanSeat = $('<span></span>');
                    $spanSeat.attr('name', 'y_axist');
                    $spanSeat.html(arr_seats[$addSeats]);
                    $addSeats++;
                    $div.append($spanSeat);
                    $('#list_seats').append($div);
                    $('.list_seats div').each( function ($i, $value) {
                       $(this).attr("class", "number-" +$i);  
                    });
                    //
                    var $number = $("<select></select>");
                    $number.attr("name", "seats[" + arr_seats[$addSeats] + "][x_axist]");
                    $number.attr("class", "fs seats ");
                    for(var j =1; j<=15; j++) {
                        let $option = $("<option></option>");
                        $option.html(j);
                        $option.attr('value', j);
                        $number.append($option);
                    }

                    $div.append($number);
                    var $types = $("<select></select>");
                    $types.attr("class", "fs type");
                    $types.attr("name", "seats[" + arr_seats[$addSeats] + "][type]");
                    for(var k =0; k<type.length; k++) {
                        let $optionType = $("<option></option>");
                        $optionType.attr("value", k+1);
                        $optionType.html(type[k]);
                        $types.append($optionType);
                    }
                    $div.append($types);
                }
                $('#list_seats').append($div);
                oldAmount = amount;
            }else {
                $('.list_seats div').each( function ($i, $value) {
                    $(this).attr("class", "number-" +$i);  
                });
                for (let i = oldAmount -1 ; i > amount-1 ; i--) {
                    $('.number-'+i).remove();
                }
                oldAmount = amount;
            }
        } else {
            $(".message").css('display', 'inline');
        }
    }); 
})
