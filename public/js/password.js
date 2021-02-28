$(document).ready(function() {
	$('input[name=password]').keyup(function() {
		var pswd = $(this).val();
		if ( pswd.length < 8 ) {
			$('#length').removeClass('valid').addClass('invalid');
		} else {
			$('#length').removeClass('invalid').addClass('valid');
		}
		if ( pswd.match(/[A-z]/) ) {
			$('#letter').removeClass('invalid').addClass('valid');
		} else {
			$('#letter').removeClass('valid').addClass('invalid');
		}
		if ( pswd.match(/[A-Z]/) ) {
			$('#capital').removeClass('invalid').addClass('valid');
		} else {
			$('#capital').removeClass('valid').addClass('invalid');
		}
		if ( pswd.match(/\d/) ) {
			$('#number').removeClass('invalid').addClass('valid');
		} else {
			$('#number').removeClass('valid').addClass('invalid');
		}

		if ( pswd.match(/[#?!@$%^&*-]/) ) {
			$('#special').removeClass('invalid').addClass('valid');
		} else {
			$('#special').removeClass('valid').addClass('invalid');
		}
	}).focus(function() {
		$('#pswd_info').show();
	}).blur(function() {
		$('#pswd_info').hide();
	});

	$('#confirm_password').on('keyup', function () {
		if ($('#password').val() == $('#confirm_password').val()) {
			$('#message').html('Matching').css('color', 'green');
		} else 
		$('#message').html('Confirm password must be same as password !').css('color', 'red');
	}).focus(function() {
		$('#message').show();
	}).blur(function() {
		$('#message').hide();
	});
});