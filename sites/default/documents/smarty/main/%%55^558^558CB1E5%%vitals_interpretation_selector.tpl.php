<?php /* Smarty version 2.6.33, created on 2022-04-11 12:28:45
         compiled from vitals_interpretation_selector.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'attr', 'vitals_interpretation_selector.tpl', 1, false),array('modifier', 'xlt', 'vitals_interpretation_selector.tpl', 5, false),)), $this); ?>
<select name="interpretation[<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
]" class="form-control" id='interpretation_<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
'>
    <option value=""> </option>
    <?php $_from = $this->_tpl_vars['interpretation_options']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
        <?php if (isset ( $this->_tpl_vars['vitalDetails'] ) && $this->_tpl_vars['option']['id'] == $this->_tpl_vars['vitalDetails']->get_interpretation_option_id()): ?>
            <option selected="selected" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['option']['id'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['option']['title'])) ? $this->_run_mod_handler('xlt', true, $_tmp) : smarty_modifier_xlt($_tmp)); ?>
</option>
        <?php else: ?>
        <option <?php if ($this->_tpl_vars['option']['is_default']): ?>selected="selected"<?php endif; ?>value="<?php echo ((is_array($_tmp=$this->_tpl_vars['option']['id'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['option']['title'])) ? $this->_run_mod_handler('xlt', true, $_tmp) : smarty_modifier_xlt($_tmp)); ?>
</option>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
</select>