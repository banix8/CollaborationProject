
<div class="container-fluid">

				<h4>Delivery Information</h4>
			  	<div class="panel-body well" style="width:50%;float:left;padding-bottom:80px;">
			  			
				    <table  width="600" align="left" cellpadding="2" cellspacing="3">
				      <tr>
				              <tr>
				                 <td><label>Name</label></td>
				                 <td><input type="text" id="email" name="email" class="form-control" style="text-transform: capitalize;"value="<?= $customer_info[0]->first_name." ".$customer_info[0]->middle_name." ".$customer_info[0]->last_name; ?>"readonly><br></td>
				               </tr> 
				           </tr>

				      <tr>
				        <td><label>Contact Number:</label></td>
				        <td><input type="text" id="idnumber" name="idnumber" class="form-control"
				        	value="<?= $customer_info[0]->contact_num; ?>" readonly><br></td>
				      </tr>			      
				 	  <tr>
						<td><label>Complete Address:</label></td>
						<td>
							<textarea rows="4" cols="20" style="text-transform: capitalize;"name="textarea" class="form-control" readonly><?= $customer_info[0]->cus_street." ".$customer_info[0]->cus_city.",".$customer_info[0]->cus_province." ".$customer_info[0]->cus_postal; ?></textarea></td>
				      </tr>

				    </table>



			</div>
			<div class="panel-body well" style="width:30%;float:left;margin-left: 40px;">
				<div>
					<form action="<?php echo base_url('shop/save_order'); ?>" method="post">
						<table width="100%">
							<tr>
								<th width="30%">Order Summary</th>
							</tr>
							<tr>
								<td><br><p>Subtotal</p></td>
								<td><br><p> PHP. <?php echo $this->cart->format_number($this->cart->total()) ?></p></td>
							</tr>
							<tr>
								<td>Payment Method</td>
								<td>
										<select class="mdb-select md-form" name="payment" required>
											<option value="" disabled selected> Choose your payment method</option>
										<?php foreach ($payment as $pay) {
										?>
										
										<option value="<?php echo $pay->payment_id?>"> <?= $pay->payment_name?></option>
										<?php
										}
										?>



										</select>
									
								</td>
							</tr>
							<tr>	
								<td><br>Courier</td>
								<td><br>
										<select class="mdb-select md-form" name="cour" required>
									    <option value="" disabled selected> Choose your Courier</option>
										<?php 
										foreach ($courier as $cour) {
										?>
										
										<option value="<?php echo $cour->cour_id?>"> <?= $cour->cour_name?></option>
			
										<?php
										}
										?>



										</select>
									
								</td>
							</tr>
							<tr>
								<td><br>VAT</td>
								<td><br>PHP. <?php
                                $total = $this->cart->total();
                                $tax = ($total * 12) / 100;
                                echo $this->cart->format_number($tax);
                                ?></td>
							</tr>
							<?php $total_amount=$this->cart->format_number($tax + $this->cart->total());?>
							<tr>
								<td><br>Total</td>
								<td><br>PHP. <?php echo $total_amount; ?> </td>
								<input type="hidden" name="amount" value="<?php echo $total_amount; ?>"> 								
							</tr>


						</table>
						<br>
						<button type="submit" class="btn btn-primary" style="width:100%;">Place Order</button>
					</form>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="panel-body well" style="width:50%;">
 			<div style="width:90%">
                    <table class="tblone" style="height:40px;">
                        <tr>
                            <th width="30%">Product Name</th>
                            <th width="20%">Image</th>
                            <th width="25%">Price</th>
                            <th width="12%" >Quantity</th>
                            <th width="20%">Total Price</th>
                        </tr>
                        <?php

                        foreach ($cart_contents as $cart_items) {
                        		?>
                            <tr>
                                <td><?php echo $cart_items['name'] ?></td>
                                <td><img src="<?php echo base_url('uploads/' . $cart_items['options']['product_image']) ?>" style="width:50px;height:40px;"alt=""/></td>
                                <td>PHP. <?php echo $this->cart->format_number($cart_items['price']) ?></td>
                                <td  ><?php echo $cart_items['qty'] ?></td>
                                <td>PHP. <?php echo $this->cart->format_number($cart_items['subtotal']) ?></td>
                            </tr>
                        <?php 
                   	 } 
                    ?>

                    </table>
                 </div>
             </div>
           </div>
