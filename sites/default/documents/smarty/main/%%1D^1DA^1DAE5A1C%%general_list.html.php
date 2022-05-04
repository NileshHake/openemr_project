<?php /* Smarty version 2.6.33, created on 2022-03-30 07:19:23
         compiled from /var/www/html/openemr/templates/insurance_companies/general_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/openemr/templates/insurance_companies/general_list.html', 3, false),array('modifier', 'attr_url', '/var/www/html/openemr/templates/insurance_companies/general_list.html', 23, false),array('modifier', 'text', '/var/www/html/openemr/templates/insurance_companies/general_list.html', 24, false),array('modifier', 'upper', '/var/www/html/openemr/templates/insurance_companies/general_list.html', 28, false),)), $this); ?>
<a href="<?php echo $this->_tpl_vars['CURRENT_ACTION']; ?>
action=edit" onclick="top.restoreSession()"
   class="btn btn-secondary btn-add">
    <?php echo smarty_function_xlt(array('t' => 'Add a Company'), $this);?>
</a>
    <br /><br />
<div class="table-responsive">
  <table class="table table-striped">
      <thead>
          <tr>
              <th><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</th>
              <th><?php echo smarty_function_xlt(array('t' => 'Address'), $this);?>
</th>
              <th><?php echo smarty_function_xlt(array('t' => 'City, State, ZIP'), $this);?>
</th>
              <th><?php echo smarty_function_xlt(array('t' => 'Phone'), $this);?>
</th>
              <th><?php echo smarty_function_xlt(array('t' => 'Fax'), $this);?>
</th>
              <th><?php echo smarty_function_xlt(array('t' => 'Payer ID'), $this);?>
</th>
              <th><?php echo smarty_function_xlt(array('t' => 'Default X12 Partner'), $this);?>
</th>
              <th><?php echo smarty_function_xlt(array('t' => 'Deactivated'), $this);?>
</th>
          </tr>
      </thead>
      <tbody>
          <?php $_from = $this->_tpl_vars['icompanies']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['insurancecompany']):
?>
          <tr>
              <td>
                  <a href="<?php echo $this->_tpl_vars['CURRENT_ACTION']; ?>
action=edit&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->id)) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
" onclick="top.restoreSession()">
                      <?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->name)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                  </a>
              </td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->line1)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->line2)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->city)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->state)) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)))) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->zip)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_phone())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_fax())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->cms_id)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
              <td><?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_x12_default_partner_name())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
              <td><?php if ($this->_tpl_vars['insurancecompany']->get_inactive() == 1): ?><?php echo smarty_function_xlt(array('t' => 'Yes'), $this);?>
<?php endif; ?>&nbsp;</td>
          </tr>
          <?php endforeach; else: ?>
          <tr>
              <td colspan="8"><?php echo smarty_function_xlt(array('t' => 'No Insurance Companies Found'), $this);?>
</td>
          </tr>
          <?php endif; unset($_from); ?>
      </tbody>
  </table>
</div>