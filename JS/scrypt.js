
var captcha = grecaptcha.getResponse();

if (!captcha.length) {
  $('#recaptchaError').text('* Вы не прошли проверку "Я не робот"');
} else {
  $('#recaptchaError').text('');
}

if ((formValid) && (captcha.length)) {
  formData.append('g-recaptcha-response', captcha);
}

grecaptcha.reset();
if ($data.msg) {
  $('#recaptchaError').text($data.msg);
}