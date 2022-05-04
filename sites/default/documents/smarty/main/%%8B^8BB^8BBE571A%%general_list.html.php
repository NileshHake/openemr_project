<?php /* Smarty version 2.6.33, created on 2022-03-30 04:20:40
         compiled from /var/www/html/openemr/templates/practice_settings/general_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/openemr/templates/practice_settings/general_list.html', 4, false),array('function', 'headerTemplate', '/var/www/html/openemr/templates/practice_settings/general_list.html', 6, false),)), $this); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo smarty_function_xlt(array('t' => 'Practice Settings'), $this);?>
</title>

    <?php echo smarty_function_headerTemplate(array('assets' => 'common|datatables|datatables-colreorder|datatables-dt|datatables-bs'), $this);?>


    <script>
        <?php echo '
        $(function () {
            $(\'.sidebar-expand button\').on(\'click\', function () {
                $(this).toggleClass("flip-y");
                $(\'.nav-sidebar, .main-full\').toggleClass("active");
            });
        });
        '; ?>

    </script>
</head>
<body class="body-topnav">
  <div class="container-fluid pl-0">
    <nav class="nav navbar-light bg-light fixed-top top-before-sidebar">
        <div class="container-fluid py-2">
            <div class="sidebar-expand d-md-none">
                <button type="button" class="text-dark">
                    <i class="fa fa-angle-right fa-inverted"></i>
                </button>
            </div>
            <a class="navbar-brand" href="#"><?php echo smarty_function_xlt(array('t' => 'Practice Settings'), $this);?>
</a>
            <div id="practice-setting-nav">
            </div>
        </div>
    </nav>
      <nav class="nav-sidebar bg-light mt-3 mt-md-5 pt-5 pt-md-3">
          <div class="sidebar-content">
              <ul class="nav flex-column">
                  <li class="nav-item"><a class="nav-link text-body" href="<?php echo $this->_tpl_vars['TOP_ACTION']; ?>
pharmacy&action=list"><?php echo smarty_function_xlt(array('t' => 'Pharmacies'), $this);?>
</a></li>
                  <li class="nav-item"><a class="nav-link text-body" href="<?php echo $this->_tpl_vars['TOP_ACTION']; ?>
insurance_company&action=list"><?php echo smarty_function_xlt(array('t' => 'Insurance Companies'), $this);?>
</a></li>
                  <li class="nav-item"><a class="nav-link text-body" href="<?php echo $this->_tpl_vars['TOP_ACTION']; ?>
insurance_numbers&action=list"><?php echo smarty_function_xlt(array('t' => 'Insurance Numbers'), $this);?>
</a></li>
                  <li class="nav-item"><a class="nav-link text-body" href="<?php echo $this->_tpl_vars['TOP_ACTION']; ?>
x12_partner&action=list"><?php echo smarty_function_xlt(array('t' => 'X12 Partners'), $this);?>
</a></li>
                  <li class="nav-item"><a class="nav-link text-body" href="<?php echo $this->_tpl_vars['TOP_ACTION']; ?>
document_category&action=list"><?php echo smarty_function_xlt(array('t' => 'Document Categories'), $this);?>
</a></li>
                  <li class="nav-item"><a class="nav-link text-body" href="<?php echo $this->_tpl_vars['TOP_ACTION']; ?>
hl7&action=default"><?php echo smarty_function_xlt(array('t' => 'HL7 Viewer'), $this);?>
</a></li>
              </ul>
          </div>
      </nav>
      <main class="main-full">
        <div class="pl-3 pt-5 pt-md-3">
            <div class="section-header">
                <h2><?php echo $this->_tpl_vars['ACTION_NAME']; ?>
</h2>
            </div>
            <div>
                <?php echo $this->_tpl_vars['display']; ?>

            </div>
        </div>
      </main>
  </div>
</body>
<script>
    <?php echo '
    $(document).ready(function(){
        $(\'#pharmacies\').dataTable({

        });
    });
    '; ?>

</script>
</html>