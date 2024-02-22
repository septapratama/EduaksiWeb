const tambahForm = document.getElementById("tambahForm");
const inpNama = document.getElementById("inpNama");
const inpJenisKelamin = document.getElementById("inpJenisKelamin");
const inpNomerTelepon = document.getElementById("inpNomerTelepon");
const inpEmail = document.getElementById("inpEmail");
const inpPassword = document.getElementById("inpPassword");
const inpAlamat = document.getElementById("inpAlamat");
const inpFoto = document.getElementById("inpFoto");
const allowedFormats = ["image/jpeg", "image/png"];
let uploadeFile = null;
function showLoading() {
    document.querySelector("div#preloader").style.display = "block";
}
function closeLoading() {
    document.querySelector("div#preloader").style.display = "none";
}
function handleFileClick() {
    inpFoto.click();
}
function handleFileChange(event) {
    const file = event.target.files[0];
    if (file) {
        if (!allowedFormats.includes(file.type)) {
            showRedPopup("Format Foto harus png, jpeg, jpg !");
            return;
        }
        uploadeFile = file;
    }
}
function handleDragOver(event) {
    event.preventDefault();
}
function handleDrop(event) {
    event.preventDefault();
    const file = event.dataTransfer.files[0];
    if (file) {
        if (!allowedFormats.includes(file.type)) {
            showRedPopup("Format Foto harus png, jpeg, jpg !");
            return;
        }
        uploadeFile = file;
    }
}
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
tambahForm.onsubmit = function(event){
    event.preventDefault();
    const nama = inpNama.value.trim();
    const inp_jenis_kelamin = inpJenisKelamin.value.trim();
    const nomer = inpNomerTelepon.value.trim();
    const inpEmails = inpEmail.value.trim();
    const password = inpPassword.value.trim();
    const alamat = inpAlamat.value.trim();
    if(nama === "") {
        showRedPopup("Nama Lengkap harus diisi !");
        return;
    }
    if(inp_jenis_kelamin === "") {
        showRedPopup("Jenis Kelamin harus diisi !");
        return;
    }
    if(nomer === "") {
        showRedPopup("Nomer Telepon harus diisi !");
        return;
    }else if(isNaN(nomer)) {
        showRedPopup("Nomer Telepon harus angka !");
        return;
    }else if(!/^08\d+$/.test(nomer)) {
        showRedPopup("Nomer Telepon harus dimulai dengan 08 !");
        return;
    }else if(!/^\d{11,13}$/.test(nomer)) {
        showRedPopup("Nomer Telepon harus terdiri dari 11-13 digit angka !");
        return;
    }
    if(inpEmails === "") {
        showRedPopup("Email harus diisi !");
        return;
    }
    if(!isValidEmail(inpEmails)) {
        showRedPopup('Format Email salah !');
        return;
    }
    if (password === '') {
        showRedPopup('Password harus diisi !');
        return;
    }
    if (password.length < 8) {
        showRedPopup('Password minimal 8 karakter !');
        return;
    }
    if (!/[A-Z]/.test(password)) {
        showRedPopup('Password minimal ada 1 huruf kapital !');
        return;
    }
    if (!/[a-z]/.test(password)) {
        showRedPopup('Password minimal ada 1 huruf kecil !');
        return;
    }
    if (!/\d/.test(password)) {
        showRedPopup('Password minimal ada 1 angka !');
        return;
    }
    if (!/[!@#$%^&*]/.test(password)) {
        showRedPopup('Password minimal ada 1 karakter unik !');
        return;
    }
    if(alamat === "") {
        showRedPopup("Alamat harus diisi !");
        return;
    }
    if (!uploadeFile) {
        showRedPopup("Foto harus dipilih !");
        return;
    }
    if(!allowedFormats.includes(uploadeFile.type)) {
        showRedPopup("Format Foto harus png, jpeg, jpg !");
        return;
    }
    showLoading();
    const formData = new FormData();
    formData.append("nama_lengkap", nama);
    formData.append("jenis_kelamin", inp_jenis_kelamin);
    formData.append("no_telpon", nomer);
    formData.append("email_admin", inpEmails);
    formData.append("password", password);
    formData.append("alamat", alamat);
    formData.append("foto", uploadeFile);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/edit");
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onload = function () {
        if (xhr.status === 200) {
            closeLoading();
            var response = JSON.parse(xhr.responseText);
            showGreenPopup(response);
            setTimeout(() => {
                window.location.href = '/admin';
            }, 2000);
        } else {
            closeLoading();
            var response = JSON.parse(xhr.responseText);
            showRedPopup(response);
        }
    };
    xhr.onerror = function () {
        closeLoading();
        showRedPopup("Error occurred during the request.");
    };
    xhr.send(formData);
    return false;
};