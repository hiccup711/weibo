<div action="{{ route('resend_email') }}" method="POST" class="alert alert-warning">
    @csrf
        您的账号还未激活，请查看您的邮箱激活账号
    <a href="javacript:void(0)" id="resendConfirmEmail">重新发送激活邮件</a>
</div>
