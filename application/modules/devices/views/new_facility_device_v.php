<div class="ui segment">
  <h3><center><div class="ui pink horizontal label big"> New CD4 Device </div></center></h3>
</div>

<div class="ui segment">
<form class="ui form">
		<div class="ui stackable grid">
			<div class="ui pink horizontal label big">Device Details</div><div class="field"></div>
			<div class="two fields">
		        <div class="field">
		        	<div class="ui horizontal label large">Device Serial Number</div><div class="field"></div>
		          	<input type="text" ng-model="facility_dev_detail.serial_number">
		        </div>
		        <div class="field">
		        	<div class="ui horizontal label large">Device Type</div><div class="field"></div>
		        	<ui-select on-select="dev_type_change()" ng-model="selected.device_type" theme="selectize">
	                    <ui-select-match placeholder="Select Device Type"> {{ $select.selected.name }}</ui-select-match>
	                        <ui-select-choices  repeat="device_type in device_types | filter: $select.search">
	                            <span ng-bind-html="device_type.name | highlight: $select.search"></span>
	                    </ui-select-choices>
            		</ui-select>
		        </div>
	    	</div>
	    	<div class="two fields">
			    <div class="field">
		        	<div class="ui horizontal label large">Date Added</div><div class="field"></div>
		      		<input type="text" readonly value="{{ dateAsString }}" >
			    </div>
			    <div class="field">
		        	<!-- <div class="ui horizontal label large">Roll Out Date</div><div class="field"></div>
			      	<input type="text" ng-model="facility_dev_detail.facility_rollout_date"> -->
			      	<div class="ui horizontal label large">Roll Out Device ? (Tick to roll out / Untick to not roll out device)</div><div class="field"></div>
		      		<input type="checkbox" ng-model="check_roll">
					<div class="field"></div>
			    </div>
			</div>
			<div class="two fields">
			    <div class="field">
		      		<div class="ui horizontal label large" id="der" >Deactivation Reason</div><div class="field"></div>
			      	<input type="text" ng-show="deact_reason" ng-model="facility_dev_detail.deactivation_reason">
			    </div>
			    <!-- <div class="field">
		        	
			    </div> -->
			</div>
		</div>
		<hr />
		<div class="ui stackable grid">
			<div class="ui pink horizontal label big">Facility Details</div>
			<div class="ui blue small message">Change the facility name to change other facility details respectively for this device</div><div class="field"></div>
			<div class="two fields">
		        <div class="field">
		          <div class="ui horizontal label large">Facility Name</div><div class="field"></div>
				        <ui-select on-select="facility_change()" ng-model="selected.facility" theme="selectize">
		                    <ui-select-match placeholder="Select Facility"> {{ $select.selected.facility_name }}</ui-select-match>
		                        <ui-select-choices  repeat="facility in facilities | filter: $select.search">
		                            <span ng-bind-html="facility.facility_name | highlight: $select.search"></span>
		                    </ui-select-choices>
            			</ui-select>
		        </div>
		        <div class="field">
		        	<div class="ui horizontal label large">MFL Code</div><div class="field"></div>
		          	<input type="text" readonly ng-model="facility_dev_detail.facility_mfl_code">
		        </div>
	    	</div>
			<div class="two fields">
			    <div class="field">
		        	<div class="ui horizontal label large"> Sub County</div><div class="field"></div>
		      		<input type="text" readonly ng-model="facility_dev_detail.sub_county_name">
		    	</div>
		    	<div class="field">
	        		<div class="ui horizontal label large"> County </div><div class="field"></div>
			    	<input type="text" readonly ng-model="facility_dev_detail.county_name">
		    	</div>
			</div>

			<div class="two fields">
			    <div class="field">
		        	<div class="ui horizontal label large"> Partner </div><div class="field"></div>
		      		<input type="text" readonly ng-model="facility_dev_detail.partner_name">
			    </div>
			    <div class="field">
		        	<div class="ui horizontal label large"> Central Site </div><div class="field"></div>
		      		<input type="text" readonly ng-model="facility_dev_detail.central_site_name">
			    </div>
			</div>
			<div class="field"></div><hr />
			<div class="field">
				<div class="ui primary button" ng-click="save_new_device()"> Save Details</div>
				<button class="ui button" ng-click="backDevices()"> Back To Devices </button>
			</div>
		
		<div style="height:100px">

		</div>
	</div>
</form>
</div>
<script type="text/javascript">
//$('.ui.toggle.checkbox').checkbox();

</script>