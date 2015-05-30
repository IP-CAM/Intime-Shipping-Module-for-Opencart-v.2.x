<?php
/**
 * OpenCart Ukrainian Community
 * This Product Made in Ukraine
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License, Version 3
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/copyleft/gpl.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 *
 * @category   OpenCart
 * @package    Intime Shipping
 * @copyright  Copyright (c) 2011 Eugene Lifescale (a.k.a. Shaman) by OpenCart Ukrainian Community (http://opencart-ukraine.tumblr.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License, Version 3
 */
 ?>

<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
        <?php if ($intime_id && $intime_key) { ?>
          <a onclick="if (confirm('<?php echo $text_db_update_confirm; ?>')) { location='<?php echo $update; ?>' };" class="button"><?php echo $button_db_update; ?></a>
        <?php } ?>
        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
        <a onclick="location='<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td colspan="2"><strong><?php echo $entry_api; ?></strong></td>
          </tr>
          <tr>
            <td><?php echo $entry_id; ?></td>
            <td><input type="text" name="intime_id" value="<?php echo $intime_id; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_key; ?></td>
            <td><input type="text" name="intime_key" value="<?php echo $intime_key; ?>" size="50"/></td>
          </tr>
          <?php if ($intime_id && $intime_key) { ?>
            <tr>
              <td colspan="2"><strong><?php echo $entry_sender_info; ?></strong></td>
            </tr>
            <tr>
              <td><?php echo $entry_sender_city; ?></td>
              <td>
                <input type="text" name="intime_sender_place" value="<?php echo $intime_sender_place; ?>" size="50" />

                <input type="hidden" name="intime_sender_state" value="<?php echo $intime_sender_state; ?>" />
                <input type="hidden" name="intime_sender_city" value="<?php echo $intime_sender_city; ?>" />
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_sender_warehouse; ?></td>
              <td id="intime_sender_warehouse_code">
                <select name="intime_sender_warehouse_code">
                  <option value="0"><?php echo $text_select; ?></option>
                  <?php foreach ($warehouses as $warehouse) { ?>
                    <?php if ($intime_sender_warehouse_code == $warehouse['warehouse_code']) { ?>
                      <option value="<?php echo $warehouse['warehouse_code']; ?>" selected="selected"><?php echo $warehouse['name']; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $warehouse['warehouse_code']; ?>"><?php echo $warehouse['name']; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_sender_phone; ?></td>
              <td><input type="text" name="intime_sender_phone" value="<?php echo $intime_sender_phone; ?>" /></td>
            </tr>
            <tr>
              <td colspan="2"><strong><?php echo $entry_send_info; ?></strong></td>
            </tr>
            <tr>
              <td><?php echo $entry_insurance_сost; ?></td>
              <td><input type="text" name="intime_insurance_сost" value="<?php echo $intime_insurance_сost; ?>" size="5" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_pod_amount; ?></td>
              <td><input type="text" name="intime_pod_amount" value="<?php echo $intime_pod_amount; ?>" size="5" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_pod_payment_type; ?></td>
              <td><input type="text" name="intime_pod_payment_type" value="<?php echo $intime_pod_payment_type; ?>" size="5" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_date_offset; ?></td>
              <td>
                <select name="intime_date_offset">
                  <?php for ($i = 1; $i <= 31; $i++) { ?>
                    <?php if ($intime_date_offset == $i) { ?>
                      <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2"><strong><?php echo $entry_common_info; ?></strong></td>
            </tr>
            <tr>
              <td><?php echo $entry_geo_zone; ?></td>
              <td><select name="intime_geo_zone_id">
                  <option value="0"><?php echo $text_all_zones; ?></option>
                  <?php foreach ($geo_zones as $geo_zone) { ?>
                  <?php if ($geo_zone['geo_zone_id'] == $intime_geo_zone_id) { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="intime_status">
                  <?php if ($intime_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="intime_sort_order" value="<?php echo $intime_sort_order; ?>" size="1" /></td>
            </tr>
          <?php } ?>
        </table>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript"><!--

$(document).ready(function() {

  var intime_sender_state = $('input[name=\'intime_sender_state\']').val();
  var intime_sender_city  = $('input[name=\'intime_sender_city\']').val();

  if (intime_sender_state != '' && intime_sender_city != '') {
    $.ajax({
      url: 'index.php?route=shipping/intime/warehouse&token=<?php echo $token; ?>&filter_city=' + encodeURIComponent(intime_sender_city) + '&filter_state=' + encodeURIComponent(intime_sender_state),
      dataType: 'json',
      success: function (json) {

        html = '<select name="intime_sender_warehouse_code">';
        html += '<option value=""><?php echo $text_select; ?></option>';
        for (i = 0; i < json.length; i++) {
          if (json[i]['warehouse_code'] == '<?php echo $intime_sender_warehouse_code; ?>') {
            html += '<option value="' + json[i]['warehouse_code'] + '" selected="selected">' + json[i]['name'] + '</option>';
          } else {
            html += '<option value="' + json[i]['warehouse_code'] + '">' + json[i]['name'] + '</option>';
          }
        }
        html += '</select>';

        $('#intime_sender_warehouse_code').html(html);
      }
    });
  }
});

$('input[name=\'intime_sender_place\']').autocomplete({
  delay: 0,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=shipping/intime/autocomplete&token=<?php echo $token; ?>',
      type: 'POST',
      dataType: 'json',
      data: 'filter_city=' +  encodeURIComponent(request.term),
      success: function(data) {
        response($.map(data, function(item) {
          return {
            value: item.warehouse_code,
            label: item.name,
            city:  item.city,
            state: item.state
          }
        }));
      }
    });
  },
  select: function(event, ui) {
    $('input[name=\'intime_sender_place\']').val(ui.item.label);
    $('input[name=\'intime_sender_city\']').val(ui.item.city);
    $('input[name=\'intime_sender_state\']').val(ui.item.state);

    // Load warehouses by selected city
    $('#intime_sender_warehouse_code').html('Loading...');

    $.ajax({
      url: 'index.php?route=shipping/intime/warehouse&token=<?php echo $token; ?>&filter_city=' + encodeURIComponent(ui.item.city) + '&filter_state=' + encodeURIComponent(ui.item.state),
      dataType: 'json',
      success: function(json) {

        html = '<select name="intime_sender_warehouse_code">';
        html += '<option value=""><?php echo $text_select; ?></option>';
        for (i = 0; i < json.length; i++) {
            html += '<option value="' + json[i]['warehouse_code'] + '">' + json[i]['name'] + '</option>';
        }
        html += '</select>';

        $('#intime_sender_warehouse_code').html(html);
      }
    });

    return false;
  }
});
//--></script>
<?php echo $footer; ?>
