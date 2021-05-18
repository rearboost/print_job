<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="home">
    <!-- <h4 style="color: #ec008c;">NAVIGATE PRINTERS & ADVERTISING</h4> -->
    <img src="../icon/icon.png" alt="" style="height: 35px; width: 90px; margin-left: 2%;">
  </a>

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

      <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2): ?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="home">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>

      <?php else: ?>

      <?php endif ?>


      <?php if ($_SESSION["level"]== 3 ||  $_SESSION["level"]== 4): ?>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="jobs">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Job List</span>
          </a>
        </li>

      <?php else: ?>

      <?php endif ?>

      <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="jobs">
          <i class="fa fa-fw fa fa-thumbs-down"></i>
          <span class="nav-link-text">Job list</span>
        </a>
      </li> -->

      <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2 || $_SESSION["level"]== 3 ): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
        <a class="nav-link" href="inbound_requests">
          <i class="fa fa-fw fa fa-bell"></i>
          <span class="nav-link-text">Inbound Requests</span>
        </a>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="rejected">
          <i class="fa fa-fw fa fa-thumbs-down"></i>
          <span class="nav-link-text">Rejected Jobs</span>
        </a>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2 || $_SESSION["level"]== 3 || $_SESSION["level"]== 4): ?>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-wrench"></i>
          <span class="nav-link-text">Jobs in Progress</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents1">
            <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2 || $_SESSION["level"]== 3): ?>
            <li>
              <a href="design">Design</a>
            </li>
            <?php else: ?>
            <?php endif ?>

            <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2 || $_SESSION["level"]== 4): ?>
              <li>
                <a href="production">Production</a>
              </li>
            <?php else: ?>
            <?php endif ?>

            <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2): ?>
            <li>
              <a href="quality_check">Quality Check</a>
            </li>
            <?php else: ?>
            <?php endif ?>
        </ul>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="dispatch">
          <i class="fa fa-fw fa fa-thumbs-o-up"></i>
          <span class="nav-link-text">Ready to Dispatch</span>
        </a>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="completed">
          <i class="fa fa-fw fa fa-thumbs-up"></i>
          <span class="nav-link-text">Completed Job</span>
        </a>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1 ||  $_SESSION["level"]== 2): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
          <i class="fa fa-file-text"></i>
          <span class="nav-link-text">&nbsp;Reports</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents2">

          <li>
            <a href="daily_sales">Sales</a>
          </li>
          <li>
            <a href="billing">Billing</a>
          </li>
          <li>
            <a href="customer">Customer Database</a>
          </li>
        </ul>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="pos_items">
          <i class="fa fa-fw fa fa-cart-plus"></i>
          <span class="nav-link-text">POS</span>
        </a>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="setting">
          <i class="fa fa-fw fa fa-cog"></i>
          <span class="nav-link-text">Settings</span>
        </a>
      </li>

      <?php else: ?>

      <?php endif ?>

      <?php if ($_SESSION["level"]== 1): ?>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
        <a class="nav-link" href="web_settings">
          <i class="fa fa-fw fa fa-cogs"></i>
          <span class="nav-link-text">Web Settings</span>
        </a>
      </li>

      <?php else: ?>

      <?php endif ?>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <!-- <div class="row">
          <div class="col-md-7 nav-link">Loged as : <?php // echo $_SESSION['email'] ?>&nbsp; </div>
          <div class="col-md-5">
            <a class="nav-link" href="../logout" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
          </div>
        </div> -->
        <a class="nav-link" href="../logout" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
 
      </li>
    </ul>
  </div>
</nav>
