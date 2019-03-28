
<div class="container-fluid">
            <div align="center" style="width:90%"> <q></q>
                <h2 style="margin-right:64%;">Your Cart</h2>
                <?php if ($this->cart->total_items()) { ?>
                    <table class="tblone" style="height:40px;">
                        <tr>
                            <th width="5%">Item</th>
                            <th width="30%">Product Name</th>
                            <th width="10%">Image</th>
                            <th width="15%">Price</th>
                            <th width="20%">Quantity</th>
                            <th width="15%">Total Price</th>
                            <th width="5%">Remove</th>
                        </tr>
                        <?php
                        $i = 0;
                        foreach ($cart_contents as $cart_items) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $cart_items['name'] ?></td>
                                <td><img src="<?php echo base_url('uploads/' . $cart_items['options']['product_image']) ?>" style="height:40px;"alt=""/></td>
                                <td>PHP. <?php echo $this->cart->format_number($cart_items['price']) ?></td>
                                <td>
                                    <form action="<?php echo base_url('update/cart'); ?>" method="post">
                                        <input type="number" name="qty" value="<?php echo $cart_items['qty'] ?>"/>
                                        <input type="hidden" name="rowid" value="<?php echo $cart_items['rowid'] ?>"/>
                                        <input type="submit" name="submit" value="Update"/>
                                    </form>
                                </td>
                                <td>PHP. <?php echo $this->cart->format_number($cart_items['subtotal']) ?></td>
                                <td>
                                    <form action="<?php echo base_url('shop/remove_cart'); ?>" method="post">
                                        <input type="hidden" name="rowid" value="<?php echo $cart_items['rowid'] ?>"/>
                                        <input type="submit" name="submit" value="X"/>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>


                    </table>
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td>PHP. <?php echo $this->cart->format_number($this->cart->total()) ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>PHP. 
                                <?php
                                $total = $this->cart->total();
                                $tax = ($total * 12) / 100;
                                echo $this->cart->format_number($tax);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td>PHP. <?php echo $this->cart->format_number($tax + $this->cart->total()); ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <br>
                        <div style="display:block;"align="center">
                            <td><a href="<?= base_url('shop/'); ?>" class="btn btn-info">Continue Shopping</a></td>
                            <td><a href="<?= base_url('shop/checkout');?>" class="btn btn-success">Check Out</a></td>
                        </tr>
                    </div>
                    <?php
                } else {
                    echo "<h1>Your Cart Empty</h1>";
                }
                ?>
            </div>
        </div>

