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

// 1. Password Visibility Toggle
if (togglePasswordBtn) {
    togglePasswordBtn.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
}

// 2. Tab Switcher (Login <-> Register)
function switchTab(mode) {
    currentMode = mode;
    clearValidationErrors();

    if (mode === 'register') {
        if (loginTabBtn) loginTabBtn.classList.remove('active');
        if (registerTabBtn) registerTabBtn.classList.add('active');
        if (formHeader) formHeader.textContent = 'Create Account';
        if (formSubheader) formSubheader.textContent = 'Start your culinary adventure today!';
        if (nameGroup) nameGroup.classList.remove('d-none');
        if (optionsRow) optionsRow.classList.add('d-none');
        if (submitBtn) submitBtn.querySelector('span').textContent = 'Register';
        if (footerText) footerText.innerHTML = 'Already have an account? <a href="#" onclick="switchTab(\'login\'); return false;">Login here</a>';
    } else {
        if (registerTabBtn) registerTabBtn.classList.remove('active');
        if (loginTabBtn) loginTabBtn.classList.add('active');
        if (formHeader) formHeader.textContent = 'Welcome Back!';
        if (formSubheader) formSubheader.textContent = 'Login to continue your cooking journey';
        if (nameGroup) nameGroup.classList.add('d-none');
        if (optionsRow) optionsRow.classList.remove('d-none');
        if (submitBtn) submitBtn.querySelector('span').textContent = 'Login';
        if (footerText) footerText.innerHTML = 'Don\'t have an account? <a href="#" onclick="switchTab(\'register\'); return false;">Register here</a>';
    }
}

// 3. Form Validation & Redirect
if (authForm) {
    authForm.addEventListener('submit', function (event) {
        // PHP Backend එකට Submit කිරීමට අවශ්‍ය නම් පහත පේළිය Comment (//) කරන්න
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

        // Full Name validation (Only if Register mode)
        if (currentMode === 'register' && fullNameInput.value.trim() === '') {
            showError(fullNameInput, nameError);
            isValid = false;
        }

        if (isValid) {
            const userEmail = emailInput.value.trim();
            const actionText = currentMode === 'login' ? 'Logged in successfully!' : 'Account registered successfully!';
            
            // Alert message
            alert(`Success: ${actionText}\nWelcome, ${userEmail}!`);
            
            // Main folder එකේ තියෙන index.php එකට යැවීම
            window.location.href = '../index.php'; 
        }
    });
}

function showError(inputElement, errorElement) {
    if (inputElement) inputElement.classList.add('is-invalid');
    if (errorElement) errorElement.style.display = 'block';
}

function clearValidationErrors() {
    [emailInput, passwordInput, fullNameInput].forEach(input => {
        if (input) input.classList.remove('is-invalid');
    });
    [emailError, passwordError, nameError].forEach(error => {
        if (error) error.style.display = 'none';
    });
}

// Event Handlers
function handleForgotPassword(e) {
    if (e) e.preventDefault();
    const email = prompt("Please enter your registered email address to reset your password:");
    if (email) {
        alert(`A password reset link has been sent to ${email}`);
    }
}

function handleGoogleLogin() {
    alert("Google Authentication simulated successfully!");
    window.location.href = '../index.php';
}