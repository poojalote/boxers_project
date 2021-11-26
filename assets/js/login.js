function checkLogin() {

	// console.log('hiiii');
	var formData = new FormData(document.querySelector('#loginForm'));
	app.request("LoginController/login_validation", formData).then(success => {
		if (success.status == 200) {
			window.location.href = "EventManagement";
		} else {
			app.errorToast("Something Went Wrong");
		}

	}).catch(error => console.log(error));
}
