$(document).ready(function(){
    $('#newpass').click(function() {
        if($('#newpass').is(':checked')) {
            $('#formnewpass').show('slow');
        }
        else{
            $('#formnewpass').hide('slow');
        }
    });

    $('input[type="password"]').after(' <input type="checkbox" style="margin-top: 10px;"class="check" /> Show password');
    $('.check').change(function(){
        var prev = $(this).prev();
        var value = prev.val();
        var type = prev.attr('type');
        var name = prev.attr('name');
        var id = prev.attr('id');
        var klass = prev.attr('class');
        var new_type = (type == 'password') ? 'text' : 'password';
        prev.remove();
        $(this).before('<input type="'+new_type+'" value="' +value+ '" name="' +name+ '" value="' +value+ '"id="' +id+ '" class="' +klass+ '" />');

    });
});