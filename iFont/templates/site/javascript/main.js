function showOverlay() {
	jQuery("#overlay").width(window.outerWidth).height(window.outerHeight)
			.show();
}

function hideOverlay() {
	jQuery("#overlay").hide();
}

function buyPackage(lnkObj, package_id) {
	$.post(
		"index.php?option=com_shop&task=cart.ajaxBuyPackage",
		{
			package_id : package_id
		},
		function(data) {
			if (data != null && data.message != null) {
				alert(data.message);
				var num_packages = window.parseInt($("#lblNumCartPackages").text());
				$("#lblNumCartPackages").text(num_packages + 1);
				var $parent = $(lnkObj).parent().parent();
				if (!$parent.hasClass("package-detail")) {
					$parent.remove();
				}
			} else {
				alert("Mua gói phông thất bại");
			}
		},
		"json"
	);
}

function buyFont(lnkObj, font_id) {
	$.post(
		"index.php?option=com_shop&task=cart.ajaxBuyFont",
		{
			font_id : font_id
		},
		function(data) {
			if (data != null && data.message != null) {
				alert(data.message);
				var num_fonts = window.parseInt($("#lblNumCartFonts").text());
				$("#lblNumCartFonts").text(num_fonts + 1);
				var $parent = $(lnkObj).parent().parent();
				if (!$parent.hasClass("font-detail")) {
					$parent.remove();
				}
			} else if (data.error != null) {
				alert(data.errror);
			} else {
				alert("Mua font thất bại");
			}
		},
		"json"
	);
}

function removeFontFromCart(lnkObj, font_id) {
	$.post(
		"index.php?option=com_shop&task=cart.ajaxRemoveFontFromCart",
		{
			font_id : font_id
		},
		function(data) {
			if (data != null && data.message != null) {
				alert(data.message);
				var num_fonts = window.parseInt($("#lblNumCartFonts").text());
				$("#lblNumCartFonts").text(num_fonts - 1);
				$(lnkObj).parent().parent().remove();
				if ($(".font-list").find(".row-font-info").length == 0) {
					$(".font-list").removeClass("table").html("Không có phông nào trong giỏ hàng.");
				}
			} else if (data.error != null) {
				alert(data.errror);
			} else {
				alert("Xóa phông khỏi giỏ hàng thất bại.");
			}
		},
		"json"
	);
}

function removePackageFromCart(lnkObj, package_id) {
	$.post(
			"index.php?option=com_shop&task=cart.ajaxRemovePackageFromCart",
			{
				package_id : package_id
			},
			function(data) {
				if (data != null && data.message != null) {
					alert(data.message);
					var num_packages = window.parseInt($("#lblNumCartPackages").text());
					$("#lblNumCartPackages").text(num_packages - 1);
					$(lnkObj).parent().parent().remove();
					if ($(".font-list").find(".row-font-info").length == 0) {
						$(".font-list").removeClass("table").html("Không có phông nào trong giỏ hàng.");
					}
				} else if (data.error != null) {
					alert(data.errror);
				} else {
					alert("Xóa gói phông khỏi giỏ hàng thất bại.");
				}
			},
			"json"
	);
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
		success : onAjaxLoginSuccess
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

function submitAjaxRegister() {
	var email = $.trim($("#txtRegEmail").val());
	if (email == "") {
		alert("Vui lòng nhập email đăng ký.");
		$("#txtRegEmail").focus();
		return false;
	}

	var password1 = $.trim($("#txtRegPassword1").val());
	if (password1 == "") {
		alert("Vui lòng nhập mật khẩu.");
		$("#txtRegPassword1").focus();
		return false;
	}

	var password2 = $.trim($("#txtRegPassword2").val());
	if (password2 != password1) {
		alert("Mật khẩu xác nhận không đúng.");
		$("#txtRegPassword2").focus();
		return false;
	}

	var phone = $.trim($("#txtRegPhone").val());
	if (phone == "") {
		alert("Vui lòng nhập số điện thoại.");
		$("#txtRegPhone").focus();
		return false;
	}
	$("#txtRegUsername").val(email);
	$("#txtRegName").val(email);

	$("#formRegister").ajaxSubmit({
		success : onAjaxRegisterSuccess
	});
	return false;
}

function onAjaxRegisterSuccess(result) {
	if (result == "0") {
		alert("Đăng ký tài khoản thành công.");
		$("#formRegister").get(0).reset();
		$.simpleDialog.close();
		return;
	}
	alert(result);
}

$(document).ready(function() {
	$("a.dialog").each(function() {
		$(this).simpleDialog({
			showCloseLabel : false
		});
	});
});