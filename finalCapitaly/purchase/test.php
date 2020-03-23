<table class="table table-striped table-sm" style="margin-top: 2rem; color: white;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Raw Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Store</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $id=1;   
                      $sql = "SELECT * FROM existingraw";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                          <tr>
                            <td><?php echo $id++; ?></td>
                            <td><?php echo $data['code'];?></td>
                            <td><?php echo $data['name'];?></td>
                            <td><?php echo $data['quantity'];?></td>
                            <td><?php echo $data['unit'];?></td>
                            <td><?php echo $data['rate'];?></td>
                            <td><?php echo $data['store'];?></td>
                            <td><?php echo $data['supplier'];?></td>
                            <td><?php echo $data['reference'];?></td>
                            <td><a style="color: white;" href="#editraw<?php echo $data['id'];?>" data-toggle="modal"><i class="fa fa-pen-square"></i></a>
                              <a style="color: maroon;" onclick="return confirm('Are you sure you want to delete this?')" href="deleteraw.php?del=<?php echo $data['id'];?>"><i class="fa fa-trash"></i></a></td>

          <div class="modal fade" id="editraw<?php echo $data['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: #004f1e;">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle" style="color: white;">Update Raw-Material</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="post" action="editraw.php">
                    <div class="modal-body">
                      <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
                      <div class="form-row">
                            <label for="date" style="color: white;" class="col-sm-2">Date:</label>
                            <div class="col">
                              <input type="date" id="date" name="date" class="form-control form-control-sm " autocomplete="off" required value="<?php echo $data['date']; ?>">
                            </div>
                            <label for="code" class="" style="color: white;">Code:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['code']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="name" class="col-sm-2" style="color: white;">Name:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['name']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="quantity" style="color: white;" class="col-sm-2">Quantity:</label>
                            <div class="col">
                              <input type="text" id="quantity" name="qty" class="form-control form-control-sm " autocomplete="off" required>
                            </div>
                            <label for="unit" class="" style="color: white;">Unit:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['unit']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                            <label for="store" style="color: white;" class="col-sm-2">Store:</label>
                            <div class="col">
                              <input type="text" id="code" name="code" class="form-control form-control-sm" autocomplete="off" required value="<?php echo $data['store']; ?>" readonly>
                            </div>
                            <label for="rate" class="" style="color: white;">Rate:</label>
                            <div class="col">
                              <input type="text" id="rate" name="rate" class="form-control form-control-sm" required autofocus="off" value="<?php echo $data['rate']; ?>">
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="supplier" class="col-sm-2" style="color: white;">Supplier:</label>
                            <div class="col">
                              <input type="text" id="rate" name="rate" class="form-control form-control-sm" required autofocus="off" value="<?php echo $data['supplier']; ?>" readonly>
                            </div>
                      </div>
                      <div class="form-row" style="margin-top: 0.5rem;">
                        <label for="reference" class="col-sm-2" style="color: white;">Reference:</label>
                            <div class="col">
                              <input type="text" name="reference" id="reference" class="form-control form-control-sm" autocomplete="off" required autocomplete="off" value="<?php echo $data['reference']; ?>">
                            </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                    <button type="submit" name="submit" class="save-button">Update</button>
                    </div>
                  
                </form>
            </div>
            </div>
          </div>
                            </tr>
                          <?php }}?>
                    </tbody>
                  </table>`