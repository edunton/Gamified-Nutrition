$(document).ready(function() {
$("#register").click(function() {
var name = $("#username").val();
var password = $("#pwd").val();
var cpassword = $("#pwd2").val();
if (name == '' || password == '' || cpassword == '') {
alert("Please fill all fields.");
} else if ((password.length) < 8) {
alert("Password should atleast 8 character in length.");
} else if (!(password).match(cpassword)) {
alert("Your passwords don't match. Try again?");
} else if (!/^(?=.*\d).{8,30}$/.test(password)) {
alert("Your password must be between 8 and 30 characters long and with at least one number");
} else if (!/^[a-z0-9]{3,16}$/.test(name)) {
alert("Your username must only contain letters and numbers and be between 3 and 16 characters")
} else {
$.post("signup.php", {
name1: name,
password1: password
}, function(data) {
if (data == 'You have Successfully Registered') {
$("form")[0].reset();
}
alert(data);
});
}
});
});
