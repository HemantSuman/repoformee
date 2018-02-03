<?php
if (isset($dynamic_attr) && !empty($dynamic_attr)) {
    foreach ($dynamic_attr as $key => $value) {
        if ($value['p_attr_id'] == 0 && $value['searchable'] == 1) {
            ?>

            <li data-accordion>                                   

                <?php if ($value['attr_type_name'] == 'Drop-Down') { ?>

                    <a href="javascript:void(0)" data-control>
                        <img src="{{ URL:: asset('/upload_images/attributes/30px/'.$value['attribute_id'].'/'.$value['icon'])}}" alt="">
                        {{ $value['display_name'] }} 
                    </a>

                    <ul class="pws-sub-cat" data-content> 

                        <li data-accordion>     
                            <?php
                            $options = '';
                            $options .= "<option value=''> Select Option </option> ";
                            if (!empty($value['attribute_value'])) {
                                foreach ($value['attribute_value'] as $k1 => $v1) {
                                    $options .= "<option value='$k1'>$v1</option> ";
                                }
                            }
                            ?>
                            <select class="onchange_dropdown" name="attr_dy_arr[<?php echo $value['attribute_id']; ?>][<?php echo $value['attr_type_name']; ?>]" >
                                <?php echo $options; ?>
                            </select>
                        </li>

                    </ul>
                <?php } else if ($value['attr_type_name'] == 'Radio-button') { ?>

                    <a href="javascript:void(0)" data-control>
                        <img src="{{ URL:: asset('/upload_images/attributes/30px/'.$value['attribute_id'].'/'.$value['icon'])}}" alt="">
                        {{ $value['display_name'] }} 
                    </a>

                    <ul class="pws-sub-cat" data-content> 

                        <li data-accordion class="no-cat-border">     
                            <?php
                            $options = '';
                            foreach ($value['attribute_value'] as $k1 => $v1) {
                                $options .= "<li class='_check-selected'><input class='onchange_dropdown'  name='attr_dy_arr[$value[attribute_id]][$value[attr_type_name]]' type='radio' value='$k1'>$v1</li>";
                            }
                            ?><ul class="pws-radio-btns"><?php echo $options; ?></ul>

                        </li>

                    </ul>

                <?php } else if ($value['attr_type_name'] == 'Multi-Select') { ?>

                    <a href="javascript:void(0)" data-control>
                        <img src="{{ URL:: asset('/upload_images/attributes/30px/'.$value['attribute_id'].'/'.$value['icon'])}}" alt="">
                        {{ $value['display_name'] }} 
                    </a>

                    <ul class="pws-sub-cat" data-content> 

                        <li data-accordion class="no-cat-border">     
                            <?php
                            $options = '';
                            foreach ($value['attribute_value'] as $k1 => $v1) {
                                $options .= "<li class='_check-selected'><input class='onchange_dropdown' name='attr_dy_arr[$value[attribute_id]][$value[attr_type_name]][]' type='checkbox' value='$k1'>$v1</li>";
                            }
                            ?>

                            <ul class="pws-radio-btns"><?php echo $options; ?></ul>
                        </li>

                    </ul>

                <?php } else if ($value['attr_type_name'] == 'calendar') { ?>

                    <?php if (isset($value['attribute_value']) && !empty($value['attribute_value'])) { ?>

                        <a href="javascript:void(0)" data-control>
                            <img src="{{ URL:: asset('/upload_images/attributes/30px/'.$value['attribute_id'].'/'.$value['icon'])}}" alt="">
                            {{ $value['display_name'] }} 
                        </a>

                        <ul class="pws-sub-cat" data-content> 

                            <li data-accordion>     
                                <?php
                                $options = '';
                                $options .= "<option value=''> Select Option </option> ";
                                $newArr = [];

                                $rang_cal = array_values($value['attribute_value']);
                                $total = $rang_cal[1] - $rang_cal[0];
                                (int) $rang_cal[0];
                                //                                            dd((int) $rang_cal[0]);
                                for ($i = (int) $rang_cal[0]; $i <= (int) $rang_cal[1]; $i = $i + 1) {
                                    $options .= "<option  value=" . $i . ">" . $i . "</option>";
                                }
                                ?>
                                <select class="onchange_dropdown" name="attr_dy_arr[<?php echo $value['attribute_id']; ?>][<?php echo $value['attr_type_name']; ?>]" >
                                    <?php echo $options; ?>
                                </select>
                            </li>

                        </ul>

                    <?php } ?>
                <?php } else if ($value['attr_type_name'] == 'Numeric') { ?>

                    <?php if (isset($value['attribute_value']) && !empty($value['attribute_value'])) { ?>

                        <a href="javascript:void(0)" data-control>
                            <img src="{{ URL:: asset('/upload_images/attributes/30px/'.$value['attribute_id'].'/'.$value['icon'])}}" alt="">
                            {{ $value['display_name'] }} 
                        </a>

                        <ul class="pws-sub-cat" data-content> 

                            <li data-accordion class="no-cat-border">
                                <div class="min-max-price-in min-max-price-two">     
                                    <input name="attr_dy_arr[<?php echo $value['attribute_id']; ?>][Numeric_range]" class="min_value_<?php echo $value['attribute_id']; ?>" type="text" placeholder="" >
                                    <?php /* <input name="attr_dy_arr[<?php echo $value['attribute_id']; ?>][Numeric_range][]" class="max_value_<?php echo $value['attribute_id']; ?>" type="text" placeholder="Max" > */ ?>
                                    <input class="go_button_numeric" value="GO" attr_id="<?php echo $value['attribute_id']; ?>" type="button" class="" >
                                </div>
                            </li>

                        </ul>

                    <?php } else { ?>

                        <a href="javascript:void(0)" data-control>
                            <img src="{{ URL:: asset('/upload_images/attributes/30px/'.$value['attribute_id'].'/'.$value['icon'])}}" alt="">
                            {{ $value['display_name'] }}
                        </a>

                        <ul class="pws-sub-cat" data-content> 

                            <li data-accordion class="no-cat-border"> 
                                <div class="min-max-price-in">
                                    <input name="attr_dy_arr[<?php echo $value['attribute_id']; ?>][Numeric_no_range][]" class="min_value_<?php echo $value['attribute_id']; ?>" type="text" placeholder="Min" >
                                    <input name="attr_dy_arr[<?php echo $value['attribute_id']; ?>][Numeric_no_range][]" class="max_value_<?php echo $value['attribute_id']; ?>" type="text" placeholder="Max" >
                                    <input class="go_button_numeric" value="GO" attr_id="<?php echo $value['attribute_id']; ?>" type="button" class="" >
                                </div>    
                            </li>

                        </ul>

                    <?php } ?>
                <?php } ?>
            </li>
            <?php
        }
    }
}
?>
