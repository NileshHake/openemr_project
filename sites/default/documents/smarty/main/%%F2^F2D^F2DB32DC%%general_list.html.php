<?php /* Smarty version 2.6.33, created on 2022-04-01 10:09:34
         compiled from /var/www/html/openemr/templates/insurance_numbers/general_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/openemr/templates/insurance_numbers/general_list.html', 5, false),array('modifier', 'attr_url', '/var/www/html/openemr/templates/insurance_numbers/general_list.html', 16, false),array('modifier', 'text', '/var/www/html/openemr/templates/insurance_numbers/general_list.html', 17, false),)), $this); ?>
<div class="table-responsive">
  <table class="table table-striped">
      <thead>
      <tr>
          <th><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</th>
          <th>&nbsp;</th>
          <th><?php echo smarty_function_xlt(array('t' => 'Provider'), $this);?>
 #</th>
          <th><?php echo smarty_function_xlt(array('t' => 'Rendering'), $this);?>
 #</th>
          <th><?php echo smarty_function_xlt(array('t' => 'Group'), $this);?>
 #</th>
      </tr>
      </thead>
      <tbody>
      <?php $_from = $this->_tpl_vars['providers']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['provider']):
?>
      <tr>
          <td>
              <a href="<?php echo $this->_tpl_vars['CURRENT_ACTION']; ?>
action=edit&id=default&provider_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['provider']->id)) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
" onclick="top.restoreSession()">
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['provider']->get_name_display())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

              </a>
          </td>
          <td><?php echo smarty_function_xlt(array('t' => 'Default'), $this);?>
&nbsp;</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['provider']->get_provider_number_default())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['provider']->get_rendering_provider_number_default())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
          <td><?php echo ((is_array($_tmp=$this->_tpl_vars['provider']->get_group_number_default())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
      </tr>
      <?php endforeach; else: ?>
      <tr>
          <td><?php echo smarty_function_xlt(array('t' => 'No Providers Found'), $this);?>
</td>
      </tr>
      <?php endif; unset($_from); ?>
      </tbody>
  </table>
</div>