<?php /* Smarty version 2.6.33, created on 2022-03-30 04:20:43
         compiled from /var/www/html/openemr/templates/x12_partners/general_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/openemr/templates/x12_partners/general_list.html', 2, false),array('modifier', 'attr', '/var/www/html/openemr/templates/x12_partners/general_list.html', 19, false),array('modifier', 'text', '/var/www/html/openemr/templates/x12_partners/general_list.html', 20, false),)), $this); ?>
<a href="<?php echo $this->_tpl_vars['CURRENT_ACTION']; ?>
action=edit&id=default" onclick="top.restoreSession()" class="btn btn-secondary btn-add">
    <?php echo smarty_function_xlt(array('t' => 'Add New Partner'), $this);?>

</a>
<br /><br />
<div class="table-responsive">
  <table class="table table-striped">
      <thead>
      <tr>
          <th><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</th>
          <th><?php echo smarty_function_xlt(array('t' => 'Submitter Name (If applicable)'), $this);?>
</th>
          <th><?php echo smarty_function_xlt(array('t' => 'Sender ID'), $this);?>
</th>
          <th><?php echo smarty_function_xlt(array('t' => 'Receiver ID'), $this);?>
</th>
          <th><?php echo smarty_function_xlt(array('t' => 'Version'), $this);?>
</th>
      </tr>
      </thead>
      <?php $_from = $this->_tpl_vars['partners']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['partner']):
?>
      <tr>
          <td>
              <a href="<?php echo $this->_tpl_vars['CURRENT_ACTION']; ?>
action=edit&x12_partner_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onclick="top.restoreSession()">
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_name())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;
              </a>
          </td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_submitter_name())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sender_id())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_receiver_id())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_version())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
      </tr>
      <?php endforeach; else: ?>
      <tr>
          <td colspan="4"><?php echo smarty_function_xlt(array('t' => 'No Partners Found'), $this);?>
</td>
      </tr>
      <?php endif; unset($_from); ?>
  </table>
</div>