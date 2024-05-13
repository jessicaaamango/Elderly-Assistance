const speakeasy = require('speakeasy')

var verified = speakeasy.totp.verify({
    secret:'x#Ad:lT#B<kQCMc}dR2TxXQGLZyzHx0)', 
    encoding: 'ascii',
    token: '939777'

});

console.log(verified)