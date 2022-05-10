<?php /* Smarty version 2.6.33, created on 2022-04-11 12:28:45
         compiled from vitals_historical_values.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'vitals_historical_values.tpl', 7, false),array('modifier', 'text', 'vitals_historical_values.tpl', 7, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['results']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>
    <td class='historicalvalues'>
        <?php if ($this->_tpl_vars['useMetric']): ?>
            <!-- we use the original value since everything is converted from metric and we want to check for the value -->
            <?php if ($this->_tpl_vars['result']->{(($_var=$this->_tpl_vars['vitalsValue']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}() != 0): ?>
                <?php if (isset ( $this->_tpl_vars['vitalsStringFormat'] )): ?>
                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['result']->{(($_var=$this->_tpl_vars['vitalsValueMetric']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}())) ? $this->_run_mod_handler('string_format', true, $_tmp, $this->_tpl_vars['vitalsStringFormat']) : smarty_modifier_string_format($_tmp, $this->_tpl_vars['vitalsStringFormat'])))) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                <?php else: ?>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['result']->{(($_var=$this->_tpl_vars['vitalsValueMetric']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($this->_tpl_vars['result']->{(($_var=$this->_tpl_vars['vitalsValue']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}() != 0): ?>
                <?php if (isset ( $this->_tpl_vars['vitalsStringFormat'] )): ?>
                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['result']->{(($_var=$this->_tpl_vars['vitalsValue']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}())) ? $this->_run_mod_handler('string_format', true, $_tmp, $this->_tpl_vars['vitalsStringFormat']) : smarty_modifier_string_format($_tmp, $this->_tpl_vars['vitalsStringFormat'])))) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                <?php else: ?>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['result']->{(($_var=$this->_tpl_vars['vitalsValue']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

    </td>
<?php endforeach; endif; unset($_from); ?>