<?php
class monthSelection
{
    function month_select_box($field_name, $class_name, $id)
    {
        $currentMonth = date('n');
        $month_options = '';
        for ($i = 1; $i <= 12; $i++) {

            $month_num = str_pad($i, 1, 0);
            $month_name = date('F', mktime(0, 0, 0, $i + 1, 0, 0));
            $month_options .= '<option value="' . $month_num . '"';
            if ($currentMonth == $month_num) {
                $month_options .= ' class="' . $class_name . '" selected>' . $month_name . '</option>';
            }
            else {
                $month_options .= ' class="' . $class_name . '">' . $month_name . '</option>';
            }
        }
        return '<select name="' . $field_name . '" id="' . $id . '" class="' . $class_name . '" onchange="changedMonthSelection(this.value)">' . $month_options . '</select>';
    }
}
?>