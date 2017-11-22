 <body class="">

     <?php
         foreach($ownAdminAccount as $updateAdmin) { }
     ?>
    <header class="a-event-header sticky-top">
      <div class="header-content">
        <p class="text-center"><img class="sys-logo" src=<?php echo base_url('assets/jcAssets/pics/main-logo-prime.png')?> alt="Event system logo"></p>
      </div>
    </header>

    <div class="a-main-content">

      <aside class="admin-sidebar-wrapper">

        <ul class="admin-leftsidenav">
          <div class="upper-sbar">
            <li class="a-user-details">
              <div class="row">
                <div class="col-sm-4">
                  <img id="user-pic" src=<?php echo base_url('assets/jcAssets/pics/user-2.png')?> alt="User picture">
                </div>
                <div class="col-sm-8 d-none d-sm-none d-md-block" >
                  <h1><?php echo $updateAdmin->first_name; ?></h1>
                  <p class="user-role">Administrator</p>
                </div>
              </div>
            </li>
          </div>

          <div class="lower-sbar">

            <li ><a href="<?php echo site_url();?>/admin/cAdmin">
              <p>
               <div class="d-block d-sm-block d-md-none">
                  <center> <i class="fa fa-list-alt" aria-hidden="true"></i> </center>
                </div>
               <span class= "d-none d-sm-none d-md-inline">
                  <i class="fa fa-list-alt" aria-hidden="true"></i>
                  Events
                </span>
              </a></li></p>
            <li ><a href="<?php echo site_url();?>/admin/cAdmin/viewUserAccountMgt">
              <p>
                <div class="d-block d-sm-block d-md-none">
                  <center> <i class="fa fa-calendar" aria-hidden="true"></i> </center>
                </div>
                <span class="d-none d-sm-none d-md-inline">  <i class="fa fa-calendar" aria-hidden="true"></i> User Account </span>
              </a></li></p>
            <li class="active-li"><a href="<?php echo site_url();?>/admin/cAdmin/viewAdminAccountMgt">
              <p>
                <div class="d-block d-sm-block d-md-none">
                  <center><i class="fa fa-user-secret" aria-hidden="true"></i> </center>
                </div>
                <span class="d-none d-sm-none d-md-inline"> <i class="fa fa-user-secret" aria-hidden="true"></i> Admin Account </span>
              </a></li></p>
            <li><a href="<?php echo site_url();?>/admin/cAdmin/viewFinance">
              <p>
                <div class="d-block d-sm-block d-md-none">
                  <center><i class="fa fa-line-chart" aria-hidden="true"></i></center>
                </div>
                <span class="d-none d-sm-none d-md-inline"> <i class="fa fa-line-chart" aria-hidden="true"></i> Finance</span>
              </a></li></p>
            <li><a href="<?php echo site_url();?>/admin/cAdmin/viewReport">
              <p>
                <div class="d-block d-sm-block d-md-none">
                  <center><i class="fa fa-envelope-open" aria-hidden="true"></i></center>
                </div>
                <span class="d-none d-sm-none d-md-inline"> <i class="fa fa-envelope-open" aria-hidden="true"></i> Report</span>
              </a></li></p>
              <li ><a href ="<?php echo site_url();?>/admin/cAdmin/generateCard" data-wow-delay="0.1s">
              <p>
                <div class="d-block d-sm-block d-md-none">
                  <center><i class="fa fa-credit-card" aria-hidden="true"></i></center>
                </div>
                <span class="d-none d-sm-none d-md-inline"><i class="fa fa-credit-card" aria-hidden="true"></i> Cards</span>
              </a></li></p>
            <li><a href ="<?php echo site_url();?>/cLogin/userLogout" data-wow-delay="0.1s">
              <p>
                <div class="d-block d-sm-block d-md-none">
                  <center><i class="fa fa-sign-out" aria-hidden="true"></i></center>
                </div>
                <span class="d-none d-sm-none d-md-inline"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</span>
              </a></li></p>
          </div>
        </ul>

      </aside>

      <div class="admin-main container">
        <div class="admin-wrapper">
          <div class="row justify-content-end">
            <div class="col-10">
              <h3><center>Admin Management<center></h3>
              <button class="btn btn-outline-primary" style="margin-bottom:25px;" type="button" name="button" data-toggle="modal" data-target="#addAdmin">Add Admin</button>
              <button class="btn btn-outline-primary" style="margin-bottom:25px;" type="button" name="button" data-toggle="modal" data-target="#updateAccount">Update Account</button>
              <table class="table table-hover table-responsive table-sm">
                <thead class="">
                    <tr>
                      <th>#</th>
                      <th>User Name</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Birthdate</th>
                      <th>Gender</th>
                      <th>Contact Number</th>
                      <th>Date Created</th>
                      <th>Type</th>
                      <th>Status</th>
                      <?php
                     if($this->session->userdata['userSession']->userLevel == 'Superadmin'){
                         echo"<th>Action</th>";
                       }
                     ?>
                    </tr>
                </thead>

                  <tbody>
                    <?php
                                if($admin!=FALSE){
                                  foreach ($admin as $object) {
                          $num = ($object->contact_no != NULL)? $object->contact_no : "N/A";
                          $date = date("m-d-Y", strtotime($object->birthdate));
                          echo  "<tr>
                                              <td id='accountId'>".$object->account_id."</td>
                                              <td>".$object->user_name."</td>
                                              <td>".$object->first_name." ".$object->middle_initial." ".$object->last_name."</td>
                                              <td>".$object->email."</td>
                                <td>".$date."</td>
                                <td>".$object->gender."</td>
                                <td>".$num."</td>
                                <td>".$object->date_account_created."</td>
                                <td>".$object->user_type."</td>
                                <td>".$object->user_status."</td>";

                                if($this->session->userdata['userSession']->userLevel == "Superadmin" && $object->user_status != "Deleted"){
                                  echo"<td>";
                                if ($this->session->userdata['userSession']->userID != $object->account_id){
                                  if($object->user_type == "Admin"){
                                    echo "<a  href='".site_url()."/admin/cAdmin/SuperAdmin/".$object->account_id."'>
                                      <button  type='button' class='btn btn-warning'>Update Type</button></a>";
                                  }else{
                                      if($this->session->userdata['userSession']->userID == $object->upgraded_by){
                                            echo "<a  href='".site_url()."/admin/cAdmin/Admin/".$object->account_id."'>
                                             <button  type='button' class='btn btn-warning'>Update Type</button></a>";

                                             echo "<a  href='".site_url()."/admin/cAdmin/Delete/".$object->account_id."/admin'>
                                               <button  type='button' class='btn btn-danger'>Delete Account</button></a>";
                                        }
                                  }

                                  if($this->session->userdata['userSession']->userSuperior != $object->account_id && $this->session->userdata['userSession']->userSuperior != $object->upgraded_by || $object->user_type == "Admin"){
                                      if($object->user_status == "Active"){
                                        echo "<a  href='".site_url()."/admin/cAdmin/Ban/".$object->account_id."/admin'>
                                          <button  type='button' class='btn btn-primary'>Update Status</button></a>";
                                      }else{
                                        echo "<a  href='".site_url()."/admin/cAdmin/Unban/".$object->account_id."/admin'>
                                          <button  type='button' class='btn btn-primary'>Update Status</button></a>";
                                      }
                                  }
                                  if($object->user_type == "Admin"){
                                      echo "<a  href='".site_url()."/admin/cAdmin/Delete/".$object->account_id."/admin'>
                                        <button  type='button' class='btn btn-danger'>Delete Account</button></a>";
                                  }
                                }else{
                                  //echo "Can't ban yourself.";
                                  echo "<a  href='".site_url()."/admin/cAdmin/Delete/".$object->account_id."/admin'>
                                    <button  type='button' class='btn btn-danger'>Delete Account</button></a>";
                                }
                                echo "</td></tr>";
                            }
                        }
                                }
                              ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>

      </div>

    </div>

    <footer class="a-event-footer">

    </footer>

    <div class="content">
			<!-- Modal -->
			<div id="addAdmin" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">

					<!-- Modal content-->
					<form class="form-horizontal" method="POST" action="<?php echo site_url()?>/admin/cAdmin/addAdmin">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" style="color:#ffffff;">&times;</button>
								<h4 class="modal-title">Add Administrator</h4>
							</div>

							<div class="modal-body form-horizontal ">

                <div class="form-group" >
                	<label for="" class="col-8 control-label">First name:</label>
                	<div class="col-8">
                		<input class="form-control" pattern="[a-zA-Z]+"  type="text" name="fname" required="">
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Middle Initial:</label>
                	<div class="col-8">
                		<input class="form-control" pattern="[a-zA-Z]+"  type="text" name="miname" required="">
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Last name:</label>
                	<div class="col-8">
                		<input class="form-control" pattern="[a-zA-Z]+"  type="text" name="lname" required="">
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Email:</label>
                	<div class="col-8">
                		<input class="form-control" type="text" name="email" required="">
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Birthdate:</label>
                	<div class="col-8">
                		<input class="form-control" type="date" name="bdate" required="">
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Gender:</label>
                	<div class="col-8">
                  <select class="form-control" name="gender" required=""> <br>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">User type:</label>
                	<div class="col-8">
                  <select class="form-control" name="userType" required=""> <br>
                    <option value="Admin">Admin</option>
                    <option value="Superadmin">Super Admin</option>
                  </select>
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Contact no:</label>
                	<div class="col-8">
                		<input class="form-control" pattern="^(09)\d{9}$"  type="text"  name="contact" required="">
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Username:</label>
                	<div class="col-8">
                		<input class="form-control" type="text" minlength="6" pattern="[a-zA-Z0-9]+" name="uname" required="">
                	</div>
                </div>

                <div class="form-group" >
                	<label for="" class="col-8 control-label">Password:</label>
                	<div class="col-8">
                		<input class="form-control" minlength="8" pattern="[a-zA-Z0-9]+" type="password" name="password" required="">
                	</div>
                </div>

							</div>

							<div class="modal-footer">
                <button id="closeEditAccount" type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
                <input id="" class="btn btn-primary" type="submit"  name="action" value="Add">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

        <div class="content">
          <!-- Modal -->
          <div id="updateAccount" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

              <!-- Modal content-->
              <form class="form-horizontal" method="POST" action="<?php echo site_url()?>/admin/cAdmin/updateAdmin">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="color:#ffffff;">&times;</button>
                    <h4 class="modal-title">Update Account: <span style="font-size: 18px;"><?php echo $updateAdmin->user_type;?></span></h4>
                    <input class="form-control" type="text" name="uuserType" required="" value="<?php echo $updateAdmin->user_type; ?>" hidden>
                  </div>

                  <div class="modal-body form-horizontal ">

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">First name:</label>
                      <div class="col-8">
                        <input class="form-control" type="text" name="ufname" required="" value="<?php echo $updateAdmin->first_name; ?>">
                      </div>
                    </div>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Middle Initial:</label>
                      <div class="col-8">
                        <input class="form-control" type="text" name="uminame" required="" value="<?php echo $updateAdmin->middle_initial; ?>">
                      </div>
                    </div>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Last name:</label>
                      <div class="col-8">
                        <input class="form-control" type="text" name="ulname" required="" value="<?php echo $updateAdmin->last_name; ?>">
                      </div>
                    </div>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Email:</label>
                      <div class="col-8">
                        <input class="form-control" type="text" name="uemail" required="" value="<?php echo $updateAdmin->email; ?>">
                      </div>
                    </div>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Birthdate:</label>
                      <div class="col-8">
                        <input class="form-control" type="date" name="ubdate" required="" value="<?php echo $updateAdmin->birthdate; ?>">
                      </div>
                    </div>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Gender:</label>
                      <div class="col-8">
                      <select class="form-control" name="ugender" required=""> <br>
                        <option value="Male" <?php if($updateAdmin->gender=='Male') {echo "selected=''";}?> >Male</option>
                        <option value="Female" <?php if($updateAdmin->gender=='Female') {echo "selected=''";}?>>Female</option>
                        <option value="Other" <?php if($updateAdmin->gender=='Other') {echo "selected=''";}?>>Other</option>
                      </select>
                      </div>
                    </div>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Contact no:</label>
                      <div class="col-8">
                        <input class="form-control" type="number" min="11" name="ucontact" required="" value="<?php echo $updateAdmin->contact_no; ?>">
                      </div>
                    </div>

                    <br><br>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Username:</label>
                      <div class="col-8">
                        <input class="form-control" type="text" name="uuname" required="" value="<?php echo $updateAdmin->user_name; ?>">
                      </div>
                    </div>

                    <div class="form-group" >
                      <label for="" class="col-8 control-label">Password:</label>
                      <div class="col-8">
                        <input class="form-control" type="password" name="upassword" required="" value="<?php echo $updateAdmin->password; ?>">
                      </div>
                    </div>

                  </div>

                  <div class="modal-footer">
                    <button id="closeEditAccount" type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
                    <input id="" class="btn btn-primary" type="submit"  name="action" value="Update">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

  </body>
</html>
