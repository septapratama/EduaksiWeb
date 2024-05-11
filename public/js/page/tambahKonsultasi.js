const tambahForm = document.getElementById("tambahForm");
const inpNama = document.getElementById("inpNama");
const inpJenisKelamin = document.getElementById("inpJenisKelamin");
const inpKategori = document.getElementById("inpKategori");
const inpNomerTelepon = document.getElementById("inpNomerTelepon");
const inpEmail = document.getElementById("inpEmail");
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
        const fileReader = new FileReader();
        fileReader.onload = function() {
            document.getElementById('file').src = fileReader.result;
            document.getElementById('file').style.display = 'block';
            document.querySelector('div.img').style.border = 'none';
        };
        fileReader.readAsDataURL(uploadeFile);
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
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('file').src = event.target.result;
            document.getElementById('file').style.display = 'block';
            document.querySelector('div.img').style.border = 'none';
        };
        reader.readAsDataURL(file);
        fileImg = file;
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
    const inp_kategori = inpKategori.value.trim();
    const nomer = inpNomerTelepon.value.trim();
    const inpEmails = inpEmail.value.trim();
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
    formData.append("kategori", inp_kategori);
    formData.append("no_telpon", nomer);
    formData.append("email_konsultasi", inpEmails);
    formData.append("alamat", alamat);
    formData.append("foto", uploadeFile);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", reff + "/tambah");
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onload = function () {
        if (xhr.status === 200) {
            closeLoading();
            var response = JSON.parse(xhr.responseText);
            showGreenPopup(response);
            setTimeout(() => {
                window.location.href = reff;
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