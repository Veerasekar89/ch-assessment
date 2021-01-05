
<?php echo $this->extend('layouts/layout') ?> 

<?php echo $this->section('content') ?>
     <div class="container">
        <div class="row justify-content-center">
                <div class="text-center"><a href="<?php echo base_url('logout') ?>">Logout</a></div>
                <h3 class="text-center mb-4"><?php echo $title ?></h3>
                
                <table id="activity" class="display" style="width:100%">
                     <thead>
                        <tr>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>Source</th>
                        </tr>
                        <tbody>
                            <?php foreach ($histroy as $json):?>
                            <?php  $item = json_decode($json); ?> 
                                <tr>
                                    <td><?php echo $item->date  ?></td>
                                    <td><?php echo $item->activity  ?></td>
                                    <td><?php echo$item->Scource;  ?></td>
                                 </tr>
                            <?php endforeach;?>
                        </tbody>
                    </thead>
                </table>
             
        </div>
    </div>
<?php echo  $this->endSection() ?>