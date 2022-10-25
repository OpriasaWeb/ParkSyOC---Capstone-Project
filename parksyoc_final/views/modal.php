<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Member or visitor?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>If member, input your ID membership here</h5>
        <form action="./bookVehicle.php" method="GET">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="membershipId" value="">
            <label for="floatingInput">ID membership</label>
          </div>
      </div>
          <div class="modal-footer">
            <button type="submit" value="" name="" class="btn btn-primary">Member!</button>
            <a href="./visitorBookParking.php" class="btn btn-secondary">Non-member</a>
          </div>
        </form>
    </div>
  </div>
</div>