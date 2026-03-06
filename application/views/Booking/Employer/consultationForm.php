<!-- SmartWizard html -->
<div id="smartwizard" dir="rtl-">
  <ul class="nav nav-progress">
    <li class="nav-item">
      <a class="nav-link" href="#step-1">
        <div class="num">1</div>
        Country & Program
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#step-2">
        <span class="num">2</span>
        Application Details
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#step-3">
        <span class="num">3</span>
        Choose Time & Date
      </a>
    </li>
    
  </ul>

  <div class="tab-content">

    <!-- Form 1 -->
    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
      <?php include_once("forms/form-1.php") ?>
    </div>

    <!-- Form 2 -->
    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
      <?php include_once("forms/form-2.php") ?>
    </div>

    <!-- Form 3 -->
    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
      <?php include_once("forms/form-3.php") ?>
    </div>

    <!-- Form 4 -->
    <!-- <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4" style="padding: 3.8rem;">
      <?php //include_once("forms/form-4.php") ?>
    </div> -->

  </div>

  <div class="progress">
    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
      aria-valuemax="100"></div>
  </div>
</div>