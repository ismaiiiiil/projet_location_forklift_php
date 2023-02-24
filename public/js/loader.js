window.addEventListener("load", () => {
    const div_loader = document.querySelector(".div-loader");
    const loader = document.querySelector(".loader");

    div_loader.classList.add("loader--hidden");
    loader.classList.add("loader--hidden");

    loader.addEventListener("transitionend", () => {
        document.div_loader.removeChild(loader);
    });
});