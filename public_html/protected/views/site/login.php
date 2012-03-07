<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

			<div class="inner">
				<img src="/themes/cashadmin/images/login_logo.png" alt="logo"/>
				<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
					<p>
						<input name="LoginForm[username]" id="LoginForm_username" type="text" style="width:285px" title="Username" />
						<?php echo $form->error($model,'username'); ?>
					<br />
						<input name="LoginForm[password]" id="LoginForm_password" type="password" style="width:285px" title="Username" />
						<?php echo $form->error($model,'password'); ?>
					<br /><br />
						<?php echo CHtml::submitButton('Login'); ?>
					</p>
					<?php $this->endWidget(); ?>
			</div>

