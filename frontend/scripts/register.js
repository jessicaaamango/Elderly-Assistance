const loginForm = document.getElementById("Login");
const regForm = document.getElementById("Register");
// const signupButton = document.getElementById("signup-form-submit");
// const signupErrorMsg = document.getElementById("signup-error-msg");

signupButton.addEventListener("click", (e) => {
    e.preventDefault();
    const username = signupForm.username;
    const password = signupForm.password;

    if (username === "user" && password === "web_dev") {
        alert("You have successfully logged in.");
        location.reload();
    } else {
        signupErrorMsg.style.opacity = 1;
    }

    document.getElementById("submit").onclick = function () {
      if (role === "front") {
          location.href = "../html/staff_dashboard.html";
      } else if (role === "user") {
          location.href = "../html/user_dashboard.html";

      } else if (role === "admin") {
          location.href = "../html/ceo_dashboard.html";

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