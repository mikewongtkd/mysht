    <main role="main">
      <div class="interface" id="take-picture-interface">
        <canvas id="canvas"></canvas>
        <video autoplay muted hidden playsinline id="video"></video>
        <button class="btn btn-primary form-control" id="take-picture"><span class="fa-solid fa-camera"></span></button>
        <div id="confirm-dialog">
          <button class="btn btn-danger form-control" id="picture-cancel">Cancel</button>
          <button class="btn btn-success form-control" id="picture-ok">OK</button>
        </div>
      </div>
      <div class="interface" id="update-information-interface">
        <img id="picture"></img>
        <form action="db.php" method="post">
          <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name"></input>
          </div>
          <div class="mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
          </div>
        </form>
      </div>
    </main>
