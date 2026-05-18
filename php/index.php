<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test </title>
    <style> 
                      *,
        *::after,
        *::before {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }
        body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen,
            Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-size: 1rem;
        line-height: 1.7;
        }

        main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        }

        .dropzone {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        border: dashed 3px #ccc;
        border-radius: 1rem;
        padding: 2rem;
        }

        h3 {
        margin-top: 1rem;
        }


        /* upload button */
        [type='file'] {
        border: 0;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        overflow: hidden;
        padding: 0;
        position: absolute !important;
        white-space: nowrap;
        width: 1px;
        }

        [type='file'] + label {
        margin-top: 1rem;
        background-color: #0d6efd;
        border-radius: 4rem;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        padding: 0.25rem 0.75rem;
        text-align: center;
        user-select: none;
        }

        [type='file']:focus + label,
        [type='file'] + label:hover {
        background-color: #0a58ca;
        color: #fff;
        }

        [type='file']:focus + label {
        outline: 1px dotted #fff;
        }
    </style>
    <link rel="stylesheet" href="./CSS/stylesheet.css">
  </head>
  <body>
    <main>
          <main>
      <div class="dropzone">
        <input
          type="file"
          class="files"
          id="images"
          accept="image/png, image/jpeg"
          multiple
        />
        <label for="images">Choose multiple images</label>

        <h3>or drag & drop your PNG or JPEG files here</h3>
      </div>

      <div class="image-list"></div>
    </main>
    <script>
      const fileInput = document.querySelector('.files');
      const dropzone = document.querySelector('.dropzone');

      // prevent the drag & drop on the page
      document.addEventListener('dragover', (e) => e.preventDefault());
      document.addEventListener('drop', (e) => e.preventDefault());

      // Avoid default behavior of the browser when dragging files over the dropzone,
      //  and add the active class
      dropzone.addEventListener('dragenter', (e) => {
      e.preventDefault();
      });

      dropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      });

      dropzone.addEventListener('dragleave', (e) => {
      e.preventDefault();
      });

      // Handle the drop event in the dropzone, get the valid files, and handle them
      dropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      // get the valid files as Objects
      // the { } is used to destructure the dataTransfer object and get the files property directly
      // This means: const files = e.dataTransfer.files;
      const { files } = e.dataTransfer;
      // handle images: the parameter i a list of files.
      handleImages(files);
      });

      // handle the fileinput change event, get the valid files, and handle them
      fileInput.addEventListener('change', (e) => {
      const { files } = e.target;
      handleImages(files);
      });

      const handleImages = (files) => {
      // filter valid images:
      // ... is used to convert the FileList object into an array, 
      //     so we can use the filter method on it
      // the filter method is used to create a new array with only the valid images
      // we check if the file type is either image/jpeg or image/png
      let validImages = [...files].filter((file) =>
          ['image/jpeg', 'image/png'].includes(file.type)
      );
      // upload files: See the uploadImages function in the  previous AJAX request example. 
      // You can use the same function again
      uploadImages(validImages);
      };

      const uploadImages = async (images) => {
      
      s =  "NO UPLOAD, JUST SHOWING THE NAMES OF THE FILES IN AN ALERT: ";
      // key is images
      [...images].forEach((image) =>
          s +=  image.name +  "\n"
      );
      alert(s);
      return;
      };




    </script>
    </main>
  </body>
</html>