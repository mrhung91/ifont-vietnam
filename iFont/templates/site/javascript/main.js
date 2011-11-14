function showOverlay() {
	jQuery("#overlay").width(window.outerWidth).height(window.outerHeight).show();
}

function hideOverlay() {
	jQuery("#overlay").hide();
}

function buyPackage(package_id) {
	alert(package_id);
}

function buyFont(font_id) {
	alert(font_id);
}

/* Login function */
function closeLoginBox() {

}

function submitAjaxLogin() {
	var email = $.trim($("#txtLoginEmail").val());
	if (email == "") {
		alert("Vui lòng nhập email đăng nhập.");
		$("#txtLoginEmail").focus();
		return false;
	}

	var password = $.trim($("#txtLoginPassword").val());
	if (password == "") {
		alert("Vui lòng nhập mật khẩu.");
		$("#txtLoginPassword").focus();
		return false;
	}

	$("#formLogin").ajaxSubmit({
        success: onAjaxLoginSuccess
	});
	return false;
}

function onAjaxLoginSuccess(result) {
	if (result == "0") {
		window.location.href = window.location.href;
		return;
	}
	alert('Email hoặc mật khẩu không hợp lệ.');
}

$(document).ready(function() {
	$("a.dialog").each(function() {
		$(this).simpleDialog({
			  showCloseLabel: false
		});
	});
});