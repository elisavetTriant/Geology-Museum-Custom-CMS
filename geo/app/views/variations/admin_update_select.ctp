<?php
if(!empty($options)) {

  echo "<option value=''>".__('Select...', true)."</option>";
  foreach($options as $k => $v) {

    echo "<option value='$k'>$v</option>";

  }
}else echo "<option value=''>".__('No variation found...', true)."</option>";
?>