<?php $this->load->view('backend/template/header'); ?>
   
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box blue-bg">
            <i class="fa fa-cloud-download"></i>
            <div class="count">6.674</div>
            <div class="title">Download</div>						
        </div><!--/.info-box-->			
    </div><!--/.col-->

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box brown-bg">
            <i class="fa fa-shopping-cart"></i>
            <div class="count">7.538</div>
            <div class="title">Purchased</div>						
        </div><!--/.info-box-->			
    </div><!--/.col-->	

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box dark-bg">
            <i class="fa fa-thumbs-o-up"></i>
            <div class="count">4.362</div>
            <div class="title">Order</div>						
        </div><!--/.info-box-->			
    </div><!--/.col-->

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="info-box green-bg">
            <i class="fa fa-cubes"></i>
            <div class="count">1.426</div>
            <div class="title">Stock</div>						
        </div><!--/.info-box-->			
    </div><!--/.col-->
</div><!--/.row-->
<!-- Today status end -->

<div class="row">
    <div class="col-lg-9 col-md-12">	
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class="fa fa-flag-o red"></i><strong>Registered Users</strong></h2>
                <div class="panel-actions">
                   <a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                   <a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                   <a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table bootstrap-datatable countries">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Country</th>
                            <th>Users</th>
                            <th>Online</th>
                            <th>Performance</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <tr>
                            <td><img src="<?php echo base_url(); ?>resources/img/Germany.png" style="height:18px; margin-top:-2px;"></td>
                            <td>Germany</td>
                            <td>2563</td>
                            <td>1025</td>
                            <td>
                                <div class="progress thin">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%"></div>
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%"></div>
                                </div>
                                <span class="sr-only">73%</span>   	
                            </td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo base_url(); ?>resources/img/India.png" style="height:18px; margin-top:-2px;"></td>
                            <td>India</td>
                            <td>3652</td>
                            <td>2563</td>
                            <td>
                                <div class="progress thin">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%"></div>
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 43%"></div>
                                </div>
                                <span class="sr-only">57%</span>   	
                            </td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo base_url(); ?>resources/img/Spain.png" style="height:18px; margin-top:-2px;"></td>
                            <td>Spain</td>
                            <td>562</td>
                            <td>452</td>
                            <td>
                                <div class="progress thin">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%"></div>
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100" style="width: 7%"></div>
                                </div>
                                <span class="sr-only">93%</span>   	
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>	
    </div><!--/col-->
</div>
<!-- statics end -->

<!-- project team & activity start -->
<div class="row">
  <div class="col-lg-9">
      <!--Project Activity start-->
      <section class="panel">
          <div class="panel-body progress-panel">
            <div class="row">
              <div class="col-lg-8 task-progress pull-left">
                  <h1>To Do Everyday</h1>                                  
              </div>
              <div class="col-lg-4">
                <span class="profile-ava pull-right">
                    <img alt="" class="simple" src="<?php echo base_url(); ?>resources/img/avatar1_small.jpg">
                    Jenifer smith
                </span>                                
            </div>
        </div>
    </div>
    <table class="table table-hover personal-task">
      <tbody>
          <tr>
              <td>Today</td>
              <td>
                  web design
              </td>
              <td>
                  <span class="badge bg-important">Upload</span>
              </td>
              <td>
                <span class="profile-ava">
                    <img alt="" class="simple" src="<?php echo base_url(); ?>resources/img/avatar1_small.jpg">
                </span>
            </td>
        </tr>
        <tr>
          <td>Yesterday</td>
          <td>
              Project Design Task
          </td>
          <td>
              <span class="badge bg-success">Task</span>
          </td>
          <td>
              <div id="work-progress2"></div>
          </td>
      </tr>
      <tr>
          <td>21-10-14</td>
          <td>
              Generate Invoice
          </td>
          <td>
              <span class="badge bg-success">Task</span>
          </td>
          <td>
              <div id="work-progress3"></div>
          </td>
      </tr>                              
      <tr>
          <td>22-10-14</td>
          <td>
              Project Testing
          </td>
          <td>
              <span class="badge bg-primary">To-Do</span>
          </td>
          <td>
              <span class="profile-ava">
                <img alt="" class="simple" src="<?php echo base_url(); ?>resources/img/avatar1_small.jpg">
            </span>
        </td>
    </tr>
    <tr>
      <td>24-10-14</td>
      <td>
          Project Release Date
      </td>
      <td>
          <span class="badge bg-info">Milestone</span>
      </td>
      <td>
          <div id="work-progress4"></div>
      </td>
  </tr>                              
  <tr>
      <td>28-10-14</td>
      <td>
          Project Release Date
      </td>
      <td>
          <span class="badge bg-primary">To-Do</span>
      </td>
      <td>
          <div id="work-progress5"></div>
      </td>
  </tr>
  <tr>
      <td>Last week</td>
      <td>
          Project Release Date
      </td>
      <td>
          <span class="badge bg-primary">To-Do</span>
      </td>
      <td>
          <div id="work-progress1"></div>
      </td>
  </tr>
  <tr>
      <td>last month</td>
      <td>
          Project Release Date
      </td>
      <td>
          <span class="badge bg-success">To-Do</span>
      </td>
      <td>
          <span class="profile-ava">
            <img alt="" class="simple" src="<?php echo base_url(); ?>resources/img/avatar1_small.jpg">
        </span>
    </td>
</tr>
</tbody>
</table>
</section>
<!--Project Activity end-->
</div>
</div><br><br>
<?php $this->load->view('backend/template/footer'); ?>


