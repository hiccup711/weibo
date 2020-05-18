require('./bootstrap');

$('#resendConfirmEmail').click(function () {
    resendConfirmEmail()
});

function resendConfirmEmail() {
    console.log('test');
    $.post(
        '/users/resend',
        {
            _token : $("input[name='_token']").val()
        },
        function()
        {
            location.reload();
        }
    );
}
