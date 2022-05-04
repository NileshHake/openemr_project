<?php /* Smarty version 2.6.33, created on 2022-03-30 07:19:25
         compiled from /var/www/html/openemr/templates/document_categories/general_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlj', '/var/www/html/openemr/templates/document_categories/general_list.html', 17, false),array('function', 'xlt', '/var/www/html/openemr/templates/document_categories/general_list.html', 23, false),array('modifier', 'text', '/var/www/html/openemr/templates/document_categories/general_list.html', 34, false),array('modifier', 'attr', '/var/www/html/openemr/templates/document_categories/general_list.html', 41, false),)), $this); ?>
<?php echo '
 <style>
<!--
.treeMenuDefault {
	font-style: italic;
}

.treeMenuBold {
	font-style: italic;
	font-weight: bold;
}

-->
</style>
'; ?>

<script>
var deleteLabel=<?php echo smarty_function_xlj(array('t' => 'Delete'), $this);?>
;
var editLabel=<?php echo smarty_function_xlj(array('t' => 'Edit'), $this);?>
;
</script>
<script src="<?php echo $this->_tpl_vars['GLOBALS']['webroot']; ?>
/library/js/CategoryTreeMenu.js?v=<?php echo $this->_tpl_vars['V_JS_INCLUDES']; ?>
"></script>
<table>
	<tr>
		<td height="20" valign="top"><?php echo smarty_function_xlt(array('t' => 'Document Categories'), $this);?>
</td>
	</tr>
	<tr>
		<td valign="top"><?php echo $this->_tpl_vars['tree_html']; ?>
</td>
		<?php if (isset ( $this->_tpl_vars['message'] )): ?>
		<td valign="top"><?php echo $this->_tpl_vars['message']; ?>
</td>
		<?php endif; ?>
		<?php if (( isset ( $this->_tpl_vars['add_node'] ) && $this->_tpl_vars['add_node'] == true ) || ( isset ( $this->_tpl_vars['edit_node'] ) && $this->_tpl_vars['edit_node'] == true )): ?>
		<td width="25"></td>
		<td valign="top">
    <?php if (isset ( $this->_tpl_vars['add_node'] ) && $this->_tpl_vars['add_node'] == true): ?>
		<?php echo smarty_function_xlt(array('t' => "This new category will be a sub-category of "), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['parent_name'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<br />
		<?php endif; ?>
		<form method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
" onsubmit="return top.restoreSession()">

    <table>
      <tr>
        <td><?php echo smarty_function_xlt(array('t' => 'Category Name'), $this);?>
&nbsp;</td>
        <td><input type="text" name="name" value="<?php if (isset ( $this->_tpl_vars['NAME'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['NAME'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
<?php endif; ?>" onKeyDown="PreventIt(event)" /></td>
      </tr>
      <tr>
        <td><?php echo smarty_function_xlt(array('t' => 'Value'), $this);?>
&nbsp;</td>
		    <td><input type="text" name="value" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['VALUE'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" ></td>
      </tr>
      <tr>
        <td><?php echo smarty_function_xlt(array('t' => 'Access Control'), $this);?>
&nbsp;</td>
		    <td><select name="aco_spec"><?php echo $this->_tpl_vars['ACO_OPTIONS']; ?>
</select></td>
      </tr>
    </table>
    &nbsp;<br />

		<button type="submit" name="Add Category" class="btn btn-secondary btn-save"><?php echo smarty_function_xlt(array('t' => 'Save Category'), $this);?>
</button>
		<input type="hidden" name="parent_is" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['parent_is'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
		<input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
		</form>
		</td>
		<?php endif; ?>
	</tr>

</table>