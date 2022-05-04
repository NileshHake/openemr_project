<?php /* Smarty version 2.6.33, created on 2022-04-11 12:28:45
         compiled from vitals_notes.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'attr', 'vitals_notes.tpl', 6, false),array('modifier', 'xlt', 'vitals_notes.tpl', 6, false),array('modifier', 'text', 'vitals_notes.tpl', 10, false),array('function', 'xlt', 'vitals_notes.tpl', 7, false),)), $this); ?>
<?php if (isset ( $this->_tpl_vars['hide'] ) && $this->_tpl_vars['hide']): ?>
<tr class="hide">
<?php else: ?>
<tr>
<?php endif; ?>
    <td class="graph" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('xlt', true, $_tmp) : smarty_modifier_xlt($_tmp)); ?>
</td>
    <td><?php echo smarty_function_xlt(array('t' => $this->_tpl_vars['unit']), $this);?>
</td>

    <td class='currentvalues p-2'>
        <textarea class="form-control" name='<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
' id='<?php echo ((is_array($_tmp=$this->_tpl_vars['input'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
_input'><?php if ($this->_tpl_vars['vitalsValue'] != 0): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['vitalsValue'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php endif; ?></textarea>
    </td>
    <td class="editonly">
    </td>
    <?php $_from = $this->_tpl_vars['results']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>
        <td  class='historicalvalues'>
            <?php if ($this->_tpl_vars['result']->get_note() != 0): ?>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['result']->get_note())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

            <?php endif; ?>
        </td>
    <?php endforeach; endif; unset($_from); ?>
</tr>