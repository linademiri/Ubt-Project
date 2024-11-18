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