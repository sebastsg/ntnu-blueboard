function isExternalLink(link) {

	return link.search('http') != -1;

}

function loadPage(link) {

	$('html, body').stop().animate({
		scrollTop: 0
	}, 500);

	$('main > div').load('/ajax' + link, function(response, status, xhr) {
		if (xhr.status == 500) {
			console.log('An internal server error occurred.');
		} else if (xhr.status == 401) {
			document.location.href = '/login';
		}
	});

	history.pushState({}, '', link);

}

$(document)

.on('click', 'a', function(e) {

	var link = $(this).attr('href');

	if (link === undefined || isExternalLink(link)) {
		return;
	}

	e.preventDefault();
	loadPage(link);

})

.on('click', '.action[data-action=login]', function() {

	$.post('/post/login', {

		username: $('#login_username').val(),
		password: $('#login_password').val()

	}, function(response) {


	});

})

.on('click', '.action[data-action=resetpassword]', function() {

	$.post('/post/resetpassword', {

		username: $('#reset_password_username').val(),
		password: $('#reset_password_password').val()

	}, function(response) {


	});

})

;
