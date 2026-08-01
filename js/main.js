let currentMode = 'login'; // 'login' or 'register'

    // DOM Elements
    const authForm = document.getElementById('authForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const fullNameInput = document.getElementById('fullName');
    const togglePasswordBtn = document.getElementById('togglePassword');
    
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const nameError = document.getElementById('nameError');

    const formHeader = document.getElementById('formHeader');
    const formSubheader = document.getElementById('formSubheader');
    const loginTabBtn = document.getElementById('loginTabBtn');
    const registerTabBtn = document.getElementById('registerTabBtn');
    const nameGroup = document.getElementById('nameGroup');
    const optionsRow = document.getElementById('optionsRow');
    const submitBtn = document.getElementById('submitBtn');
    const footerText = document.getElementById('footerText');

    // 1. FEATURE: Password Visibility Toggle
    togglePasswordBtn.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // 2. FEATURE: Tab Switcher (Login <-> Register)
    function switchTab(mode) {
        currentMode = mode;
        clearValidationErrors();

        if (mode === 'register') {
            loginTabBtn.classList.remove('active');
            registerTabBtn.classList.add('active');
            formHeader.textContent = 'Create Account';
            formSubheader.textContent = 'Start your culinary adventure today!';
            nameGroup.classList.remove('d-none');
            optionsRow.classList.add('d-none');
            submitBtn.querySelector('span').textContent = 'Register';
            footerText.innerHTML = 'Already have an account? <a href="#" onclick="switchTab(\'login\'); return false;">Login here</a>';
        } else {
            registerTabBtn.classList.remove('active');
            loginTabBtn.classList.add('active');
            formHeader.textContent = 'Welcome Back!';
            formSubheader.textContent = 'Login to continue your cooking journey';
            nameGroup.classList.add('d-none');
            optionsRow.classList.remove('d-none');
            submitBtn.querySelector('span').textContent = 'Login';
            footerText.innerHTML = 'Don\'t have an account? <a href="#" onclick="switchTab(\'register\'); return false;">Register here</a>';
        }
    }

    // 3. FEATURE: Form Validation (JavaScript Feature requirement)
    authForm.addEventListener('submit', function (event) {
        event.preventDefault();
        let isValid = true;
        clearValidationErrors();

        // Email validation regex pattern
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!emailPattern.test(emailInput.value.trim())) {
            showError(emailInput, emailError);
            isValid = false;
        }

        // Password validation (at least 6 chars)
        if (passwordInput.value.trim().length < 6) {
            showError(passwordInput, passwordError);
            isValid = false;
        }

        // Full Name validation (If Register mode)
        if (currentMode === 'register' && fullNameInput.value.trim() === '') {
            showError(fullNameInput, nameError);
            isValid = false;
        }

        if (isValid) {
            const userEmail = emailInput.value.trim();
            const actionText = currentMode === 'login' ? 'Logged in successfully!' : 'Account registered successfully!';
            
            // Simple Success Feedback Banner/Alert
            alert(`Success: ${actionText}\nWelcome back, ${userEmail}!`);
            
            // Redirect to Home Page (index.html)
            window.location.href = 'index.html';
        }
    });

    function showError(inputElement, errorElement) {
        inputElement.classList.add('is-invalid');
        errorElement.style.display = 'block';
    }

    function clearValidationErrors() {
        [emailInput, passwordInput, fullNameInput].forEach(input => {
            input.classList.remove('is-invalid');
        });
        [emailError, passwordError, nameError].forEach(error => {
            error.style.display = 'none';
        });
    }

    // Event Handlers for interactive actions
    function handleForgotPassword(e) {
        e.preventDefault();
        const email = prompt("Please enter your registered email address to reset your password:");
        if (email) {
            alert(`A password reset link has been sent to ${email}`);
        }
    }

    function handleGoogleLogin() {
        alert("Google Authentication simulated successfully!");
        window.location.href = 'index.html';
    }

 //newslatter validation  
const newsletterForm = document.getElementById("newsletterForm");
const newsletterEmail = document.getElementById("newsletterEmail");
const emailError = document.getElementById("emailError");

if (newsletterForms) {
    newsletterForm.addEventListener("submit", function(event) {
        // Prevent the page from refreshing immediately
        event.preventDefault(); 
        
        const emailValue = newsletterEmail.value.trim();

        // Check if it's empty OR if it doesn't include an '@'
        if (emailValue === "" || !emailValue.includes("@")) {
            emailError.style.display = "block"; // Show our custom RED error
            emailError.textContent = "Please enter a valid email containing '@'.";
        } else {
            emailError.style.display = "none"; // Hide error
            alert("Awesome! You have successfully joined our community.");
        }
    });
}