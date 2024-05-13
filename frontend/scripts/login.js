
const loginForm = document.getElementById("Login");
const regForm = document.getElementById("Register");
// const loginButton = document.getElementById("login-form-submit");
// const loginErrorMsg = document.getElementById("login-error-msg");

loginButton.addEventListener("click", (e) => {
    e.preventDefault();
    const id = loginForm.id;
    const username = loginForm.email;
    const password = loginForm.password;
    const role = regForm.role;

    if (id == "id" && username === "email" && password === "web_dev") {
        // switching pages
        document.getElementById("submit").onclick = function () {
            if (role === "front") {
                location.href = "../html/staff_dashboard.html";
            } else if (role === "user") {
                location.href = "../html/user_dashboard.html";
      
            } else if (role === "admin") {
                location.href = "../html/ceo_dashboard.html";
      
            }
        }
    };

});

// QR CODE Funtionality
var secret =  speakeasy.generateSecret({
    name: "2FA"
})

console.log(secret)

qrcode.toDataURL(secret.otpauth_url, function(err, data){ 
    console.log(data)
});

const speakeasy = require('speakeasy')

var verified = speakeasy.totp.verify({
    secret:'x#Ad:lT#B<kQCMc}dR2TxXQGLZyzHx0)', 
    encoding: 'ascii',
    // token: '939777'

});

console.log(verified);




