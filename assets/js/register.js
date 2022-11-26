/* -------------------------------------------------------------------------- */
/*                             Password Strenght Check                        */
/* -------------------------------------------------------------------------- */

let state = false;
let password = document.getElementById("password");
let passwordStrength = document.getElementById("password-strength");

password.addEventListener("keyup", function () {
    let pass = document.getElementById("password").value;
    checkStrength(pass);
});

function checkStrength(password) {
    let strength = 0;

    //If password contains both lower and uppercase characters
    if (password.match(/([a-z].[A-Z])|([A-Z].[a-z])/)) {
        console.log("les lettres c bon");
        strength += 1;
    }
    //If it has numbers and characters
    if (password.match(/([0-9])/)) {
        console.log("les chiffres c bon");
        strength += 1;
    }
    //If it has one special character
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
    }
    //If password is greater than 7
    if (password.length > 8) {
        console.log("la longueur c bon");
        strength += 1;
    }

    if (password.length > 12) {
        strength += 1;
    }
    // If value is less than 2
    if (strength < 2) {
        passwordStrength.classList.remove("progress-bar-warning");
        passwordStrength.classList.remove("progress-bar-success");
        passwordStrength.classList.add("progress-bar-danger");
        passwordStrength.style = "width: 10%";
    } else if (strength == 3) {
        passwordStrength.classList.remove("progress-bar-success");
        passwordStrength.classList.remove("progress-bar-danger");
        passwordStrength.classList.add("progress-bar-warning");
        passwordStrength.style = "width: 60%";
    } else if (strength == 5) {
        passwordStrength.classList.remove("progress-bar-warning");
        passwordStrength.classList.remove("progress-bar-danger");
        passwordStrength.classList.add("progress-bar-success");
        passwordStrength.style = "width: 100%";
    }
}
