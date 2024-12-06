const button1 = document.getElementById("button1");
const button2 = document.getElementById("button2");
const button3 = document.getElementById("button3");
const images1 = document.getElementById("images1");
const images2 = document.getElementById("images2");
const images3 = document.getElementById("images3")


button1.addEventListener("click", function () {
    images1.classList.add("active");
    images2.classList.remove("active");
    images3.classList.remove("active");
});


button2.addEventListener("click", function () {
    images2.classList.add("active");
    images1.classList.remove("active");
    images3.classList.remove("active");

});
button3.addEventListener("click", function () {
    images3.classList.add("active");
    images1.classList.remove("active");
    images2.classList.remove("active");

});

// 
document.addEventListener('DOMContentLoaded', () => {
    // Login form validation
    const loginForm = document.querySelector('.login-form');
    const loginEmail = loginForm.querySelector('input[name="email"]');
    const loginPassword = loginForm.querySelector('input[name="password"]');

    loginForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission

        let valid = true;
        if (!validateEmail(loginEmail.value)) {
            alert('Please enter a valid email address in the Login form.');
            valid = false;
        }
        if (loginPassword.value.trim() === '') {
            alert('Password cannot be empty in the Login form.');
            valid = false;
        }

        if (valid) {
            alert('Login Successful!');
            // Here you can submit the form or handle login logic
        }
    });

    // Signup form validation
    const signupForm = document.querySelector('.signup-form');
    const signupName = signupForm.querySelector('input[name="name"]');
    const signupEmail = signupForm.querySelector('input[name="email"]');
    const signupPassword = signupForm.querySelector('input[name="password"]');

    signupForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent form submission

        let valid = true;
        if (signupName.value.trim() === '') {
            alert('Full Name is required in the Signup form.');
            valid = false;
        }
        if (!validateEmail(signupEmail.value)) {
            alert('Please enter a valid email address in the Signup form.');
            valid = false;
        }
        if (signupPassword.value.trim().length < 6) {
            alert('Password must be at least 6 characters long in the Signup form.');
            valid = false;
        }

        if (valid) {
            alert('Signup Successful!');
            // Here you can submit the form or handle signup logic
        }
    });

    // Email validation helper function
    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});