var renderIndex = 0;
var TEXT_BOUGHT = "ĐÃ MUA";
var HIDE_MENU_INTERVAL = 5000;
var BACKGROUND_WIDTH = 482;
var backgroundLeft = null;
var hideMenuTimer = null;

function showOverlay() {
	jQuery("#overlay").width(window.outerWidth).height(window.outerHeight)
			.show();
}

function checkAuthentication() {
	if (userId == 0) {
		$("#lnkLogin").click();
		return false;
	}
	return true;
}

function hideOverlay() {
	jQuery("#overlay").hide();
}

function buyPackage(lnkObj, package_id) {
	if (!checkAuthentication()) {
		return;
	}
	$.post(
		"index.php?option=com_shop&task=cart.ajaxBuyPackage",
		{
			package_id : package_id
		},
		function(data) {
			if (data != null && data.message != null) {
				alert(data.message);
				$("#lblNumCartPackages").text(data.num_packages);
				$("#lblNumCartFonts").text(data.num_fonts);
				$(lnkObj).parent().removeClass("btn_buy").addClass("btn_bought").html(TEXT_BOUGHT);
			} else {
				alert("Mua gói phông thất bại");
			}
		},
		"json"
	);
}

function buyFont(lnkObj, font_id) {
	if (!checkAuthentication()) {
		return;
	}

	$.post(
		"index.php?option=com_shop&task=cart.ajaxBuyFont",
		{
			font_id : font_id
		},
		function(data) {
			if (data != null && data.message != null) {
				alert(data.message);
				$("#lblNumCartPackages").text(data.num_packages);
				$("#lblNumCartFonts").text(data.num_fonts);
				$(lnkObj).parent().removeClass("btn_buy").addClass("btn_bought").html(TEXT_BOUGHT);
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
			} else if (data.error != null) {
				alert(data.errror);
			} else {
				alert("Xóa phông khỏi giỏ hàng thất bại.");
			}
			window.location.href = window.location.href;
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
			} else if (data.error != null) {
				alert(data.errror);
			} else {
				alert("Xóa gói phông khỏi giỏ hàng thất bại.");
			}
			window.location.href = window.location.href;
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
		alert("Tài khoản của bạn đã được tạo và một liên kết kích hoạt đã được gửi đến địa chỉ email của bạn.");
		$("#formRegister").get(0).reset();
		$.simpleDialog.close();
		return;
	}
	alert(result);
}

function onRenderSampleFontsText(sampleText) {
	var text = null;
	if (sampleText == null) {
		text = $.trim($("#txtSampleText").val());
		if (text == 'Nhập chữ để xem ví dụ') {
			return;
		}
	} else {
		text = sampleText;
	}

	var fontIds = null;
	$("div[id*='font-sample']").each(function() {
		var fontId = getObjectId(this.id);
		if (fontIds != null) {
			fontIds += "," + fontId;
		} else {
			fontIds = fontId;
		}
	});
	if (fontIds == null) {
		return;
	}

	var currentIndex = ++renderIndex;
	$("span.ajax-loading").removeClass("hide");
	$.post(
		"index.php?option=com_shop&task=font.ajaxRenderSample",
		{
			fontIds : fontIds,
			text: text
		},
		function(data) {
			if (currentIndex != renderIndex) {
				return;
			}
			$("span.ajax-loading").addClass("hide");
			if (data != null) {
				loadFontThumbs(data);
			} else if (data.error != null) {
				alert(data.errror);
			} else {
				alert("Lỗi khi hiển thị text mẫu.");
			}
		},
		"json"
	);
}

function loadFontThumbs(thumbs) {
	for (var font_id in thumbs) {
		$("div#font-sample-" + font_id).find("img").attr("src", thumbs[font_id]);
	}
}

