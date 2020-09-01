<!DOCTYPE html>
<html>
<head>
  <title>FilePond from CDN</title>

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<style>
    .preview{
        width: 16rem;
        height: 16rem;
    }
</style>


<body>


    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 18rem;" >
                    <div class="card-body" id="dropbox">
                        <input type="file" id="myFile" multiple style="display:none">
                        <div id="preview"></div>
                        <h5 class="card-title">select / drag your file here</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">upload</a>
                    </div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 

  <script>
    
    $(document).ready(function () {

        
        function handleFilesWithClick() {
            const fileList = this.files; /* now you can work with the file list */
            console.log(fileList);

            const numFiles = fileList.length;

            for (let i = 0, numFiles = fileList.length; i < numFiles; i++) {
                const file = fileList[i];
                console.log("nama file : "+file.name + " ukuran : "+file.size +" tipe : "+file.type);

            }
            handleFiles(fileList);

        }
        

        function handleFiles(files) {
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                console.log(file);
                if (!file.type.startsWith('image/')){ continue }
                
                let preview = document.getElementById("preview");

                const img = document.createElement("img");
                img.setAttribute("class", "preview")
                img.classList.add("obj");
                img.file = file;
                preview.appendChild(img); // Assuming that "preview" is the div output where the content will be displayed.
                
                const reader = new FileReader();
                reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
                reader.readAsDataURL(file);
            }
        }


        fileElem = document.getElementById("myFile");

        let dropbox = document.getElementById("dropbox");
        dropbox.addEventListener("click", inputClick, false);
        dropbox.addEventListener("dragenter", dragenter, false);
        dropbox.addEventListener("dragover", dragover, false);
        dropbox.addEventListener("drop", drop, false);

        function inputClick(e) {
            if (fileElem) {
                fileElem.click();
                console.log(e);
                const inputElement = document.getElementById("myFile");
                inputElement.addEventListener("change", handleFilesWithClick, false);
            }
        }

        function dragenter(e) {
            e.stopPropagation();
            e.preventDefault();
        }

        function dragover(e) {
            e.stopPropagation();
            e.preventDefault();
        } 

        function drop(e) {
            e.stopPropagation();
            e.preventDefault();

            console.log(e);
            const dt = e.dataTransfer;
            const files = dt.files;

            handleFiles(files);
        }


    })
   
  
  </script>

</body>
</html>