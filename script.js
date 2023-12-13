const Kembali = document.getElementById("jKembali");
const Baik = document.getElementById("jBaik");
const Rusak = document.getElementById("jRusak");

Kembali.addEventListener("input", function() {
    Baik.max = this.value;
    Rusak.max = this.value;
});