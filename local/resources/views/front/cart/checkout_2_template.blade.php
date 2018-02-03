<div class="col-sm-12">
    <ul class="checkout-steps">
        <li><a href="javascript:void(0);">Step 1</a></li>
        <li class="active"><a href="javascript:void(0);">Step 2</a></li>
        <li><a href="javascript:void(0);">Step 3</a></li>
        <li><a href="javascript:void(0);">Step 4</a></li>
    </ul>
    <!-- End of checkout-steps -->
</div>
<div class="col-sm-12">
    <div class="checkout-step-2">


        <div class="both_add_div" style="<?php echo (isset($users) && !empty($users)) ? 'display:block' : 'display:none'; ?>" >

            <h3>Please select your delivery address:</h3>
            <p>Either choose one of your favourite addresses below, or add a new address.</p>
            <div class="row address_div">

            </div>
            <div class="check-or"><span>or</span></div>

        </div>

        <?php /*        <div class="addnew-address-sec address_form_div" style="<?php echo (!isset($users) || empty($users) || count($users) < 2)?'display:block':'display:none'; ?>" > */ ?>
        <div class="addnew-address-sec address_form_div" >

        </div>
    </div>
</div>
<span class="address_json" style="display: none;">{{json_encode($users)}}</span>



