		<?php
			$chkserial = mysqli_query($conn,"select * from `nirvahaka_shonu` where `unohs`='".$_SESSION['unohs']."'");
			$salu = mysqli_fetch_array($chkserial);
			$dashboard = $salu['dashboard'];
			$wingomanager = $salu['wingomanager'];
			$k3manager = $salu['k3manager'];
			$d5manager = $salu['5dmanager'];
			$finance = $salu['finance'];
			$managegame = $salu['managegame'];
            $support = $salu['support'];
		?>
		<ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="https://t.me/sikkim7king/">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Service Centre</span>
            </a>
          </li>
		  <?php
			if($wingomanager == 1){
		  ?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">WinGo Manager</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="wingo10min.php">WinGo 30 sec</a></li>
                <li class="nav-item"> <a class="nav-link" href="wingo1min.php">WinGo 1 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="wingo3min.php">WinGo 3 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="wingo5min.php">WinGo 5 Min</a></li>
              </ul>
            </div>
          </li>
		  <?php
			}
			if($k3manager == 1){
		  ?>
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-1" aria-expanded="false" aria-controls="ui-basic-1">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">K3 Manager</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="k31min.php">K3 1 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="k33min.php">K3 3 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="k35min.php">K3 5 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="k310min.php">K3 10 Min</a></li>
              </ul>
            </div>
          </li>
		  <?php
			}
			if($d5manager == 1){
		  ?>
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-2" aria-expanded="false" aria-controls="ui-basic-2">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">5D Manager</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="5d1min.php">5D 1 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="5d3min.php">5D 3 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="5d5min.php">5D 5 Min</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="5d10min.php">5D 10 Min</a></li>
              </ul>
            </div>
          </li>
		  <?php
			}
			if($finance == 1){
		  ?>
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-3" aria-expanded="false" aria-controls="ui-basic-3">
              <i class="icon-book menu-icon"></i>
              <span class="menu-title">Finance</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-3">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="addupi.php">Add Upi</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="usdtkids.php">USDT RATE </a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="addusdt.php">Add Usdt</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="addupiimg.php">Add Upi Image</a></li>
              </ul>			  
			  <ul class="nav flex-column sub-menu">
               <li class="nav-item"> <a class="nav-link" href="addimgusdt_2.php">Add Usdt Image</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="deposit_update.php">Deposit Update</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="manage_withdraw.php">Withdraw Apply</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="withdraw_accept_list.php">Withdraw Sent</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="withdraw_reject_list.php">Withdraw Reject</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="update_with_pay.php">Update Gateway</a></li>
              </ul>
            </div>
          </li>
          
          
          <?php
			}
			if($support == 1){
		  ?>
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-5" aria-expanded="false" aria-controls="ui-basic- 5">
              <i class="icon-book menu-icon"></i>
              <span class="menu-title">support</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-5">
              
            
              
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="deposite.php">Deposite Problem</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="withprob.php">Withdrawal problem</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="ifscm.php">IFSC Modification</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="bankm.php">Bank Modification</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="gamep.php">Game Problem</a></li>
              </ul>
            </div>
          </li>
          
          
          
		  <?php
			}
			if($managegame == 1){
		  ?>
		  <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic-4" aria-expanded="false" aria-controls="ui-basic-4">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Manage Game</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic-4">
              
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="userbonus.php">Bonus Manage</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="manage_bet.php">Manage illigal bet</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="manage_bankcard.php">Modify Bank Details</a></li>
              </ul>
              
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="adminpass.php">Admin Password</a></li>
                  </ul>
              
              <div class="collapse" id="ui-basic-4">
                <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="autobanuser.php">Check Same IP</a></li>
                  </ul>
                
                
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="mainkids.php">maintainance</a></li>
              </ul>
                
                 <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="banbybet.php">ban illigal users</a></li>
              </ul>
                
                
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="updatejet.php">Jet Max Value</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="manage_support.php">Users Query</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="manage_user.php">Users</a></li>
              </ul>
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="manage_salary.php">Daily Salary</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="addgiftcode.php">Gift Code</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="addtelegram.php">Telegram</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="addadmin.php">Add Admin</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="demouser.php">Demo User</a></li>
              </ul>
			  <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="agentuser.php">Agent User</a></li>
              </ul>
            </div>
          </li>
		  <?php
			}
		  ?>
		 <li class="nav-item">
                    <a href="https://51gameplay.online" class="nav-link">
                        <i class="nav-icon fa fa-sign-out" aria-hidden="true"></i>
                        <p>Go To Website</p>
                    </a>
                </li>
        </ul>