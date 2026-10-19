// ===== Hamburger menu (JS-driven, menggantikan checkbox hack) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if(!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function() {
        nav.classList.toggle("nav-open");
    });
}

function initHapusConfirm() {
    document.addEventListener("submit", function (e) {
        const form = e.target;
        if (!form.classList.contains("form-hapus")) return;

        const row = form.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (!yakin) {
            e.preventDefault();
        }
    });
}

function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const teks = row.textContent.toLowerCase();
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
    });
}

function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        const judul = form.querySelector("[name='judul'], [name='nama']");
        if (judul && judul.value.trim() === "") {
            tampilkanError(judul, "Field ini wajib diisi.");
            valid = false;
        } else if (judul) {
            hapusError(judul);
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

const password = document.getElementById("password");
const toggle = document.getElementById("togglePassword");

if (password && toggle) {
    toggle.addEventListener("click", function () {
        password.type =
            password.type === "password" ? "text" : "password";
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const tombolProfil = document.getElementById("tombolProfil");
    const menuProfil = document.getElementById("menuProfil");

    if (!tombolProfil || !menuProfil) return;

    tombolProfil.addEventListener("click", function (event) {
        event.stopPropagation();

        const terbuka = menuProfil.classList.toggle("aktif");
        tombolProfil.setAttribute("aria-expanded", terbuka);
    });

    document.addEventListener("click", function (event) {
        if (!event.target.closest(".profil-petugas")) {
            menuProfil.classList.remove("aktif");
            tombolProfil.setAttribute("aria-expanded", "false");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
    initProfilDropdown();
});
