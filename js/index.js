$(document).on("click",'button',function () {
    $.ajax({
        url: '/ajax.php',
        type: 'GET',
        dataType: 'json',
        data:{
            start_date:''+$('[name="date_start"]').val(),
            finish_date:''+$('[name="date_finish"]').val(),
            orgId:$('[name="org"]').val()
        },
        success: function (response) {
            let data = '<div class="container main"><div class="row">' +
                    '<div class="col-4"><b>Название организации</b></div>' +
                    '<div class="col-2"><b>Полное имя</b></div>' +
                    '<div class="col-4"><b>Название курса</b></div>' +
                    '<div class="col-2"><b>Статус завершения</b></div>' +
                '</div>';
            if(eval(response).length === 0){
                data+='<div class="row"><div class="col-12" style="text-align: center">Таких нет</div></div>';
            }
            $(eval(response)).each(function (index,value) {
                data+='<div class="row">'+
                '<div class="col-4">'+value.orgName+'</div>'+
                '<div class="col-2">'+value.fullName+'</div>'+
                '<div class="col-4">'+value.courseName+'</div>';
                if(value.state>2){
                    data+='<div class="col-2">Завершён</div></div>';
                }else{
                    data+='<div class="col-2">Не завершен</div></div>';
                }
            });
            $('.main').replaceWith(data+'</div>');
        }
    });
});