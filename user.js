//JQUERY = Libraire = une boite à outils 
$(document).ready(function() {
    console.log('1: jquery ready');
    
    $('button#btn').on('click', function() {
        $('#product-list td').css('font-weight', 600);
        $('input[type="submit"]').val('A');
        $(this).text('DONT');
    });
    
    $('.delete-btn').on('click', function() {
        let pk = $(this).data('id');
        $.post('ajax_user.php', { delete: true, pk: pk })
            .done(function () {
                $('.delete-btn').parents('tr').first().detach();
            })
            .fail(function () {
                alert("Une erreur s'est produite, réessayez !")
            });
    });

    $('.update-btn').on('click', function() {
        let pk = $(this).data('id');
        console.log(pk);
        $.post('ajax_user.php', { update: true, pk: pk })
            .done(function (data) {
                let user = JSON.parse(data);
                $("input[name='type']").val('update');
                $("input[name='pk']").val(user.pk);
                $("input[name='name']").val(user.name);
                $("input[name='password']").val(user.password);
                $("input[name='created_at']").val(user.createdAt);
            })
            .fail(function () {
                alert("Une erreur s'est produite, réessayez !")
            });
    });
    
    $('#search-form').on('submit', function(event) {
        
        event.preventDefault();
        $.get(
            'ajax.php',
            {pk: $('#pk-search').val()}
        )
        .done(function(data) {
           $('#ajax-rsp').html(data);  
        });
        
    });
    
});

