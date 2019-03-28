<h4>Transaction History</h4>
<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Order</th>
                  <th>Courier</th>
                  <th>Date Ordered</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i=0;
                  foreach ($order as $key):
                    $i++;
                      ?>
                        <tr>

                          <td ><?php echo $i;?> </td>
                          <td ><?php echo $key->cour_name?></td>
                          <td ><?php echo $key->orderDate?></td>
                          <td><?php echo $this->cart->format_number($key->amount)?></td>
                            
                          <td> <a href="<?php echo base_url('shop/orderdetails?id='.$key->order_id); ?>" class='btn btn-sm btn-primary'>
                            <i class='fas fa-edit'>View Details</i></a> </td>
                        </tr>

                      <?php
                  endforeach;
                  ?>
              </tbody>
            </table>
          </div>