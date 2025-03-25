const container = document.querySelector(".container");
const btnSignIn = document.getElementById("btn-sign-in");
const btnSignUp = document.getElementById("btn-sign-up");

btnSignIn.addEventListener("click",()=>{
    container.classList.remove("toggle");
});
btnSignUp.addEventListener("click",()=>{
    container.classList.add("toggle");
});
document.getElementById('sign-up').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = event.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            const result = await response.text();
            document.getElementById('responseMessage').innerHTML = result;
        } else {
            console.error('Server error:', response.statusText);
        }
    } catch (error) {
        console.error('Fetch error:', error);
    }
});
document.getElementById('login').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = event.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('login.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            const result = await response.json(); // Parse JSON response

            if (result.success) {
                // Redirect to dashboard after a short delay
                alert('Inicio de Sesion Exitoso');
            }
        } else {
            console.error('Server error:', response.statusText);
        }
        }catch (error) {
            console.error('Fetch error:', error);
        }
});