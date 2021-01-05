
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
                        <form  method="post" name="register" id="register">
                            <?php echo csrf_field() ?>
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control"  value="<?= set_value('name') ?>" >
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" id="email" class="form-control"  value="<?= set_value('email') ?>" >
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="c_password" class="form-label">Confirm Password</label>
                                <input type="password" name="c_password" id="c_password" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="radio">
                                    <label><input type="radio" name="gender" value="Male" > Male</label>
                                    <label><input type="radio" name="gender" value="Female"> Female</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center"><a href="<?php echo base_url('user') ?>">Sign In</a></div>
            </div>
             
        </div>
    </div>
     
<?php echo  $this->endSection() ?>