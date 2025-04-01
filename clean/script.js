document.addEventListener("DOMContentLoaded", function() {
    let sections = document.querySelectorAll(".section");
    let buttons = document.querySelectorAll(".toggle-btn");

    buttons.forEach(button => {
        button.addEventListener("click", function() {
            let target = document.getElementById(this.dataset.target);
            sections.forEach(section => section.style.display = "none");
            target.style.display = "block";
        });
    });
});
