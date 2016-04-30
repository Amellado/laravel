/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  Browser Fingerprinting                             (c) Agustin Mellado  2016 / UTFSM Licence  */
/*                                                                                                */
/*  - see http://dev.madgoatstd.com for examples                                                  */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
'use strict';
/* Initialization variables                                                                       *
 * for user-pass module, formIdentifier is the info the user uses to connect, like mail, nick,    
 * username,etc. formPassword is the password matching the first field. These values must match 
 * the name attributes of this fields.
 * formFingerprint is name of the added value form.
*/
var formIdentifier = "user";
var formPassword = "pass";
var formFingerprint = "fingerprint";
/*///////////////////////////////////////SHA1 IMPLEMENTATION//////////////////////////////////////*/
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  SHA-1 implementation in JavaScript                  (c) Chris Veness 2002-2014 / MIT Licence  */
/*                                                                                                */
/*  - see http://csrc.nist.gov/groups/ST/toolkit/secure_hashing.html                              */
/*        http://csrc.nist.gov/groups/ST/toolkit/examples.html                                    */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

/* jshint node:true *//* global define, escape, unescape */

/**
 * SHA-1 hash function reference implementation.
 *
 * @namespace
 */
var Sha1 = {};


/**
 * Generates SHA-1 hash of string.
 *
 * @param   {string} msg - (Unicode) string to be hashed.
 * @returns {string} Hash of msg as hex character string.
 */
Sha1.hash = function(msg) {
    // convert string to UTF-8, as SHA only deals with byte-streams
    msg = msg.utf8Encode();

    // constants [§4.2.1]
    var K = [ 0x5a827999, 0x6ed9eba1, 0x8f1bbcdc, 0xca62c1d6 ];

    // PREPROCESSING

    msg += String.fromCharCode(0x80);  // add trailing '1' bit (+ 0's padding) to string [§5.1.1]

    // convert string msg into 512-bit/16-integer blocks arrays of ints [§5.2.1]
    var l = msg.length/4 + 2; // length (in 32-bit integers) of msg + ‘1’ + appended length
    var N = Math.ceil(l/16);  // number of 16-integer-blocks required to hold 'l' ints
    var M = new Array(N);

    for (var i=0; i<N; i++) {
        M[i] = new Array(16);
        for (var j=0; j<16; j++) {  // encode 4 chars per integer, big-endian encoding
            M[i][j] = (msg.charCodeAt(i*64+j*4)<<24) | (msg.charCodeAt(i*64+j*4+1)<<16) |
                (msg.charCodeAt(i*64+j*4+2)<<8) | (msg.charCodeAt(i*64+j*4+3));
        } // note running off the end of msg is ok 'cos bitwise ops on NaN return 0
    }
    // add length (in bits) into final pair of 32-bit integers (big-endian) [§5.1.1]
    // note: most significant word would be (len-1)*8 >>> 32, but since JS converts
    // bitwise-op args to 32 bits, we need to simulate this by arithmetic operators
    M[N-1][14] = ((msg.length-1)*8) / Math.pow(2, 32); M[N-1][14] = Math.floor(M[N-1][14]);
    M[N-1][15] = ((msg.length-1)*8) & 0xffffffff;

    // set initial hash value [§5.3.1]
    var H0 = 0x67452301;
    var H1 = 0xefcdab89;
    var H2 = 0x98badcfe;
    var H3 = 0x10325476;
    var H4 = 0xc3d2e1f0;

    // HASH COMPUTATION [§6.1.2]

    var W = new Array(80); var a, b, c, d, e;
    for (var i=0; i<N; i++) {

        // 1 - prepare message schedule 'W'
        for (var t=0;  t<16; t++) W[t] = M[i][t];
        for (var t=16; t<80; t++) W[t] = Sha1.ROTL(W[t-3] ^ W[t-8] ^ W[t-14] ^ W[t-16], 1);

        // 2 - initialise five working variables a, b, c, d, e with previous hash value
        a = H0; b = H1; c = H2; d = H3; e = H4;

        // 3 - main loop
        for (var t=0; t<80; t++) {
            var s = Math.floor(t/20); // seq for blocks of 'f' functions and 'K' constants
            var T = (Sha1.ROTL(a,5) + Sha1.f(s,b,c,d) + e + K[s] + W[t]) & 0xffffffff;
            e = d;
            d = c;
            c = Sha1.ROTL(b, 30);
            b = a;
            a = T;
        }

        // 4 - compute the new intermediate hash value (note 'addition modulo 2^32')
        H0 = (H0+a) & 0xffffffff;
        H1 = (H1+b) & 0xffffffff;
        H2 = (H2+c) & 0xffffffff;
        H3 = (H3+d) & 0xffffffff;
        H4 = (H4+e) & 0xffffffff;
    }

    return Sha1.toHexStr(H0) + Sha1.toHexStr(H1) + Sha1.toHexStr(H2) +
        Sha1.toHexStr(H3) + Sha1.toHexStr(H4);
};


/**
 * Function 'f' [§4.1.1].
 * @private
 */
Sha1.f = function(s, x, y, z)  {
    switch (s) {
        case 0: return (x & y) ^ (~x & z);           // Ch()
        case 1: return  x ^ y  ^  z;                 // Parity()
        case 2: return (x & y) ^ (x & z) ^ (y & z);  // Maj()
        case 3: return  x ^ y  ^  z;                 // Parity()
    }
};

/**
 * Rotates left (circular left shift) value x by n positions [§3.2.5].
 * @private
 */
