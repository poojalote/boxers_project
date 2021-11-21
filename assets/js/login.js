function checkLogin() {

	// console.log('hiiii');
	var formData = new FormData(document.querySelector('#loginForm'));
	app.request("LoginController/login_validation", formData).then(success => {
		if (success.status === 200) {
			let userData = success.data;
			app.successToast(success.body);

		} else {
			app.errorToast(success.body);
		}

	}).catch(error => console.log(error));
}
