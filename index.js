const speakeasy = require('speakeasy')
const qrcode = require('qrcode')

var secret =  speakeasy.generateSecret({
    name: "2FA"
})

console.log(secret)

qrcode.toDataURL(secret.otpauth_url, function(err, data){ 
    console.log(data)
})