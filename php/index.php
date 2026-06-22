<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="../CSS/stylesheet.css">
  </head>
  <body>
    <main>
      <div class='layout'>
        <div class='leftBack location'>
          <?php include 'dropzone.php'; ?>
        </div>
        <div class='rightBack location'>
          <h1 class='text'> Bilder </h1>
          <div class='imageScroll' id='gallery'></div>
        </div>
      </div>
    </main>
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
              img.className = 'imageSize';

              img.addEventListener('click', () => deleteImage(filename));
                img.addEventListener('contextmenu', (e) => {
                e.preventDefault(); // stop the right-click menu from showing
                deleteImage(filename);
              });

              gallery.appendChild(img);
            });
          });
      }

      const deleteImage = async (filename) => {
        const res = await fetch('delete_image.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ filename })
        });
        const data = await res.json();
        if (data.success) loadImages();
      };

      loadImages();
    </script>
  </body>
</html>