<?php /* Smarty version 2.6.14, created on 2012-02-14 16:24:35
         compiled from search/results.tpl */ ?>
<h1>Claimant Search</h1>

<ul>
	<?php $_from = $this->_tpl_vars['claimants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claimant']):
?>
	<li><a href="/claimantdata/view/id/<?php echo $this->_tpl_vars['claimant']['assignedID']; ?>
/"><?php echo $this->_tpl_vars['claimant']['forename']; ?>
 <?php echo $this->_tpl_vars['claimant']['surname']; ?>
</a><br /><i style="color: #AAA"> <?php echo $this->_tpl_vars['claimant']['address1']; ?>
 <?php echo $this->_tpl_vars['claimant']['address2']; ?>
 <?php echo $this->_tpl_vars['claimant']['address3']; ?>
 <?php echo $this->_tpl_vars['claimant']['town']; ?>
 <?php echo $this->_tpl_vars['claimant']['county']; ?>
 - <?php echo $this->_tpl_vars['claimant']['telephone']; ?>
 <?php echo $this->_tpl_vars['claimant']['mobile']; ?>
</i></li>
	<?php endforeach; endif; unset($_from); ?>
</ul>