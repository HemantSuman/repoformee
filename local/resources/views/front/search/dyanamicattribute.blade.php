
<?php
if (isset($newAttrArr1) && !empty($newAttrArr1)) {
    foreach ($newAttrArr1 as $key => $value) {

//             if (typeof v.attribute_name != 'undefined') {
//                var options = '';
//
//                $.each(v.attribute_value_multi, function (i, opt) {
//                    options += '<option value="' + i + '">' + opt + '</option>';
//                });
//
//                if (parseInt(v.p_attr_id) == 0) {
//                    var classForOnChange = 'classForOnChange';
//                } else {
//                    var classForOnChange = '';
//                }
//
//                $('#attrName').append('<div class="divAttrValue row step3row"><div class="col-sm-8" ><span>' + v.attribute_name + '</span></div><div class="col-sm-8"><div class="value-field"><input type="hidden" value="' + v.attribute_type.name + '" name="attr_type_name[]" /><input type="hidden" value="0" name="parent_value_id[]"><input type="hidden" value="0" name="parent_attribute_id[]"><input type="hidden" value="' + v.attribute_type.id + '" name="attr_type_id[]" /><input type="hidden" value="' + i + '" name="attr_ids[]" /><select attributeId="' + i + '" class=" form-control attr_value textRequired preselect ' + classForOnChange + '" is_required="' + is_required + '" dataname="' + v.attribute_name + '" name="attr_value[]" ><option value="">Select One</option>' + options + '</select></div></div></div>');
//            }


        if ($key == 'Drop-Down') {
          //  dd($value);
            foreach ($value as $k => $val) {
              //  echo $val[0]['p_attr_id'];
//dd($val[0]['p_attr_id']);
                
                $options = '';
                $options .= "<option classified_filter_id=''attr_filter_id1='" . $val[0]['attribute_id'] . "' value=''> Select Option </option> ";
                $newArr = [];

                foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                    if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {

                        $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];

                        $classified_filter_id = json_encode($newArr);
                    } else {
                        $classified_filter_id = '';
                    }
                    $options .= "<option classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' value=" . $k1 . ">" . $v1 . "</option>";
                }
                ?>
                <li>
                    <label>{{ $k }}</label>
                    <ul>
                        <li>
                            <select attributeId="<?php echo $val[0]['attribute_id']; ?>" value="<?php echo $val[0]['attribute_id']; ?>" class='filterdrop classForOnChange'>
                <?php echo $options; ?>
                            </select>
                        </li>													
                    </ul>
                </li>
                <?php
            }
        }
        if ($key == 'Multi-Select') {
            foreach ($value as $k => $val) {
                $options = '';
                $newArr = [];
                foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                    if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {
                        $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];
                        $classified_filter_id = json_encode($newArr);
                    } else {
                        $classified_filter_id = '';
                    }
                    $options .= "<input classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' type='checkbox' class ='filterchkbox dyCheckBox_" . $val[0]['attribute_id'] . "' value='" . $k1 . "'/> " . '<label>' . $v1 . '</label>' . " ";
                }
                ?>
                <li>
                    <label>{{ $k }}</label>
                    <ul>
                        <li class="">
                <?php echo $options; ?>
                        </li>													
                    </ul>
                </li>
                <?php
            }
        }
        if ($key == 'Radio-button') {
            foreach ($value as $k => $val) {
                $options = '';
                $newArr = [];
                foreach ($val[0]['attr_AllValues'] as $k1 => $v1) {
                    if (isset($newAttrArrForValue[$k1]) && !empty($newAttrArrForValue[$k1])) {
                        $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$k1];
                        $classified_filter_id = json_encode($newArr);
                    } else {
                        $classified_filter_id = '';
                    }
                    $options .= "<input type='radio' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "'  name='radio_" . $val[0]['attribute_id'] . "' class ='filterradio' value='" . $k1 . "'/> " . '<label>' . $v1 . '</label>' . " ";
                }
                ?>
                <li>
                    <label>{{ $k }}</label>
                    <ul>
                        <li>
                <?php echo $options; ?>
                        </li>													
                    </ul>
                </li>
                <?php
            }
        }
        if ($key == 'calendar') {
            foreach ($value as $k => $val) {
                $options = '';
                $newArr = [];
                if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {

                    $rang_cal = array_values($val[0]['attr_AllValues']);
                    $total = $rang_cal[1] - $rang_cal[0];

                    for ($i = $rang_cal[0]; $i <= $rang_cal[1]; $i = $i + 100) {
                        $cIdArr = [];
                        foreach ($val as $k2 => $v2) {
                            $minMax = explode(';', $v2['attr_value']);
                            if ($i >= $minMax[0] && $i <= $minMax[1]) {
                                $cIdArr[] = $v2['classified_id'];
                            }
                        }
                        $newArr[$val[0]['attribute_id']] = $cIdArr;
                        $classified_filter_id = json_encode($newArr);
//                                                                        if($i)
                        $options .= "<option classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' value=" . $i . ">" . $i . "</option>";
                    }
                }
                ?>
                <li>
                    <label>{{ $k }}</label>
                    <ul>
                        <li>
                            <select value="<?php echo $val[0]['attribute_id']; ?>" class='filtercalanderdrop'>
                <?php echo $options; ?>
                            </select>
                        </li>													
                    </ul>
                </li>
                <?php
            }
        }
        if ($key == 'Numeric') {
            foreach ($value as $k => $val) {
//                                                                dd($val);
                $options = '';
                $newArr = [];
                $newArr11 = [];
                foreach ($val as $k2 => $v2) {

                    if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                        $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                        $classified_filter_id = json_encode($newArr);
                        $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                        $classified_json_input = json_encode($newArr11);
                    } else {
                        $classified_filter_id = '';
                        $classified_json_input = '';
                    }
//                                                                    dd($newArr11);
                }

//                                                                dd($val[0]['attr_type_name']);
                if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                    $options .= "<input type='text'  classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' name='' ><input type='button' value='Go' class='go-btn numericfilter'>";
                }
                ?>
                <li>
                    <label>{{ $k }}</label>
                    <ul>
                        <li>
                <?php echo $options; ?>
                        </li>													
                    </ul>
                </li>
                <?php
            }
        }
        if ($key == 'Date') {
            foreach ($value as $k => $val) {
                $options = '';
                $newArr = [];
                $newArr11 = [];
                foreach ($val as $k2 => $v2) {

                    if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                        $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                        $classified_filter_id = json_encode($newArr);
                        $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                        $classified_json_input = json_encode($newArr11);
                    } else {
                        $classified_filter_id = '';
                        $classified_json_input = '';
                    }
//                                                                    dd($newArr11);
                }
                if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                    $options .= "<input type='text' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='datepicker' name='' ><input type='button' value='Go' class='go-btn datefilter'>";
                }
                ?>
                <li>
                    <label>{{ $k }}</label>
                    <ul>
                        <li>
                <?php echo $options; ?>
                        </li>													
                    </ul>
                </li>
                <?php
            }
        }
        if ($key == 'Time') {
            foreach ($value as $k => $val) {
                $options = '';
                $newArr = [];
                $newArr11 = [];
                foreach ($val as $k2 => $v2) {

                    if (isset($newAttrArrForValue[$v2['attr_value']]) && !empty($newAttrArrForValue[$v2['attr_value']])) {
                        $newArr[$val[0]['attribute_id']] = $newAttrArrForValue[$v2['attr_value']];
                        $classified_filter_id = json_encode($newArr);
                        $newArr11[$val[0]['attribute_id']][$v2['attr_value']] = $newAttrArrForValue[$v2['attr_value']];
                        $classified_json_input = json_encode($newArr11);
                    } else {
                        $classified_filter_id = '';
                        $classified_json_input = '';
                    }
//                                                                    dd($newArr11);
                }
                if (isset($val[0]['attr_AllValues']) && !empty($val[0]['attr_AllValues'])) {
                    $options .= "<input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='timepicker' type='text' ><input type='button' value='Go' class='go-btn timefilter'>";
//                                                                    $options .= "<div class='input-group bootstrap-timepicker'><input placeholder='' classified_json_input='" . $classified_json_input . "' classified_filter_id='" . $classified_filter_id . "' attrTypeName='" . $val[0]['attr_type_name'] . "' attr_filter_id='" . $val[0]['attribute_id'] . "' class='timepicker' type='text' ><div class='input-group-addon' ><i class='fa fa-clock-o'></i></div></div><input type='button' value='Go' class='go-btn timefilter'>";
                }
                ?>
                <li>
                    <label>{{ $k }}</label>
                    <ul>
                        <li>
                <?php echo $options; ?>
                        </li>													
                    </ul>
                </li>
                <?php
            }
        }
    }
}
?>
