const chooseFileButton = document.getElementById('choose-file-button');
const fileInput = document.getElementById('file-input');
const uploadButton = document.getElementById('upload-button');

chooseFileButton.addEventListener('click', () => {
    fileInput.click();
});

fileInput.addEventListener('change', () => {
    uploadButton.style.display = 'block';
});

uploadButton.addEventListener('click', () => {
    const xhr = new XMLHttpRequest();
    const formData = new FormData();
    formData.append('file', fileInput.files[0]);
    xhr.open('POST', './xdrivefiles', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('File uploaded successfully!');
            uploadButton.style.display = 'none';
        } else {
            alert('File upload failed.');
        }
    };
    xhr.send(formData);
});