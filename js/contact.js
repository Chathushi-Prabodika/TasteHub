
function validateForm(event) {
    // Prevent the form from submitting automatically
    event.preventDefault();

    // Retrieve input values and remove extra whitespace using trim()
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let message = document.getElementById("message").value.trim();

    let isValid = true;

    // 1. Validate Name Field
    if (name === "") {
        document.getElementById("nameError").innerText = "Please enter your name.";
        isValid = false;
    } else {
        document.getElementById("nameError").innerText = "";
    }

    // 2. Validate Email Field
    if (email === "") {
        document.getElementById("emailError").innerText = "Please enter your email address.";
        isValid = false;
    } else if (!email.includes("@") || !email.includes(".")) {
        document.getElementById("emailError").innerText = "Please enter a valid email address (must include '@' and '.').";
        isValid = false;
    } else {
        document.getElementById("emailError").innerText = "";
    }

    // 3. Validate Message Field
    if (message === "") {
        document.getElementById("messageError").innerText = "Please write your message.";
        isValid = false;
    } else {
        document.getElementById("messageError").innerText = "";
    }

    // If all validations pass successfully
    if (isValid) {
        alert("Your message has been sent successfully!");
        document.getElementById("contactForm").reset(); // Reset form fields
    }

    return false;
}
