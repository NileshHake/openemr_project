<?php /* Smarty version 2.6.33, created on 2022-04-11 12:28:45
         compiled from vitals_textbox_conversion.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'attr', 'vitals_textbox_conversion.tpl', 8, false),array('modifier', 'attr_js', 'vitals_textbox_conversion.tpl', 28, false),array('modifier', 'default', 'vitals_textbox_conversion.tpl', 28, false),array('modifier', 'xlt', 'vitals_textbox_conversion.tpl', 28, false),array('function', 'xlt', 'vitals_textbox_conversion.tpl', 12, false),)), $this); ?>
<!-- USA row comes first -->
    <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_METRIC_ONLY']): ?>
    <tr class="hide">
    <?php else: ?>
    <tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_PERSIST_IN_METRIC']): ?>
        <td class="unfocus graph" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
    <?php else: ?>
        <td class="graph" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
    <?php endif; ?>
            <?php echo smarty_function_xlt(array('t' => $this->_tpl_vars['title']), $this);?>

        </td>
    <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_PERSIST_IN_METRIC']): ?>
        <td class="unfocus">
    <?php else: ?>
        <td>
    <?php endif; ?>
            <?php echo smarty_function_xlt(array('t' => $this->_tpl_vars['unit']), $this);?>

        </td>
    <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_PERSIST_IN_METRIC']): ?>
        <td class="valuesunfocus">
    <?php else: ?>
        <td class='currentvalues p-2'>
    <?php endif; ?>
            <input type="text" class="form-control" size='5' name='<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
' id='<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
_input'
                   value="<?php if ($this->_tpl_vars['vitals']->{(($_var=$this->_tpl_vars['vitalsValue']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}() != 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->{(($_var=$this->_tpl_vars['vitalsValue']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
<?php endif; ?>"
                   onChange="convUnit('usa', <?php echo ((is_array($_tmp=$this->_tpl_vars['unit'])) ? $this->_run_mod_handler('attr_js', true, $_tmp) : attr_js($_tmp)); ?>
, '<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
_input')" title='<?php echo ((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['vitalsValueUSAHelpTitle'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('xlt', true, $_tmp) : smarty_modifier_xlt($_tmp)); ?>
'/>
        </td>
    <td class="editonly">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_interpretation_selector.tpl', 'smarty_include_vars' => array('vitalDetails' => $this->_tpl_vars['vitals']->get_details_for_column($this->_tpl_vars['input']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_historical_values.tpl', 'smarty_include_vars' => array('useMetric' => false,'vitalsValue' => $this->_tpl_vars['vitalsValue'],'vitalsValueMetric' => $this->_tpl_vars['vitalsValueMetric'],'results' => $this->_tpl_vars['results'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </tr>

<!-- Metric row comes second -->
<?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_USA_ONLY']): ?>
    <tr class="hide">
<?php else: ?>
    <tr>
<?php endif; ?>
    <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_PERSIST_IN_USA']): ?>
        <td class="unfocus graph" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
_metric">
    <?php else: ?>
        <td class="graph" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
_metric">
    <?php endif; ?>
            <?php echo smarty_function_xlt(array('t' => $this->_tpl_vars['title']), $this);?>

        </td>
    <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_PERSIST_IN_USA']): ?>
        <td class="unfocus">
    <?php else: ?>
        <td>
    <?php endif; ?>
            <?php echo smarty_function_xlt(array('t' => $this->_tpl_vars['unitMetric']), $this);?>

    </td>
    <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_PERSIST_IN_USA']): ?>
        <td class="valuesunfocus">
    <?php else: ?>
        <td class='currentvalues p-2'>
    <?php endif; ?>
            <!-- Note we intentionally use vitalsValue not vitalValuesMetric because of how data is stored internally -->
            <input type="text" class="form-control" size='5' id='<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
_input_metric'
                   value="<?php if ($this->_tpl_vars['vitals']->{(($_var=$this->_tpl_vars['vitalsValue']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}() != 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['vitals']->{(($_var=$this->_tpl_vars['vitalsValueMetric']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
<?php endif; ?>"
                   onChange="convUnit('metric', <?php echo ((is_array($_tmp=$this->_tpl_vars['unit'])) ? $this->_run_mod_handler('attr_js', true, $_tmp) : attr_js($_tmp)); ?>
, '<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
_input')"/>
        </td>
        <td class="editonly">
            <?php if ($this->_tpl_vars['units_of_measurement'] == $this->_tpl_vars['MEASUREMENT_METRIC_ONLY']): ?>
                <!-- we only show the selector if this the only row being displayed -->
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_interpretation_selector.tpl', 'smarty_include_vars' => array('vitalDetails' => $this->_tpl_vars['vitals']->get_details_for_column($this->_tpl_vars['input']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
        </td>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vitals_historical_values.tpl', 'smarty_include_vars' => array('useMetric' => true,'vitalsValue' => $this->_tpl_vars['vitalsValue'],'vitalsValueMetric' => $this->_tpl_vars['vitalsValueMetric'],'results' => $this->_tpl_vars['results'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </tr>