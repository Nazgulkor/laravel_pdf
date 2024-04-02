import './bootstrap';

document.getElementById('upload-button').addEventListener('click', function() {
    var fileInput = document.querySelector('#file');
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append('file', file);
  
    var uploadUrl = 'http://localhost:8000/api/upload';
  
    axios({
      method: 'POST',
      url: uploadUrl,
      data: formData,
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(function (response) {
      console.log('File uploaded successfully:', response.data);
    })
    .catch(function (error) {
      console.error('Error uploading file:', error);
    });
  });