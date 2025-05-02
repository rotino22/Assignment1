document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("registerForm")?.addEventListener("submit", function(event) {
        let password = document.querySelector("[name='password']").value;
        if (password.length < 4) {
            event.preventDefault();
            alert("Password must be at least 4 characters long.");
        }
    });
});
