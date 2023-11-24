    <main role="main">
      <div class="container">
        <form>
          <center>
            <img id="photo-preview" src="assets/images/no-image-placeholder.png" alt="image preview" style="height: 200px; margin: 2em 0 1em 0; border-radius: 0.5em;">
            <input class="form-control" type="file" accept="image/*" name="photo" id="photo" style="width: 260px;">
          </center>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="name">
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="description"></textarea>
          </div>
          <button type="button" class="btn btn-secondary btn-add-location">Add Location</button>
          <button type="button" class="btn btn-primary btn-submit">Submit</button>
        </form>
      </div>
    </main>

  <script>
    function preview( input, img ) {
        if( ! input.files || ! input.files[ 0 ]) { return; }
        let reader = new FileReader();
        reader.onload = e => {
          $( img ).attr( 'src', e.target.result );
        };

        reader.readAsDataURL( input.files[ 0 ]);
    }

    $( '#photo' ).change( ev => { let image = $( ev.target )[ 0 ]; preview( image, '#photo-preview' ); });
    $( '#location' ).change( ev => { let image = $( ev.target )[ 0 ]; preview( image, '#location-preview' ); });
  </script>
