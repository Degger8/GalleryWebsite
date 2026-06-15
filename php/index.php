<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <!-- <link rel="stylesheet" href="./CSS/stylesheet.css"> -->
    <style> 
      .gallery img {
        width: 200px;
        height: 200px;
      }
    </style>
  </head>
  <body>
    <main>
      <?php include 'dropzone.php'; ?>
    </main>

    <div class="gallery" id="gallery"></div>

    <script>
      const loadImages = () => {
        fetch('get_images.php')
          .then(res => res.json())
          .then(images => {
            const gallery = document.getElementById('gallery');
            gallery.innerHTML = '';
            images.forEach(filename => {
              const img = document.createElement('img');
              img.src = 'uploads/' + filename;
              img.alt = filename;
              gallery.appendChild(img);
            });
          });
      }

      loadImages();
    </script>
  </body>
</html>