function onRenderSamplePackagesText(sampleText) {
	var text = null;
	if (sampleText == null) {
		text = $.trim($("#txtSamplePackageText").val());
		if (text == 'Nhập chữ để xem ví dụ') {
			return;
		}
	} else {
		text = sampleText;
	}

	var packageIds = null;
	$("div[id*='package-sample']").each(function() {
		var packageId = getObjectId(this.id);
		if (packageIds != null) {
			packageIds += "," + packageId;
		} else {
			packageIds = packageId;
		}
	});
	if (packageIds == null) {
		return;
	}

	var currentIndex = ++renderIndex;
	$("span.ajax-loading").removeClass("hide");
	$.post(
		"index.php?option=com_shop&task=package.ajaxRenderSample",
		{
			packageIds : packageIds,
			text: text
		},
		function(data) {
			if (currentIndex != renderIndex) {
				return;
			}
			$("span.ajax-loading").addClass("hide");
			if (data != null) {
				for (var packageId in data) {
					$("div#package-sample-" + packageId).find("img").attr("src", data[packageId]);
				}
			} else if (data.error != null) {
				alert(data.errror);
			} else {
				alert("Lỗi khi hiển thị text mẫu.");
			}
		},
		"json"
	);
}

function getObjectId(idStr) {
	var pos = idStr.lastIndexOf("-");
	return window.parseInt(idStr.substr(pos + 1));
}

function showRegisterBox() {
	$("a.close").click();
	$("#lnkRegister").click();
}

function showObject(objectId) {
	$(objectId).removeClass("hide");
}

function hideObject(objectId) {
	$(objectId).addClass("hide");
}

function toggleDisplay(dropdownId) {
	var $dropdown = $(dropdownId);
	if ($dropdown.hasClass("hide")) {
		$dropdown.removeClass("hide");
	} else {
		$dropdown.addClass("hide");
	}
}

function onSortPackages(filter_order) {
	$("#txtFilterOrder").val(filter_order);
	$("#shopForm").submit();
}

function onSortFonts(filter_order) {
	$("#txtFilterOrder").val(filter_order);
	$("#shopForm").submit();
}

function getQueryVariableValue(url, varName) {
	var query = url.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == varName) {
            return pair[1];
        }
    }
    return null;
}

function setMenuAutoHide() {
	hideMenuTimer = setTimeout("hideMainMenu()", HIDE_MENU_INTERVAL);
}

function hideMiniMenu() {
	$("#mini-menu-wrapper").addClass("hide");
}

function hideMainMenu() {
	if (hideMenuTimer != null) {
		window.clearTimeout(hideMenuTimer);
	}
	$(".panel_left").addClass("hide");
	$(document.body).animate({backgroundPosition: '-1440px 0px'}, function() {
		showMiniMenu();
	});
}

function showMainMenu(animation) {
	var offsetLeft = backgroundLeft - BACKGROUND_WIDTH;
	setMenuAutoHide();
	if (animation == true) {
		$(document.body).animate({backgroundPosition: offsetLeft + 'px 0px'}, function() {
			$(".panel_left").removeClass("hide");
		});
	} else {
		$(document.body).css("backgroundPosition", offsetLeft + 'px 0px');
	}
}

function showMiniMenu() {
	$("#mini-menu-wrapper").removeClass("hide");
}

function calBackgroundLeftProperty() {
	backgroundLeft = $(".panel_left").width() + $("#container").offset().left;
	if ($.browser.safari) {
		backgroundLeft -= 1;
	} else if($.browser.msie) {
		backgroundLeft += 2;
	}
}

$(document).ready(function() {
	$("a.dialog").each(function() {
		$(this).simpleDialog({
			showCloseLabel : false
		});
	});

	calBackgroundLeftProperty();
	showMainMenu(false);
	$(window).resize(function() {
		calBackgroundLeftProperty();
		if ($("#mini-menu-wrapper").hasClass("hide")) {
			showMainMenu(false);
		}
	});
	$("#lnkShowMainMenu").click(function() {
		hideMiniMenu();
		showMainMenu(true);
	});
	$("#lnkHideMainMenu").click(function() {
		hideMainMenu();
	});
});