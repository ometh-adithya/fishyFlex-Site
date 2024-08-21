// adminsidebar
(() => {
    'use strict'
    const tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(tooltipTriggerEl => {
        new bootstrap.Tooltip(tooltipTriggerEl)
    })
})()
// adminsidebar

// scroll Animation

ScrollReveal({
    reset: true,
    distance: '100px',
    duration: 2000,
    delay: 100
});

ScrollReveal().reveal('.top', { origin: 'top' });
ScrollReveal().reveal('.right', { origin: 'right' });
ScrollReveal().reveal('.left', { origin: 'left' });
ScrollReveal().reveal('.bottom', { origin: 'bottom' });

// scroll Animation

// sweet alert
function showAlert(title, text, icon) {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
    }).then(() => {
        window.location.reload();
    });
}
// sweet alert

function signUp() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var nb = document.getElementById("nb");
    var email = document.getElementById("email");
    var pass = document.getElementById("password");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("nb", nb.value);
    form.append("email", email.value);
    form.append("pass", pass.value);
    form.append("gender", gender.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("success", "Your are successfully SignUp", "success");
                window.location = "signIn.php";
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("POST", "signupProcess.php", true);
    request.send(form);

}

function signIn() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberme", rememberme.checked);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("success", "You are successfully Signin", "success")
                    window.location = "index.php";
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("POST", "signInprocess.php", true);
    request.send(form);

}

function adminSignIn() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberme", rememberme.checked);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("success", "You are successfully Signin", "success");
                window.location = "adminDashboard.php";
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("POST", "adminSignInprocess.php", true);
    request.send(form);

}

var fPModal;

function forgetPassword() {

    var email = document.getElementById("email");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "Success") {
                    var modal = document.getElementById("changebox");
                    fPModal = new bootstrap.Modal(modal);
                    fPModal.show();
            } else {
                showAlert("Error", response, "error");
            }

        }
    }

    request.open("GET", "frogetPasswordProcess.php?e=" + email.value, true);
    request.send();

}

function resetPassword() {

    var newps = document.getElementById("newps");
    var vcode = document.getElementById("vcode");

    var form = new FormData();
    form.append("n", newps.value);
    form.append("v", vcode.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("Success", "New password updated.", "success").then(() => {
                    fPModal.hide();
                });
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(form);

}

function showPassword() {

    var input = document.getElementById("newps");
    var button = document.getElementById("shb");

    if (input.type == "password") {
        input.type = "text";
        button.innerHTML = "Hide";
    } else {
        input.type = "password";
        button.innerHTML = "Show";
    }

}

function updateImage() {
    var img = document.getElementById("profileimage");

    img.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("img").src = url;
    }

}

function updateProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var number = document.getElementById("number");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var pcode = document.getElementById("pcode");
    var province = document.getElementById("province");
    var distric = document.getElementById("distric");
    var city = document.getElementById("city");
    var image = document.getElementById("profileimage");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("number", number.value);
    form.append("line1", line1.value);
    form.append("line2", line2.value);
    form.append("pcode", pcode.value);
    form.append("province", province.value);
    form.append("distric", distric.value);
    form.append("city", city.value);
    form.append("image", image.files[0]);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("Success", "Your Profile Successfully Updated", "success");
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("POST", "updateProfileProcess.php", true);
    request.send(form);

}

function addToCart(product) {

    var qty = document.getElementById("qty");

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("Success", "Succesfully added to cart", "success");
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("GET", "addToCartProcess.php?product=" + product + "&qty=" + qty.value, true);
    request.send();

}

function loadCart() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("content").innerHTML = response;
        }
    }

    request.open("GET", "loadCartProcess.php", true);
    request.send();

}

// function search() {

//     var search = document.getElementById("search");

//     var request = new XMLHttpRequest();
//     request.onreadystatechange = function () {
//         if (request.status == 200 && request.readyState == 4) {
//             var response = request.responseText;
//             alert(response);
//         }
//     }

//     request.open("GET", "catResultProcess.php?search=" + search.value, true);
//     request.send();

// }

function advanceSearch(x) {

    var type = document.getElementById("type");
    var fishSize = document.getElementById("fishSize");
    var certificate = document.getElementById("certificate");
    var check = document.getElementById("check");
    var check1 = document.getElementById("check1");
    var tankvaritey = document.getElementById("tankvaritey");
    var tank_size = document.getElementById("tank_size");
    var search = document.getElementById("search");
    var pf = document.getElementById("pf");
    var pt = document.getElementById("pt");

    var form = new FormData();
    form.append("type", type.value);
    form.append("fishSize", fishSize.value);
    form.append("certificate", certificate.value);
    form.append("check", check.checked);
    form.append("check1", check1.checked);
    form.append("tankvaritey", tankvaritey.value);
    form.append("tank_size", tank_size.value);
    form.append("search", search.value);
    form.append("pf", pf.value);
    form.append("pt", pt.value);
    form.append("page", x);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            document.getElementById("content").innerHTML = response;
        }
    }

    request.open("POST", "advancedSearchProcess.php", true);
    request.send(form);
}

function removeFromCart(cartId) {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("success", "successfully removed", "success");
                loadCart();
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("GET", "removeFromcart.php?cartId=" + cartId, true);
    request.send();
}


function addQty(cartId) {

    var qty = document.getElementById("qty-" + cartId);

    var newQty = parseInt(qty.value) + 1;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                loadCart();
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("GET", "updateQtyProcess.php?cartId=" + cartId + "&qty=" + newQty, true);
    request.send();
}

