<style>
  *, *::after, *::before {
    margin: 0; padding: 0; box-sizing: border-box;
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
  h3 { margin-top: 1rem; }
  [type='file'] {
    border: 0; clip: rect(0,0,0,0); height: 1px;
    overflow: hidden; padding: 0;
    position: absolute !important;
    white-space: nowrap; width: 1px;
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
  [type='file'] + label:hover { background-color: #0a58ca; color: #fff; }
  [type='file']:focus + label { outline: 1px dotted #fff; }
</style>

<div class="dropzone">
  <input type="file" class="files" id="images" accept="image/png, image/jpeg" multiple />
  <label for="images">Choose multiple images</label>
  <h3>or drag & drop your PNG or JPEG files here</h3>
</div>

<div class="image-list"></div>

<script>
  const fileInput = document.querySelector('.files');
  const dropzone  = document.querySelector('.dropzone');

  document.addEventListener('dragover', (e) => e.preventDefault());
  document.addEventListener('drop',     (e) => e.preventDefault());

  dropzone.addEventListener('dragenter', (e) => e.preventDefault());
  dropzone.addEventListener('dragover',  (e) => e.preventDefault());
  dropzone.addEventListener('dragleave', (e) => e.preventDefault());

  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    handleImages(e.dataTransfer.files);
  });

  fileInput.addEventListener('change', (e) => {
    handleImages(e.target.files);
  });

  const handleImages = (files) => {
    const validImages = [...files].filter((file) =>
      ['image/jpeg', 'image/png'].includes(file.type)
    );
    uploadImages(validImages);
  };

  const uploadImages = async (images) => {
    // TODO: POST to upload.php
    for (const image of images) {
      const formData = new FormData();
      formData.append('file', image);
      const res = await fetch('upload.php', { method: 'POST', body: formData });
      const data = await res.json();
      if (data.success) loadImages();
      console.log(data);
    }
    /*
    let s = 'NO UPLOAD, JUST SHOWING THE NAMES OF THE FILES IN AN ALERT: \n';
    [...images].forEach((image) => s += image.name + '\n');
    alert(s);
    */
  };

</script>