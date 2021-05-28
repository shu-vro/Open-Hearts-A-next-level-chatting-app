let inputs = document.querySelectorAll(".inp_field");
let pass_fields = document.querySelectorAll(".inp_field input[type=password]");

inputs.forEach((input) => {
    input.addEventListener("click", () => {
        inputs.forEach((input2) => {
            input2.classList.remove("rshadow");
        });
        input.classList.add("rshadow");
    });
});

for (let i = 0; i < pass_fields.length; i++) {
    const pass = pass_fields[i];

    let eye = pass.parentElement.querySelector(".far");
    eye.addEventListener("click", () => {
        eye.classList.toggle("fa-eye");
        eye.classList.toggle("fa-eye-slash");

        if (eye.classList.contains("fa-eye-slash")) {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    });
}
