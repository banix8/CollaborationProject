<h1>ADD PRODUCT </h1>
	
	<form action ="<?php echo base_url('Dashboard/submit_product');?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				<?php 
					if($this->session->flashdata('system_msg') != null){
						$msg = $this->session->flashdata('system_msg');
						$newMsg = "";
						foreach($msg as $key => $val){
							$newMsg .= $val."<br>";
						}
				?>
					<div class="alert alert-<?= $this->session->flashdata('alertType'); ?> alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  
					
				<?php 
					   echo $newMsg;
				?>
					</div>
				<?php 
					}
				?>		
		<div class="form-group">
		<label for="product_name" class="col-md-2 text-left">Product Name:</label>
			<div class="col-md-10">
				<input type="text" name="product_name" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
		<label for="purchase_price" class="col-md-2 text-left">Purchase Price:</label>
			<div class="col-md-10">
				<input type="text" name="purchase_price" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
		<label for="sell_price" class="col-md-2 text-left">Purchase sell price:</label>
			<div class="col-md-10">
				<input type="text" name="sell_price" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
				<label  class="col-md-2 text-left">Choose Image:</label>
	            <input type="text" name = "product_image" id="input">
	    </div>		
		<div class="form-group">
		<label for="short_desc" class="col-md-2 text-left">Short description:</label>
			<div class="col-md-10">
				<textarea name="short_desc" class="form-control"></textarea>
			</div>
		</div>
		<div class="form-group">
		<label for="description" class="col-md-2 text-left">Description:</label>
			<div class="col-md-10">
				<textarea name="description" class="form-control"></textarea>
			</div>
			
		</div>
		<div class="form-group">
		<label for="category_id" class="col-md-2 text-left">Category:</label>
			<select name="category_id">
				<?php foreach($category as $cat)
				{ ?>
				  <option value="<?php echo $cat->category_id?>"><?php echo $cat->category_name ?></option>
			<?php 
		} ?>
			</select>
		</div>

		<div class="form-group">
		<label for="category_id" class="col-md-2 text-left">Supplier:</label>
			<select name="supplier_id">
				<?php foreach($supplier as $sup)
				{ ?>
				  <option value="<?php echo $sup->supplier_id?>"><?php echo $sup->supplier_companyname ?></option>
			<?php 
		} ?>
			</select>
		</div>		
		<div class="form-group">
		<label class="col-md-2 text-right"></label>
			<div class="col-md-10">
				<input type="submit" class="btn btn-primary" value="Save">
				<a href="<?php echo base_url('Shop/tab');?>" class="btn btn-default">Back</a>
			</div>
		</div>

	</form>