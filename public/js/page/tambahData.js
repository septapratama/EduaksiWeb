const tambahForm = document.getElementById('tambahForm');
const inpJudul = document.getElementById('inpJudul');
const inpRentangUsia = document.getElementById('inpRentangUsia');
const inpLinkVideo = document.getElementById('inpLinkVideo');
const inpDeskripsi = document.getElementById('inpDeskripsi');
const inpFoto = document.getElementById('inpFoto');
let uploadedFile = null;
function showLoading(){
    document.querySelector('div#preloader').style.display = 'block';
}
function closeLoading(){
    document.querySelector('div#preloader').style.display = 'none';
}
inpFoto.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        uploadedFile = file;
    }
});
tambahForm.onsubmit = function(event) {
    event.preventDefault();
    const judul = inpJudul.value.trim();
    const rentangUsia = inpRentangUsia.value.trim();
    const linkVideo = inpLinkVideo.value.trim();
    const deskripsi = inpDeskripsi.value.trim();
    const foto = inpFoto.files[0];
    if (judul === '') {
        showRedPopup('Judul harus diisi !');
        return;
    }
    if (rentangUsia === '') {
        showRedPopup('Rentang Usia harus diisi !');
        return;
    }
    if (deskripsi === '') {
        showRedPopup('Deskripsi harus diisi !');
        return;
    }
    if (!uploadedFile) {
        showRedPopup('Foto harus dipilih !');
        return;
    }
    const allowedFormats = ['image/jpeg', 'image/png'];
    if (!allowedFormats.includes(uploadedFile.type)) {
        showRedPopup('Format Foto harus png, jpeg, jpg !');
        return;
    }
    showLoading();
    const formData = new FormData();
    formData.append('judul', judul);
    formData.append('rentang_usia', rentangUsia);
    formData.append('link_video', linkVideo);
    formData.append('deskripsi', deskripsi);
    formData.append('foto', foto);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "/admin" + reff + "/tambah");
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken)
    xhr.onload = function() {
        if (xhr.status === 200) {
            closeLoading();
            var response = JSON.parse(xhr.responseText);
            showGreenPopup(response);
            setTimeout(() => {
                window.location.href = reff;
            }, 2000);
        }else{
            closeLoading();
            var response = JSON.parse(xhr.responseText);
            showRedPopup(response);
        }
    };
    xhr.onerror = function() {
        closeLoading();
        showRedPopup('Error occurred during the request.');
    };
    xhr.send(formData);
    return false;
};