<h1>Create an Account</h1>

<?php $form = \App\Form\Form::begin('', 'post') ?>

<?php echo $form->field($model, 'name') ?>
<?php echo $form->field($model, 'email')->setEmail() ?>
<?php echo $form->field($model, 'password')->setPassword() ?>
<?php echo $form->field($model, 'confirm_password')->setPassword() ?>
<button type="submit" class="btn btn-primary">Submit</button>



<?php \App\Form\Form::end() ?>