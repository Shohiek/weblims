<div class="computer tablet only row">
  <div class="ui inverted fixed menu navbar page grid main-navbar pointing">
    <a href="" class="item down" style="width:50px">
      <div ng-activity-indicator="CircledWhite"></div>
    </a>
    <a href="#" class="brand item"><big>CD4 LIMS</big></a>
    <div class="right menu">
      <a href="" class="active item"> 
        <center>
          <span class="user-info">
            <i class="fa fa-calendar fa-sm"></i>
            <b><?php echo '   '.Date("F d Y, l")?></b>          
          </span>
        </center>
      </a>
    </div>
  </div>
</div>

<div class="mobile only row">
  <div class="ui inverted navbar menu">
    <a href="#dashboard" class="brand item"><big>CD4 LIMS</big></a>
    <a href="" class="item down" style="width:50px">
      <div ng-activity-indicator="CircledWhite"></div>
    </a>
    <div class="right menu open">
      <a href="" class="inverted item" >
        <i class="icon list"></i>
      </a>
    </div>
  </div>
  <div class="ui vertical navbar menu top" style="width:100%;padding:0;">
    <a href="#dashboard" class="item" ng-class="getActiveMenu('dashboard')"><i class="fa fa-dashboard fa-sm icon blue"></i>Dashboard</a>
    <a href="#fillFCDRR" class="item" ng-class="getActiveMenu('fcdrr')"><i class="fa fa-file fa-sm icon"></i>FCDRR</a>
    <a href="#CD4DeviceUploads" class="item" ng-class="getActiveMenu('cd4DeviceUploads')"><i class="fa fa-upload fa-sm icon green"></i>Device Uploads</a>
    <a href="#facilities" class="item" ng-class="getActiveMenu('facilities')"><i class="fa fa-hospital-o fa-sm icon yellow"></i>Facilities</a>
    <a href="#CD4Tests" class="item" ng-class="getActiveMenu('cd4Tests')"><i class="fa fa-tint fa-sm icon red"></i>CD4 Tests</a>
    <a href="#CD4Devices" class="item" ng-class="getActiveMenu('cd4Devices')"><i class="fa fa-medkit fa-sm icon pink"></i>CD4 Devices</a>
    <a href="#Reports" class="item" ng-class="getActiveMenu('reports')"><i class="fa fa-file-o fa-sm icon "></i>Reports</a>
    <div class="ui item">
      <div class="text">Actions</div>
      <div class="menu">
        <div class="item">Logout<i class="key icon " style="float:right"></i></div>
        <div class="item">Help<i class="help icon " style="float:right"></i></div>
        <div class="item">My Profile<i class="user icon " style="float:right"></i></div>
        <div class="item"><b>Change Password</b></div>
        <div class="ui divider"></div>
        <div class="item">About<i class="info icon " style="float:right"></i></div>
      </div>
    </div>
  </div>
</div>

<style>
.ai-circled{
  height: 19px !important;
  width: 19px !important;
}
</style>

<script>
$(document).ready(function(){
  $('.ui.vertical.menu.top').toggle();
  $('.right.menu.open').on("click",function(e){
    e.preventDefault();
    $('.ui.vertical.menu.top').toggle();
  });
  $('.ui.dropdown').dropdown();
});
</script>
