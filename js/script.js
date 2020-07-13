$(function () {
    
    $('#contact-form').submit(function(e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        
        $.ajax({
            type: 'POST',
            url: 'php/cible.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                 
                if(json.diff < 0) 
                {
                    $('#contact-form').append("<p class='thank-you'>La date du début doit être antérieure à la date de fin</p>");
                }              
            }
        });
    });

})