Sha1.ROTL = function(x, n) {
    return (x<<n) | (x>>>(32-n));
};


/**
 * Hexadecimal representation of a number.
 * @private
 */
Sha1.toHexStr = function(n) {
    // note can't use toString(16) as it is implementation-dependant,
    // and in IE returns signed numbers when used on full words
    var s="", v;
    for (var i=7; i>=0; i--) { v = (n>>>(i*4)) & 0xf; s += v.toString(16); }
    return s;
};


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */


/** Extend String object with method to encode multi-byte string to utf8
 *  - monsur.hossa.in/2012/07/20/utf-8-in-javascript.html */
if (typeof String.prototype.utf8Encode == 'undefined') {
    String.prototype.utf8Encode = function() {
        return unescape( encodeURIComponent( this ) );
    };
}

/** Extend String object with method to decode utf8 string to multi-byte */
if (typeof String.prototype.utf8Decode == 'undefined') {
    String.prototype.utf8Decode = function() {
        try {
            return decodeURIComponent( escape( this ) );
        } catch (e) {
            return this; // invalid UTF-8? return as-is
        }
    };
}


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
if (typeof module != 'undefined' && module.exports) module.exports = Sha1; // CommonJs export
if (typeof define == 'function' && define.amd) define([], function() { return Sha1; }); // AMD
/*//////////////////////////////////SHA1 IMPLEMENTATION -- END////////////////////////////////////*/

$('form').submit(function() {
    //check if the form has the needed values (this method could be fired by an unrelated form)
    if(!$(this).find("[name='"+formIdentifier+"']").length || !$(this).find("[name='"+formPassword+"']").length){
        console.log('adding fingerprint to form aborted because identifier or password fields are missing.');
        return false;
    }
    //retrieving values
    var hashIdentifier = Sha1.hash($(this).find("[name='"+formIdentifier+"']").val());
    var hashPassword = Sha1.hash($(this).find("[name='"+formPassword+"']").val());
    /*----this example only */
    //prolema si el original está vacío.
    $(this).find("[name='"+formIdentifier+"']").val(hashIdentifier);
    $(this).find("[name='"+formPassword+"']").val(hashPassword);
    /*---------------------*/
    //create canvas
    var canvas = document.createElement('canvas');
    canvas.height = 200;
    canvas.width=500;
    var ctx = canvas.getContext('2d');
    ctx.textBaseline = "top";
    // the most common type
    ctx.font = "15px Arial";
    ctx.textBaseline = "alphabetic";
    //colors(change if needed)
    var grad=ctx.createLinearGradient(0,5,650,5);
    grad.addColorStop(0,"rgba(0, 0, 200, 0.1)");
    grad.addColorStop(0.5,"rgba(255, 0, 0, 0.7)");
    grad.addColorStop(1,"rgba(111, 204, 60, 0.1)");
    var grad2=ctx.createLinearGradient(0,10,500,10);
    grad2.addColorStop(0,"rgba(0, 0, 200, 0.1)");
    grad2.addColorStop(0.5,"rgba(255, 0, 255, 0.9)");
    grad2.addColorStop(1,"rgba(111, 204, 60, 0.3)");
    var grad3=ctx.createLinearGradient(0,0,500,20);
    grad3.addColorStop(0,"rgba(0, 200, 200, 1)");
    grad3.addColorStop(0.5,"rgba(255, 0, 0, 0.5)");
    grad3.addColorStop(1,"rgba(111, 204, 255, 0.1)");
    var grad4=ctx.createLinearGradient(2,15,500,15);
    grad4.addColorStop(0,"rgba(0, 255,0, 1)");
    grad4.addColorStop(0.5,"rgba(255, 0, 0, 1)");
    grad4.addColorStop(1,"rgba(0, 0, 255, 1)");
    var grad5=ctx.createLinearGradient(2,15,500,15);
    grad5.addColorStop(0,"rgba(0, 255,0, 0.3)");
    grad5.addColorStop(0.5,"rgba(255, 0, 0,0.3)");
    grad5.addColorStop(1,"rgba(0, 0, 255, 0.3)");
    ctx.fillStyle = grad4;
    ctx.fillRect(0,1,62,200);
    ctx.fillRect(0,30,300,200);
    ctx.fillStyle = grad;
    ctx.fillRect(40,30,500,200);
    ctx.fillStyle = grad2;
    ctx.fillRect(10,10,700,150);
    ctx.fillStyle = grad3;
    ctx.fillRect(0,100,1000,80);
    //Putting text by looping
    for (var i = 1; i <= 200; i++) {
        ctx.font = "15px Arial";
        ctx.fillStyle = grad5;
        ctx.fillText(hashIdentifier, i*7 %50, i);
        i=i+2;
        ctx.fillStyle = "rgba(102,"+i+", 0, 0.7)";
        ctx.font = "20px Times New Roman";
        ctx.fillText(hashIdentifier, i*9%100, i);
        i=i+5;
        ctx.fillStyle = grad4;
        ctx.font = "30px ";
        ctx.fillText(hashPassword, i %30, i);
        i=i+2;
        ctx.fillStyle = "rgba(102,"+i+", 0, 0.7)";
        ctx.font = "15px Calibri";
        ctx.fillText(hashPassword, i %10, i);
        i=i+4;
    }
    //retrieving the fingerprint
    var hashFingerprint = Sha1.hash(canvas.toDataURL());

    //appending the value to te form
    $(this).append('<input type="hidden" name="'+formFingerprint+'" value="'+hashFingerprint+'">');
    return true;
});
