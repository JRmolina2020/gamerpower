  function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var filePreview = document.createElement('img');
                  
                    //e.target.result contents the base64 data from the image uploaded
                    filePreview.src = e.target.result;
                 

                    var previewZone = document.getElementById('imagenvisual');
                    previewZone.appendChild(filePreview);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        var fileUpload = document.getElementById('imagen');
        fileUpload.onchange = function (e) {
            readFile(e.srcElement);
        }
