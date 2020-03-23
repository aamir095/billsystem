                <div class="fuck">
                  <table class="table table-striped table-sm" style="margin-top: 2rem; color: white;">
                      <thead>
                        <tr>
                          <th scope="col">Code</th>
                          <th scope="col">Raw Name</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                          <th scope="col"></th>

                         
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = "SELECT * FROM existingraw GROUP BY code";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while ($data = mysqli_fetch_array($result)) {?>
                         <tr class="clickme">
                          <td><?php echo $data['code'];?></td>
                            <td><?php echo $data['name'];?></td>
                            </tr>
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
                      $sql1 = "SELECT * FROM existingraw WHERE code = '".$data['code']."'";
                      $result1 = $conn->query($sql1);
                      if ($result1->num_rows > 0) {
                        while ($data1 = mysqli_fetch_array($result1)) {?>
                          <tr>
                            <td><?php echo $data1['id'];?></td>
                            <td><?php echo $data1['code'];?></td>
                            <td><?php echo $data1['name'];?></td>  
                            <td><?php echo $data1['quantity'];?></td>
                            <td><?php echo $data1['unit'];?></td>
                            <td><?php echo $data1['rate'];?></td>
                            <td><?php echo $data1['store'];?></td>
                            <td><?php echo $data1['supplier'];?></td>
                            <td><?php echo $data1['reference'];?></td>
                          </tr>
                          

                            <?php }}?>
                            </tbody>
                            </div>
                            </div>

                         
                          </tbody>

                                

  
                            <?php }}?>
                        </table>
                            
                            </div>