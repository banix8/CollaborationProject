<div class="container-fluid">
	<h4>SIS INVENTORY PAGE</h4>
	<!--a href="<!?= base_url('app/logout'); ?>">Logout</a-->
	<hr>
	<div class="panel">
		<div class="container-fluid">
			<table class="table table-striped">
				<tr>
			      <th scope="col">Icon</th>
			      <th scope="col">Product Name</th>
			      <th scope="col">Selling Price</th>
			      <th scope="col">Stocks Available</th>
			      <th scope="col">Stocks Sold</th>
			      <th scope="col">Actions</th>
			    </tr>
                <?php foreach ($products as $sp) { ?>
                    <!--div class="panel-body well" style=" float:left;padding:20px;margin:10px;background-color:#DCDCDC;"-->
                <tr>
                    <td><!--a  href="<!?= base_url('Shop/details?product='.$sp->product_id)?>"--><img style="height:50px" src="<?php echo base_url('uploads/'.$sp->product_image)?>" alt=""   data-toggle="modal" data-target="#myModal"/><!--/a--></td>
                    <td><p><?php echo $sp->product_name?></p></td>
                    <!--td><p><?php echo $sp->short_desc?></p></td-->
                    <td><p><span class="price"><?php echo $this->cart->format_number($sp->sell_price) ?> PHP</span></p></td>
                    <td><p><span class="price"><?php echo $this->cart->format_number($sp->quantity) ?> pcs.</span></p></td>
                    <td><p><span class="price"><?php echo $this->cart->format_number($sp->quantity) ?> pcs.</span></p></td>
                    <td><div class="button"><span><a href="<?php echo base_url('Shop/details?product='.$sp->product_id);?>" class="btn btn-primary">Details</a></span></div></td>
                    <!--/div-->
                <?php } ?>
            	</tr>
           </table>
        </div>
	</div>

	<div class="modal container-fluid" id="myModal">
        <?php foreach ($products as $single_products) { ?>
            <div class="panel-body well" style=" float:left;padding:20px;margin:10px;background-color:#DCDCDC;">
                <a  href="<?= base_url('Shop/details?product='.$single_products->product_id)?>" ><img style="height:160px" src="<?php echo base_url('uploads/'.$single_products->product_image)?>" alt="" /></a>
                <h4><?php echo $single_products->product_name?></h4>
                <p><?php echo $single_products->short_desc?></p>
                <p><span class="price"><?php echo $this->cart->format_number($single_products->sell_price) ?> PHP</span></p>
                <div class="button"><span><a href="<?php echo base_url('Shop/details?product='.$single_products->product_id);?>" class="btn btn-primary">Details</a></span></div>
            </div>
            <?php
        }
        ?>
    </div>


</div>