function minusQty(cartId) {

    var qtyElement = document.getElementById("qty-" + cartId);
    var qty = parseInt(qtyElement.value);

    if (qty <= 1) {
        showAlert("Warning", "Invalid Quantity", "error");
    } else {
        var newQty = qty - 1;

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.status == 200 && request.readyState == 4) {
                var response = request.responseText;
                if (response == "success") {
                    loadCart();
                } else {
                    showAlert("Error", response, "error");
                }
            }
        }

        request.open("GET", "updateQtyProcess.php?cartId=" + cartId + "&qty=" + newQty, true);
        request.send();
    }

}

function checkout() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var uid = obj["uid"];
            var amount = obj["amount"];
            if (response == 1) {
                alert("Please Login");
                window.location = "index.php";
            } else if (response == 2) {
                alert("Please update your profile.");
                window.location = "userProfile.php";
            } else {


                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    showAlert("success", "Payment completed. OrderID:" + orderId, "success");
                    saveInvoice1(orderId, uid, amount);
                };

                payhere.onDismissed = function onDismissed() {
                    showAlert("Warning", "Payment Dismissed", "warning");
                };

                payhere.onError = function onError(error) {
                    showAlert("Error", "couldn't finished the payement" + error, "error");
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/fishyflex/cart.php",     // Important
                    "cancel_url": "http://localhost/fishyflex/cart.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": uid,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };


            }

        }
    }

    request.open("GET", "checkoutProcess.php", true);
    request.send();

}

function saveInvoice1(orderId, uid, amount) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("a", amount);
    form.append("u", uid);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?oid=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcess1.php", true);
    request.send(form);

}


function sendFeedback() {

    var name = document.getElementById("name");
    var email = document.getElementById("email");
    var feedback = document.getElementById("feedback");
    var product = document.getElementById("product");

    var form = new FormData();
    form.append("name", name.value);
    form.append("email", email.value);
    form.append("feedback", feedback.value);
    form.append("product", product.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("success", "successfully send", "success");
            } else {
                showAlert("Error", response, "error");
            }
        }
    }


    request.open("POST", "sendFeedBackProcess.php", true);
    request.send(form);

}


function addProduct() {
    var categories = document.getElementById("categories");
    var tankvaritey = document.getElementById("tankvaritey");
    var certificate = document.getElementById("certificate");
    var proname = document.getElementById("proname");
    var desc = document.getElementById("desc");
    var qty = document.getElementById("qty");
    var profileimage = document.getElementById("profileimage");
    var price = document.getElementById("price");
    var condition = document.getElementById("condition");
    var ts = document.getElementById("ts");
    var fs = document.getElementById("fs");

    var form = new FormData();
    form.append("categories", categories.value);
    form.append("tankvaritey", tankvaritey.value);
    form.append("certificate", certificate.value);
    form.append("proname", proname.value);
    form.append("desc", desc.value);
    form.append("qty", qty.value);
    form.append("image", profileimage.files[0]);
    form.append("price", price.value);
    form.append("condition", condition.value);
    form.append("fs", fs.value);
    form.append("ts", ts.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if(response == "success"){
                showAlert("Success", "Producte Added", "success");
            }else{
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("POST", "addProductProcess.php", true);
    request.send(form);

}

function manageProduct(pId) {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("Success", "Updated", "success");
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("GET", "managePoductProcess.php?pid=" + pId, true);
    request.send();

}

function buynow(pid) {
    var qty = document.getElementById("qty").value;

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;

            var obj = JSON.parse(response);

            var uid = obj["umail"];
            var amount = obj["amount"];
            if (response == 1) {
                alert("Please Login");
                window.location = "index.php";
            } else if (response == 2) {
                alert("Please update your profile.");
                window.location = "setting.php";
            } else {


                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    showAlert("success", "Payment completed. OrderID:" + orderId, "success");
                    saveInvoice(orderId, pid, uid, amount, qty);
                };

                payhere.onDismissed = function onDismissed() {
                    showAlert("Warning", "Payment Dismissed", "warning");
                };

                payhere.onError = function onError(error) {
                    showAlert("Error", "couldn't finished the payement" + error, "error");
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/fishyflex/singleProductView.php?product=" + pid,     // Important
                    "cancel_url": "http://localhost/fishyflex/singleProductView.php?product=" + pid,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount + ".00",
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": uid,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };


            }

        }
    }

    request.open("GET", "buyNowProcess.php?id=" + pid + "&q=" + qty, true);
    request.send();

}

function saveInvoice(orderId, pid, uid, amount, qty) {

    var form = new FormData();
    form.append("o", orderId);
    form.append("i", pid);
    form.append("a", amount);
    form.append("q", qty);
    form.append("u", uid);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;

            if (response == "success") {
                window.location = "invoice.php?oid=" + orderId;
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "saveInvoiceProcess.php", true);
    request.send(form);

}

function printArea() {
    var printPage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = printPage;
}

function blockUser(uid) {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("Success", "Updated", "success");
            } else {
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("GET", "manageUserProcess.php?uId=" + uid, true);
    request.send();
}

function sendEmail() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var msg = document.getElementById("msg").value;

    // alert(email);

    var form = new FormData();
    form.append("msg", msg);
    form.append("email", email);
    form.append("name", name);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 && request.readyState == 4) {
            var response = request.responseText;
            if(response == "Success"){
                showAlert("Success", "Email has sent", "success");
            }else{
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("POST", "sendEmailProcess.php", true);
    request.send(form);

}

function signout() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.status == 200 & request.readyState == 4) {
            var response = request.responseText;
            if (response == "success") {
                showAlert("Success", "SignOut Successfull", "success");
            }else{
                showAlert("Error", response, "error");
            }
        }
    }

    request.open("GET", "signOutProcess.php", true);
    request.send();

}