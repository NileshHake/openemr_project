<?php /* Smarty version 2.6.33, created on 2022-04-11 12:28:45
         compiled from /var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'headerTemplate', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 12, false),array('function', 'xlj', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 23, false),array('function', 'xlt', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 142, false),array('function', 'xla', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 148, false),array('modifier', 'attr', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 151, false),array('modifier', 'date_format', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 160, false),array('modifier', 'text', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 164, false),array('modifier', 'substr', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 217, false),array('modifier', 'js_escape', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 280, false),array('modifier', 'js_url', '/var/www/html/openemr/interface/forms/vitals/templates/vitals/general_new.html', 368, false),)), $this); ?>
<html>
<head>
<?php echo smarty_function_headerTemplate(array('assets' => 'datetime-picker'), $this);?>


<?php echo '
<script>
function vitalsFormSubmitted() {
    var invalid = "";

    var elementsToValidate = new Array();

    elementsToValidate[0] = new Array();
    elementsToValidate[0][0] = \'weight_input\';
    elementsToValidate[0][1] = '; ?>
<?php echo smarty_function_xlj(array('t' => 'Weight'), $this);?>
<?php echo ' + \' (\' + '; ?>
<?php echo smarty_function_xlj(array('t' => 'lbs'), $this);?>
<?php echo ' + \')\';

    elementsToValidate[1] = new Array();
    elementsToValidate[1][0] = \'weight_input_metric\';
    elementsToValidate[1][1] = '; ?>
<?php echo smarty_function_xlj(array('t' => 'Weight'), $this);?>
<?php echo ' + \' (\' + '; ?>
<?php echo smarty_function_xlj(array('t' => 'kg'), $this);?>
<?php echo ' + \')\';

    elementsToValidate[2] = new Array();
    elementsToValidate[2][0] = \'height_input\';
    elementsToValidate[2][1] = '; ?>
<?php echo smarty_function_xlj(array('t' => "Height/Length"), $this);?>
<?php echo ' + \' (\' + '; ?>
<?php echo smarty_function_xlj(array('t' => 'in'), $this);?>
<?php echo ' + \')\';

    elementsToValidate[3] = new Array();
    elementsToValidate[3][0] = \'height_input_metric\';
    elementsToValidate[3][1] = '; ?>
<?php echo smarty_function_xlj(array('t' => "Height/Length"), $this);?>
<?php echo ' + \' (\' + '; ?>
<?php echo smarty_function_xlj(array('t' => 'cm'), $this);?>
<?php echo ' + \')\';

    elementsToValidate[4] = new Array();
    elementsToValidate[4][0] = \'bps_input\';
    elementsToValidate[4][1] = '; ?>
<?php echo smarty_function_xlj(array('t' => 'BP Systolic'), $this);?>
<?php echo ';

    elementsToValidate[5] = new Array();
    elementsToValidate[5][0] = \'bpd_input\';
    elementsToValidate[5][1] = '; ?>
<?php echo smarty_function_xlj(array('t' => 'BP Diastolic'), $this);?>
<?php echo ';

    for (var i = 0; i < elementsToValidate.length; i++) {
        var current_elem_id = elementsToValidate[i][0];
        var tag_name = elementsToValidate[i][1];

        document.getElementById(current_elem_id).classList.remove(\'error\');

        if (isNaN(document.getElementById(current_elem_id).value)) {
            invalid += '; ?>
<?php echo smarty_function_xlj(array('t' => 'The following field has an invalid value'), $this);?>
<?php echo ' + ": " + tag_name + "\\n";
            document.getElementById(current_elem_id).className = document.getElementById(current_elem_id).className + " error";
            document.getElementById(current_elem_id).focus();
        }
    }

    if (invalid.length > 0) {
        invalid += "\\n" + '; ?>
<?php echo smarty_function_xlj(array('t' => "Please correct the value(s) before proceeding!"), $this);?>
<?php echo ';
        alert(invalid);

        return false;
    } else {

        return top.restoreSession();
    }
}
</script>
<style>
    .title {
        font-weight: bold;
    }

    .currentvalues {
        padding-right: 5px;
        text-align: left;
        min-width: 10rem;
    }

    th.currentvalues,
    th.historicalvalues {
        background: var(--gray200);
    }

    .valuesunfocus {
        padding-right: 5px;
        background-color: var(--gray400);
        text-align: left;
    }

    .unfocus {
        background-color: var(--gray400);
    }

    .historicalvalues {
        background-color: var(--gray400);
        border-bottom: 1px solid var(--gray300);
        border-right: 1px solid var(--gray300);
        text-align: right;
        background: var(--gray200);
    }

    table {
        border-collapse: collapse;
        font-weight: 600;
    }

    td,
    th {
        padding-right: 10px;
        padding-left: 10px;
    }

    th {
        font-weight: 800;
    }

    td {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    input[type=text],
    select {
        margin: 1px !important;
    }

    .hide {
        display: none;
    }

    .readonly {
        display: none;
    }

    .error {
        border: 2px solid var(--danger);
    }
</style>
'; ?>


<title><?php echo smarty_function_xlt(array('t' => 'Vitals'), $this);?>
</title>
</head>
<body>

 <div class="container mt-3">
    <div class="row">
        <h2><?php echo smarty_function_xlt(array('t' => 'Vitals'), $this);?>
&nbsp;&nbsp;&nbsp;<a href="../summary/demographics.php" class="text-decoration-none" onclick="top.restoreSession()" title="<?php echo smarty_function_xla(array('t' => 'Back to patient dashboard'), $this);?>
"><i id="advanced-tooltip" class="readonly fas fa-arrow-circle-left fa-2x small" aria-hidden="true"></i> </a></h2>
        <div class="col-sm-12">
            <form name="vitals" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
/interface/forms/vitals/save.php" onSubmit="return vitalsFormSubmitted()">
                <input type="hidden" name="csrf_token_form" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                <div id="chart" class="chart-dygraphs" style="margin-left: -15px"></div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left"><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</th>
                                    <th class="text-left"><?php echo smarty_function_xlt(array('t' => 'Unit'), $this);?>
</th>
                                    <th class='currentvalues p-2' title="<?php echo smarty_function_xla(array('t' => 'Date and time of this observation'), $this);?>
">
                                        <input type='text' size='14' class='form-control datetimepicker oe-patient-background' name='date' id='date' value='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['vitals']->get_date())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")))) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
' />
                                    </th>
                                    <th class="currentvalues editonly"><?php echo smarty_function_xlt(array('t' => 'Abn'), $this);?>
</th>
                                    <?php $_from = $this->_tpl_vars['results']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>
                                        <th class='historicalvalues'><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['result']->get_date())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")))) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</th>
                                    <?php endforeach; endif; unset($_from); ?>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- TODO: we could pull much of each individual metric into the controller and have the templates driven by configuration would that be easier to understand? -->
                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox_conversion.tpl", 'smarty_include_vars' => array('title' => 'Weight','input' => 'weight','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_weight','vitalsValueMetric' => 'get_weight_metric','unit' => 'lbs','unitMetric' => 'kg','vitalsStringFormat' => "%.2f",'vitalsValueUSAHelpTitle' => "Decimal pounds or pounds and ounces separated by #(e.g. 5#4)")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox_conversion.tpl", 'smarty_include_vars' => array('title' => "Height/Length",'input' => 'height','vitalsValue' => 'get_height','vitalsValueMetric' => 'get_height_metric','unit' => 'in','unitMetric' => 'cm','vitalsStringFormat' => "%.2f")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'BP Systolic','unit' => 'mmHg','input' => 'bps','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_bps')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'BP Diastolic','unit' => 'mmHg','input' => 'bpd','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_bpd')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Pulse','unit' => 'per min','input' => 'pulse','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_pulse','vitalsStringFormat' => "%.0f")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Respiration','unit' => 'per min','input' => 'respiration','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_respiration','vitalsStringFormat' => "%.0f")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox_conversion.tpl", 'smarty_include_vars' => array('title' => 'Temperature','input' => 'temperature','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_temperature','vitalsValueMetric' => 'get_temperature_metric','unit' => 'F','unitMetric' => 'C','vitalsStringFormat' => "%.2f")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_temp_method.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Oxygen Saturation','unit' => "%",'input' => 'oxygen_saturation','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_oxygen_saturation','vitalsStringFormat' => "%.0f")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Oxygen Flow Rate','unit' => "l/min",'input' => 'oxygen_flow_rate','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_oxygen_flow_rate')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Inhaled Oxygen Concentration','unit' => "%",'input' => 'inhaled_oxygen_concentration','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_inhaled_oxygen_concentration')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox_conversion.tpl", 'smarty_include_vars' => array('title' => 'Head Circumference','input' => 'head_circ','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_head_circ','vitalsValueMetric' => 'get_head_circ_metric','unit' => 'in','unitMetric' => 'cm','vitalsStringFormat' => "%.2f",'hide' => $this->_tpl_vars['hide_circumferences'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox_conversion.tpl", 'smarty_include_vars' => array('title' => 'Waist Circumference','input' => 'waist_circ','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_waist_circ','vitalsValueMetric' => 'get_waist_circ_metric','unit' => 'in','unitMetric' => 'cm','vitalsStringFormat' => "%.2f",'hide' => $this->_tpl_vars['hide_circumferences'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                    <tr><td class="graph" id="BMI"><?php echo smarty_function_xlt(array('t' => 'BMI'), $this);?>
</td><td><?php echo smarty_function_xlt(array('t' => "kg/m^2"), $this);?>
</td>
                                        <td class='currentvalues p-2'><input type="text" class="form-control" size='5'
                                            name='BMI' id='BMI_input' value="<?php if ($this->_tpl_vars['vitals']->get_BMI() != 0): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['vitals']->get_BMI())) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 5) : substr($_tmp, 0, 5)))) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
<?php endif; ?>"/></td>
                                        <td class="editonly"></td>
                                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_historical_values.tpl', 'smarty_include_vars' => array('vitals' => $this->_tpl_vars['vitals'],'useMetric' => false,'vitalsValue' => 'get_BMI','results' => $this->_tpl_vars['results'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                    </tr>

                                    <tr>
                                        <td><?php echo smarty_function_xlt(array('t' => 'BMI Status'), $this);?>
</td><td><?php echo smarty_function_xlt(array('t' => 'Type'), $this);?>
</td>
                                        <td class='currentvalues p-2'>
                                            <input type="text" class="form-control" size='20'
                                                name="BMI_status" id="BMI_status" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_BMI_status())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"/></td>
                                        <td class="editonly"></td>
                                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_historical_values.tpl', 'smarty_include_vars' => array('vitals' => $this->_tpl_vars['vitals'],'useMetric' => false,'vitalsValue' => 'get_BMI_status','results' => $this->_tpl_vars['results'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                    </tr>

                                <?php if ($this->_tpl_vars['patient_age'] <= 20 || ( preg_match ( '/month/' , $this->_tpl_vars['patient_age'] ) )): ?>
                                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Pediatric Weight Height Percentile','unit' => "%",'input' => 'ped_weight_height','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_ped_weight_height')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Pediatric BMI Percentile','unit' => "%",'input' => 'ped_bmi','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_ped_bmi')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

                                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_textbox.tpl", 'smarty_include_vars' => array('title' => 'Pediatric Head Circumference Percentile','unit' => "%",'input' => 'ped_head_circ','vitals' => $this->_tpl_vars['vitals'],'vitalsValue' => 'get_ped_head_circ','hide' => $this->_tpl_vars['hide_circumferences'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                <?php endif; ?>

                                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vitals_notes.tpl", 'smarty_include_vars' => array('title' => 'Other Notes','unit' => "",'input' => 'note','vitalsValue' => $this->_tpl_vars['vitals']->get_note())));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                    <tr><td>&nbsp;</td></tr>

                                    <tr>
                                        <td colspan='5' class="text-center">
                                            <?php if ($this->_tpl_vars['patient_age'] <= 20 || ( preg_match ( '/month/' , $this->_tpl_vars['patient_age'] ) )): ?>
                                            <!-- only show growth-chart button for patients < 20 years old -->
                                            <input type="button" class="btn btn-primary" id="pdfchart" value='<?php echo smarty_function_xla(array('t' => "Growth-Chart"), $this);?>
 (<?php echo smarty_function_xla(array('t' => 'PDF'), $this);?>
)'>
                                            <input type="button" class="btn btn-primary" id="htmlchart" value='<?php echo smarty_function_xla(array('t' => "Growth-Chart"), $this);?>
 (<?php echo smarty_function_xla(array('t' => 'HTML'), $this);?>
)'>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                <div class="form-group">
                    <div class="text-left position-override">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary btn-save editonly" name="Submit" value=''><?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>
</button>
                            <button type="button" class="btn btn-secondary btn-cancel editonly" id="cancel" value=''><?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>
</button>
                        </div>
                    </div>
                </div>
            <br /><br />
            <input type="hidden" name="id" id='id' value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
            <input type="hidden" name="uuid" id='uuid' value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_uuid_string())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
            <input type="hidden" name="activity" id='activity' value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_activity())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
            <input type="hidden" name="pid" id='pid' value="<?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_pid())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
            <input type="hidden" name="process" id='process' value="true" />
            </form>
        </div>
    </div>
    </div>
<script>
var formdate = <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['vitals']->get_date())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y%m%d") : smarty_modifier_date_format($_tmp, "%Y%m%d")))) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
// vitals array elements are in the format:
//   date-height-weight-head_circumference
var vitals = new Array();
// get values from the current form elements
vitals[0] = formdate + '-' + <?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_height())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
 + '-' + <?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_weight())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
 + '-' + <?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_head_circ())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
// historic values
<?php $_from = $this->_tpl_vars['results']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>
vitals[vitals.length] = <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['result']->get_date())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y%m%d") : smarty_modifier_date_format($_tmp, "%Y%m%d")))) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
 + '-' + <?php echo ((is_array($_tmp=$this->_tpl_vars['result']->get_height())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
 + '-' + <?php echo ((is_array($_tmp=$this->_tpl_vars['result']->get_weight())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
 + '-' + <?php echo ((is_array($_tmp=$this->_tpl_vars['result']->get_head_circ())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
<?php endforeach; endif; unset($_from); ?>
var patientAge= <?php echo ((is_array($_tmp=$this->_tpl_vars['patient_age'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
var patient_dob= <?php echo ((is_array($_tmp=$this->_tpl_vars['patient_dob'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
var webroot = <?php echo ((is_array($_tmp=$this->_tpl_vars['FORM_ACTION'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
var pid = <?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->get_pid())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
var cancellink = <?php echo ((is_array($_tmp=$this->_tpl_vars['DONT_SAVE_LINK'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
var birth_xl= <?php echo smarty_function_xlj(array('t' => "Birth-24 months"), $this);?>
;
var older_xl= <?php echo smarty_function_xlj(array('t' => "2-20 years"), $this);?>
;
<?php echo '
function addGCSelector()
{
    var options=new Array();
    var birth={\'display\':birth_xl,\'param\':\'birth\'};
    var age2={\'display\':older_xl,\'param\':\'2-20\'}
    if((patientAge.toString().indexOf(\'24 month\')>=0) || (patientAge.toString().indexOf(\'month\')==-1))
        {
            var dob_data=patient_dob.split("-");
            var dob_date=new Date(dob_data[0],parseInt(dob_data[1])-1,dob_data[2]);
            options[0]=age2;
            for(var idx=0;idx<vitals.length;idx++)
                {
                    var str_data_date=vitals[idx].split("-")[0];
                    var data_date=new Date(str_data_date.substr(0,4),parseInt(str_data_date.substr(4,2))-1,str_data_date.substr(6,2));
                    if(((data_date-dob_date)/86400000)<=2*365)
                        {
                            idx=vitals.length;
                            options[1]=birth
                        }
                }
        }
        else
        {
            options[0]=birth;
        }
        var chart_buttons_cell=$("#pdfchart").parent("td");
        var select=$("<select id=\'chart_type\'></select>");
        chart_buttons_cell.prepend(select);
        for(idx=0;idx<options.length;idx++)
            {
                var option=$("<option value=\'"+options[idx].param+"\'>"+options[idx].display+"</option>");
                select.append(option);
            }
        select.find("option:first").attr("selected","true");
        if(options.length<2)
            {
                select.css("display","none");
            }
}

$(function () {
    $("#growthchart").on("click", function() { ShowGrowthchart(); });
    $("#pdfchart").on("click", function() { ShowGrowthchart(1); });
    $("#htmlchart").on("click", function() { ShowGrowthchart(2); });
    $("#cancel").on("click", function() { location.href=cancellink; });
    addGCSelector();

    $(\'.datetimepicker\').datetimepicker({
        '; ?>
<?php  $datetimepicker_timepicker = true;  ?>
        <?php  $datetimepicker_showseconds = false;  ?>
        <?php  $datetimepicker_formatInput = false;  ?>
        <?php  require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php');  ?>
        <?php  // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma  ?><?php echo '
    });

});

function ShowGrowthchart(doPDF) {
    // get values from the current form elements
    '; ?>

    vitals[0] = formdate+'-'+$("#height_input").val()+'-'+$("#weight_input").val()+'-'+$("#head_circ_input").val();
    <?php echo '
    // build the data string
    var datastring = "";
    for(var i=0; i<vitals.length; i++) {
        datastring += vitals[i]+"~";
    }
    newURL = webroot + \'/interface/forms/vitals/growthchart/chart.php?pid=\' + encodeURIComponent(pid) + \'&data=\' + encodeURIComponent(datastring);
    if (doPDF == 1) newURL += "&pdf=1";
    if (doPDF == 2) newURL += "&html=1";
    newURL += "&chart_type=" + encodeURIComponent($("#chart_type").val()) + "&csrf_token_form=" + '; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('js_url', true, $_tmp) : js_url($_tmp)); ?>
<?php echo ';
    // do the new window stuff
    top.restoreSession();
    window.open(newURL, \'_blank\', "menubar=1,toolbar=1,scrollbars=1,resizable=1,width=600,height=450");
}
        '; ?>

</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_javascript_functions.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</body>
</html>