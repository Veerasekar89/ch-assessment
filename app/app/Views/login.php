
<?php echo $this->extend('layouts/layout') ?> 

<?php echo $this->section('content') ?>
     <div class="container">
        <div class="row justify-content-center">
            
             <div class="col-6">
                <h3 class="text-center mb-4"><?php echo $title ?></h3>
                <div class="card">
                    <div class="card-body">
                        <?php if(isset($validation)):?>
                            <div class="alert alert-danger"><?php echo $validation->listErrors() ?></div>
                        <?php endif;?>
                        <?php if(isset($validation_msg)):?>
                            <div class="alert alert-danger"><?php echo $validation_msg ?></div>
                        <?php endif;?>
                        <form  method="post" name="login" id="login">
                             <?php echo csrf_field() ?>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"  value="<?= set_value('email') ?>" >
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center"><a href="<?php echo base_url('user/register') ?>">Register</a></div>
            </div>
             
        </div>
    </div>
<?php echo  $this->endSection() ?>