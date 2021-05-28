let img_panel = document.querySelector(".img_panel"),
    crosses = img_panel.querySelectorAll(".fas"),
    preview = document.getElementById("preview"),
    image_file = document.querySelector("input[type=file]");

image_file.addEventListener("change", () => {
    img_panel.classList.add("active");
    let reader = new FileReader();
    reader.addEventListener("load", (e) => {
        preview.src = reader.result;
    });
    reader.readAsDataURL(image_file.files[0]);
});

crosses.forEach((cross) => {
    cross.addEventListener("click", () => {
        img_panel.classList.remove("active");
    });
});