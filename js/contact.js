jQuery(document).ready(function($) {
    "use strict";

    $('form.contactForm').submit(function() {
        $.ajax({
            type: "POST",
            url: 'contact.php',
            data: $(this).serialize(),
            success: function(msg) {
                if (msg === 'OK') {
                    alert('Succesfully sent the message. We will contact you shortly.');

                    $('#email').val("");
                    $('#contactType').val("questions");
                    $('#message').val("");
                } else {
                    alert(msg);
                }

            }
        });

        return false;
    });
});
