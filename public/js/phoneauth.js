  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
  import { getAuth, RecaptchaVerifier , signInWithPhoneNumber } from "https://cdnjs.cloudflare.com/ajax/libs/firebase/9.15.0/firebase-auth.min.js";
  const firebaseConfig = {
    apiKey: "AIzaSyA3lpduJWPTiuOlzx0n4VG51RllHGVKjyc",
    authDomain: "nhathuoc-suckhoe.firebaseapp.com",
    projectId: "nhathuoc-suckhoe",
    storageBucket: "nhathuoc-suckhoe.appspot.com",
    messagingSenderId: "1034800999726",
    appId: "1:1034800999726:web:3fa0a48b9cdc9510af1ebf",
    measurementId: "G-YVNZ51VL2W"
  };

  // Initialize Firebase
  var app = initializeApp(firebaseConfig);
  
  export function renderCaptcha() {
    const auth = getAuth();
    window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
      'size': 'normal',
      'callback': (response) => {
        // reCAPTCHA solved, allow signInWithPhoneNumber.
        // onSignInSubmit();
      }
    }, auth);
    console.log('window.recaptchaVerifier :>> ', window.recaptchaVerifier);

    recaptchaVerifier.render();
  }
  export function sendOTP() {
    var phoneNumber = '+84'+ ($("#phone-number").val()).slice(1);
    console.log('phoneNumber :>> ', phoneNumber);
    const appVerifier = window.recaptchaVerifier;
    console.log('window.recaptchaVerifier :>> ', window.recaptchaVerifier);

    
    const auth = getAuth();
    signInWithPhoneNumber(auth, phoneNumber, appVerifier)
      .then((confirmationResult) => {
        // SMS sent. Prompt user to type the code from the message, then sign the
        // user in with confirmationResult.confirm(code).
        window.confirmationResult = confirmationResult;
        // ...
        console.log(window.confirmationResult);
        UIkit.notification('Message sent', {pos: 'top-center', timeout : 0});
        showP2();
      }).catch((error) => {
        // Error; SMS not sent
        // ...
        UIkit.notification('Error: '+error.message, {pos: 'top-center', timeout : 0});
      });

  }

  export function verifyOTP() {
    var code = $("#verification").val();
    window.confirmationResult.confirm(code).then(function (result) {
      var user = result.user;
      console.log(user);
      UIkit.notification('Auth is successful', {pos: 'top-center', timeout : 0});
      showP3();
    }).catch(function (error) {
      UIkit.notification('Error: '+error.message, {pos: 'top-center', timeout : 0});
    });
  }