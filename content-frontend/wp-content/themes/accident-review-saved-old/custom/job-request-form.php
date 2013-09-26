<?php
echo'<div id="update_job_fields">';
if ($_POST){
    $save_status = accident_process_agent_request_form($_GET['id']);
    if($save_status){
        ?>
        <div class="ui-state-highlight">
            <p>The Job has been saved.</p>
            <script type="text/javascript">setTimeout(function(){ jQuery(document).ready(function(){ jQuery('.ui-state-highlight').fadeOut('slow',function(){ jQuery(this).remove(); }); }); },5000);</script>
        </div>
        <?
    } else {
        ?>
        <div class="ui-state-alert">
            <p>The Job was not saved correctly.  Please try again.</p>
        </div>
        <?
    }
}
$job=accident_get_job_details($_GET['id']);

?>
<form method="post" class="accident-form" enctype="multipart/form-data">
 <input type="hidden" name="job_id" value="<?php echo $_GET['id']; ?>" />
 <input type="hidden" name="job_ticket_id" value="<?php echo accident_get_job_ticket_id($_GET['id']); ?>" />
 
<div class="request_form">
    <div class="common_questions">
        <h3>General Information</h3>
        <div style="float:left;">
            <label for="date_of_loss">Date of Loss</label><input class="datepicker" name="date_of_loss" type="text" value="<?php echo date('m/d/Y',strtotime($job['date_of_loss']))?>" />
        </div>
        <div style="float:left;margin-left: 20px;">
            <label for="date_of_recovery">Date of Recovery</label><input class="datepicker" name="date_of_recovery" type="text" value="<?php echo date('m/d/Y',strtotime($job['date_of_recovery']))?>" />
        </div>
        <br class="clear" />
        
        <label for="loss_description">Description of Loss</label>
        <textarea name="loss_description"><?php echo $job['loss_description']?></textarea>
        <label for="location_of_loss">Location of Loss</label>
        <textarea name="location_of_loss"><?php echo $job['location_of_loss']?></textarea>
        <label for="services_requested">Services Requested</label>
        <textarea name="services_requested"><?php echo $job['services_requested']?></textarea>       
    </div>
    <br class="clear" />
    <div class="claimant_form_a">
       <button type="button" id="cl_a_button"><span>Show</span></button>
       <h3>Claimant A</h3>
       <div class="claimant_a_form">
       <div class="cl_a_year">
	<label for="claimant_a_year">Year:</label>
	<select name="claimant_a_year" id="claimant_a_year"> 
	   <option value="">Select a Year</option> 
		<?php
		for($i = date('Y')+1; $i>date('Y')-26; $i--) :
		?>
		<option value="<?php echo $i; ?>" <?php echo ($job['claimant_a_year'] == $i?'selected="selected"':''); ?>><?php echo $i; ?></option>
		<?php
		endfor;
		?>
		
	</select>
        </div>
        <div class="cl_a_make">
	<label for="claimant_a_make">Make:</label>
	<select name="claimant_a_make"> 
            <option value="">Select a Make</option>
            <option value="Acura" <?php echo ($job['claimant_a_make'] == 'Acura'?'selected="selected"':'')?>>Acura</option>
            <option value="American" <?php echo ($job['claimant_a_make'] == 'American'?'selected="selected"':'')?>>American</option>
            <option value="Audi" <?php echo ($job['claimant_a_make'] == 'Audi'?'selected="selected"':'')?>>Audi</option>
            <option value="BMW" <?php echo ($job['claimant_a_make'] == 'BMW'?'selected="selected"':'')?>>BMW</option>
            <option value="Buick" <?php echo ($job['claimant_a_make'] == 'Buick'?'selected="selected"':'')?>>Buick</option>
            <option value="Cadillac" <?php echo ($job['claimant_a_make'] == 'Cadillac'?'selected="selected"':'')?>>Cadillac</option>
            <option value="Carpenter" <?php echo ($job['claimant_a_make'] == 'Carpenter'?'selected="selected"':'')?>>Carpenter</option>
            <option value="Chevrolet" <?php echo ($job['claimant_a_make'] == 'Chevrolet'?'selected="selected"':'')?>>Chevrolet</option>
            <option value="Chrysler" <?php echo ($job['claimant_a_make'] == 'Chrysler'?'selected="selected"':'')?>>Chrysler</option>
            <option value="Daewoo" <?php echo ($job['claimant_a_make'] == 'Daewoo'?'selected="selected"':'')?>>Daewoo</option>
            <option value="Delorean" <?php echo ($job['claimant_a_make'] == 'Delorean'?'selected="selected"':'')?>>Delorean</option>
            <option value="Dodge" <?php echo ($job['claimant_a_make'] == 'Dodge'?'selected="selected"':'')?>>Dodge</option>
            <option value="Eagle" <?php echo ($job['claimant_a_make'] == 'Eagle'?'selected="selected"':'')?>>Eagle</option>
            <option value="Fiat" <?php echo ($job['claimant_a_make'] == 'Fiat'?'selected="selected"':'')?>>Fiat</option>
            <option value="Ford" <?php echo ($job['claimant_a_make'] == 'Ford'?'selected="selected"':'')?>>Ford</option>
            <option value="General Motors" <?php echo ($job['claimant_a_make'] == 'General Motors'?'selected="selected"':'')?>>General Motors</option>
            <option value="Geo" <?php echo ($job['claimant_a_make'] == 'Geo'?'selected="selected"':'')?>>Geo</option>
            <option value="GMC" <?php echo ($job['claimant_a_make'] == 'GMC'?'selected="selected"':'')?>>GMC</option>
            <option value="Honda" <?php echo ($job['claimant_a_make'] == 'Honda'?'selected="selected"':'')?>>Honda</option>
            <option value="Hummer" <?php echo ($job['claimant_a_make'] == 'Hummer'?'selected="selected"':'')?>>Hummer</option>
            <option value="Hyundai" <?php echo ($job['claimant_a_make'] == 'Hyundai'?'selected="selected"':'')?>>Hyundai</option>
            <option value="Infiniti" <?php echo ($job['claimant_a_make'] == 'Infiniti'?'selected="selected"':'')?>>Infiniti</option>
            <option value="Isuzu" <?php echo ($job['claimant_a_make'] == 'Isuzu'?'selected="selected"':'')?>>Isuzu</option>
            <option value="Jaguar" <?php echo ($job['claimant_a_make'] == 'Jaguar'?'selected="selected"':'')?>>Jaguar</option>
            <option value="Jeep" <?php echo ($job['claimant_a_make'] == 'Jeep'?'selected="selected"':'')?>>Jeep</option>
            <option value="Jet" <?php echo ($job['claimant_a_make'] == 'Jet'?'selected="selected"':'')?>>Jet</option>
            <option value="Kia" <?php echo ($job['claimant_a_make'] == 'Kia'?'selected="selected"':'')?>>Kia</option>
            <option value="Land Rover" <?php echo ($job['claimant_a_make'] == 'Land Rover'?'selected="selected"':'')?>>Land Rover</option>
            <option value="Lexus" <?php echo ($job['claimant_a_make'] == 'Lexus'?'selected="selected"':'')?>>Lexus</option>
            <option value="Lincoln" <?php echo ($job['claimant_a_make'] == 'Lincoln'?'selected="selected"':'')?>>Lincoln</option>
            <option value="Mazda" <?php echo ($job['claimant_a_make'] == 'Mazda'?'selected="selected"':'')?>>Mazda</option>
            <option value="Mercedes" <?php echo ($job['claimant_a_make'] == 'Mercedes'?'selected="selected"':'')?>>Mercedes</option>
            <option value="Mercury" <?php echo ($job['claimant_a_make'] == 'Mercury'?'selected="selected"':'')?>>Mercury</option>
            <option value="Mini" <?php echo ($job['claimant_a_make'] == 'Mini'?'selected="selected"':'')?>>Mini</option>
            <option value="Mitsubishi" <?php echo ($job['claimant_a_make'] == 'Mitsubishi'?'selected="selected"':'')?>>Mitsubishi</option>
            <option value="Nissan" <?php echo ($job['claimant_a_make'] == 'Nissan'?'selected="selected"':'')?>>Nissan</option>
            <option value="Oldsmobile" <?php echo ($job['claimant_a_make'] == 'Oldsmobile'?'selected="selected"':'')?>>Oldsmobile</option>
            <option value="Peugeot" <?php echo ($job['claimant_a_make'] == 'Peugeot'?'selected="selectde"':'')?>>Peugeot</option>
            <option value="Plymouth" <?php echo ($job['claimant_a_make'] == 'Plymouth'?'selected="selected"':'')?>>Plymouth</option>
            <option value="Pontiac" <?php echo ($job['claimant_a_make'] == 'Pontiac'?'selected="selected"':'')?>>Pontiac</option>
            <option value="Porsche" <?php echo ($job['claimant_a_make'] == 'Porsche'?'selected="selected"':'')?>>Porsche</option>
            <option value="Ram" <?php echo ($job['claimant_a_make'] == 'Ram'?'selected="selected"':'')?>>Ram</option>
            <option value="Renault" <?php echo ($job['claimant_a_make'] == 'Renault'?'selected="selected"':'')?>>Renault</option>
            <option value="Saab" <?php echo ($job['claimant_a_make'] == 'Saab'?'selected="selected"':'')?>>Saab</option>
            <option value="Saturn" <?php echo ($job['claimant_a_make'] == 'Saturn'?'selected="selected"':'')?>>Saturn</option>
            <option value="Scion" <?php echo ($job['claimant_a_make'] == 'Scion'?'selecetd="selected"':'')?>>Scion</option>
            <option value="Smart" <?php echo ($job['claimant_a_make'] == 'Smart'?'selected="selected"':'')?>>Smart</option>
            <option value="Solectria" <?php echo ($job['claimant_a_make'] == 'Solectria'?'selected="selected"':'')?>>Solectria</option>
            <option value="Subaru" <?php echo ($job['claimant_a_make'] == 'Subaru'?'selected="selected"':'')?>>Subaru</option>
            <option value="Suzuki" <?php echo ($job['claimant_a_make'] == 'Suzuki'?'selected="selected"':'')?>>Suzuki</option>
            <option value="Toyota" <?php echo ($job['claimant_a_make'] == 'Toyota'?'selected="selected"':'')?>>Toyota</option>
            <option value="Volkswagen" <?php echo ($job['claimant_a_make'] == 'Volkswagen'?'selected="selected"':'')?>>Volkswagen</option>
            <option value="Volvo" <?php echo ($job['claimant_a_make'] == 'Volvo'?'selected="selected"':'')?>>Volvo</option>
            <option value="Other" <?php echo ($job['claimant_a_make'] == 'Other'?'selected="selected"':'')?>>Other</option>
	</select>
        </div>
	<label for="claimant_a_model">Model: </label><input name="claimant_a_model" type="text" value="<?php echo $job['claimant_a_model']?>" />
	<label for="claimant_a_color">Color: </label><input name="claimant_a_color" type="text" value="<?php echo $job['claimant_a_color']?>" />
	<label for="claimant_a_vin">VIN: </label><input name="claimant_a_vin" type="text" value="<?php echo $job['claimant_a_vin']?>" />
	<label for="claimant_a_plate">Plate Number: </label><input name="claimant_a_plate" type="text" value="<?php echo $job['claimant_a_plate']?>" />
	<label for="claimant_a_aftermarket">Modifications/Aftermarket: </label><input name="claimant_a_aftermarket" type="text" value="<?php echo $job['claimant_a_aftermarket']?>" />
	<label for="claimant_a_additional">Additional Information: </label><textarea name="claimant_a_additional"><?php echo $job['claimant_a_additional']?></textarea>
       </div>   
    </div>
    <div class="claimant_form_b">
       <button type="button" id="cl_b_button"><span>Show</span></button>
       <h3>Claimant B</h3>
       <div class="claimant_b_form">
        <div class="cl_b_year">
	<label for="claimant_b_year">Year:</label>
	<select name="claimant_b_year">
               <option value="">Select a Year</option>
	    <?php
               for($i = date('Y')+1; $i>date('Y')-26; $i--) :
               ?>
               <option value="<?php echo $i; ?>" <?php echo ($job['claimant_b_year'] == $i?'selected="selected"':'')?>><?php echo $i; ?></option>
               <?php
               endfor;
               ?>
	</select>
        </div>
        <div class="cl_b_make">
	<label for="claimant_b_make">Make:</label>
	<select name="claimant_b_make"> 
            <option value="">Select a Make</option>
            <option value="Acura" <?php echo ($job['claimant_b_make'] == 'Acura'?'selected="selected"':'')?>>Acura</option>
            <option value="American" <?php echo ($job['claimant_b_make'] == 'American'?'selected="selected"':'')?>>American</option>
            <option value="Audi" <?php echo ($job['claimant_b_make'] == 'Audi'?'selected="selected"':'')?>>Audi</option>
            <option value="BMW" <?php echo ($job['claimant_b_make'] == 'BMW'?'selected="selected"':'')?>>BMW</option>
            <option value="Buick" <?php echo ($job['claimant_b_make'] == 'Buick'?'selected="selected"':'')?>>Buick</option>
            <option value="Cadillac" <?php echo ($job['claimant_b_make'] == 'Cadillac'?'selected="selected"':'')?>>Cadillac</option>
            <option value="Carpenter" <?php echo ($job['claimant_b_make'] == 'Carpenter'?'selected="selected"':'')?>>Carpenter</option>
            <option value="Chevrolet" <?php echo ($job['claimant_b_make'] == 'Chevrolet'?'selected="selected"':'')?>>Chevrolet</option>
            <option value="Chrysler" <?php echo ($job['claimant_b_make'] == 'Chrysler'?'selected="selected"':'')?>>Chrysler</option>
            <option value="Daewoo" <?php echo ($job['claimant_b_make'] == 'Daewoo'?'selected="selected"':'')?>>Daewoo</option>
            <option value="Delorean" <?php echo ($job['claimant_b_make'] == 'Delorean'?'selected="selected"':'')?>>Delorean</option>
            <option value="Dodge" <?php echo ($job['claimant_b_make'] == 'Dodge'?'selected="selected"':'')?>>Dodge</option>
            <option value="Eagle" <?php echo ($job['claimant_b_make'] == 'Eagle'?'selected="selected"':'')?>>Eagle</option>
            <option value="Fiat" <?php echo ($job['claimant_b_make'] == 'Fiat'?'selected="selected"':'')?>>Fiat</option>
            <option value="Ford" <?php echo ($job['claimant_b_make'] == 'Ford'?'selected="selected"':'')?>>Ford</option>
            <option value="General Motors" <?php echo ($job['claimant_b_make'] == 'General Motors'?'selected="selected"':'')?>>General Motors</option>
            <option value="Geo" <?php echo ($job['claimant_b_make'] == 'Geo'?'selected="selected"':'')?>>Geo</option>
            <option value="GMC" <?php echo ($job['claimant_b_make'] == 'GMC'?'selected="selected"':'')?>>GMC</option>
            <option value="Honda" <?php echo ($job['claimant_b_make'] == 'Honda'?'selected="selected"':'')?>>Honda</option>
            <option value="Hummer" <?php echo ($job['claimant_b_make'] == 'Hummer'?'selected="selected"':'')?>>Hummer</option>
            <option value="Hyundai" <?php echo ($job['claimant_b_make'] == 'Hyundai'?'selected="selected"':'')?>>Hyundai</option>
            <option value="Infiniti" <?php echo ($job['claimant_b_make'] == 'Infiniti'?'selected="selected"':'')?>>Infiniti</option>
            <option value="Isuzu" <?php echo ($job['claimant_b_make'] == 'Isuzu'?'selected="selected"':'')?>>Isuzu</option>
            <option value="Jaguar" <?php echo ($job['claimant_b_make'] == 'Jaguar'?'selected="selected"':'')?>>Jaguar</option>
            <option value="Jeep" <?php echo ($job['claimant_b_make'] == 'Jeep'?'selected="selected"':'')?>>Jeep</option>
            <option value="Jet" <?php echo ($job['claimant_b_make'] == 'Jet'?'selected="selected"':'')?>>Jet</option>
            <option value="Kia" <?php echo ($job['claimant_b_make'] == 'Kia'?'selected="selected"':'')?>>Kia</option>
            <option value="Land Rover" <?php echo ($job['claimant_b_make'] == 'Land Rover'?'selected="selected"':'')?>>Land Rover</option>
            <option value="Lexus" <?php echo ($job['claimant_a_make'] == 'Lexus'?'selected="selected"':'')?>>Lexus</option>
            <option value="Lincoln" <?php echo ($job['claimant_b_make'] == 'Lincoln'?'selected="selected"':'')?>>Lincoln</option>
            <option value="Mazda" <?php echo ($job['claimant_b_make'] == 'Mazda'?'selected="selected"':'')?>>Mazda</option>
            <option value="Mercedes" <?php echo ($job['claimant_b_make'] == 'Mercedes'?'selected="selected"':'')?>>Mercedes</option>
            <option value="Mercury" <?php echo ($job['claimant_b_make'] == 'Mercury'?'selected="selected"':'')?>>Mercury</option>
            <option value="Mini" <?php echo ($job['claimant_b_make'] == 'Mini'?'selected="selected"':'')?>>Mini</option>
            <option value="Mitsubishi" <?php echo ($job['claimant_b_make'] == 'Mitsubishi'?'selected="selected"':'')?>>Mitsubishi</option>
            <option value="Nissan" <?php echo ($job['claimant_b_make'] == 'Nissan'?'selected="selected"':'')?>>Nissan</option>
            <option value="Oldsmobile" <?php echo ($job['claimant_b_make'] == 'Oldsmobile'?'selected="selected"':'')?>>Oldsmobile</option>
            <option value="Peugeot" <?php echo ($job['claimant_b_make'] == 'Peugeot'?'selected="selectde"':'')?>>Peugeot</option>
            <option value="Plymouth" <?php echo ($job['claimant_b_make'] == 'Plymouth'?'selected="selected"':'')?>>Plymouth</option>
            <option value="Pontiac" <?php echo ($job['claimant_b_make'] == 'Pontiac'?'selected="selected"':'')?>>Pontiac</option>
            <option value="Porsche" <?php echo ($job['claimant_b_make'] == 'Porsche'?'selected="selected"':'')?>>Porsche</option>
            <option value="Ram" <?php echo ($job['claimant_b_make'] == 'Ram'?'selected="selected"':'')?>>Ram</option>
            <option value="Renault" <?php echo ($job['claimant_b_make'] == 'Renault'?'selected="selected"':'')?>>Renault</option>
            <option value="Saab" <?php echo ($job['claimant_b_make'] == 'Saab'?'selected="selected"':'')?>>Saab</option>
            <option value="Saturn" <?php echo ($job['claimant_b_make'] == 'Saturn'?'selected="selected"':'')?>>Saturn</option>
            <option value="Scion" <?php echo ($job['claimant_b_make'] == 'Scion'?'selecetd="selected"':'')?>>Scion</option>
            <option value="Smart" <?php echo ($job['claimant_b_make'] == 'Smart'?'selected="selected"':'')?>>Smart</option>
            <option value="Solectria" <?php echo ($job['claimant_b_make'] == 'Solectria'?'selected="selected"':'')?>>Solectria</option>
            <option value="Subaru" <?php echo ($job['claimant_b_make'] == 'Subaru'?'selected="selected"':'')?>>Subaru</option>
            <option value="Suzuki" <?php echo ($job['claimant_b_make'] == 'Suzuki'?'selected="selected"':'')?>>Suzuki</option>
            <option value="Toyota" <?php echo ($job['claimant_b_make'] == 'Toyota'?'selected="selected"':'')?>>Toyota</option>
            <option value="Volkswagen" <?php echo ($job['claimant_b_make'] == 'Volkswagen'?'selected="selected"':'')?>>Volkswagen</option>
            <option value="Volvo" <?php echo ($job['claimant_b_make'] == 'Volvo'?'selected="selected"':'')?>>Volvo</option>
            <option value="Other" <?php echo ($job['claimant_b_make'] == 'Other'?'selected="selected"':'')?>>Other</option>
	</select>
        </div>
	<label for="claimant_b_model">Model:</label><input name="claimant_b_model" type="text" value="<?php echo $job['claimant_b_model']?>" />
	<label for="claimant_b_color">Color:</label><input name="claimant_b_color" type="text" value="<?php echo $job['claimant_b_color']?>" />
	<label for="claimant_b_vin">VIN: </label><input name="claimant_b_vin" type="text" value="<?php echo $job['claimant_b_vin']?>" />
	<label for="claimant_b_plate">Plate Number: </label><input name="claimant_b_plate" type="text" value="<?php echo $job['claimant_b_plate']?>" />
	<label for="claimant_b_aftermarket">Modifications/Aftermarket: </label><input name="claimant_b_aftermarket" type="text" value="<?php echo $job['claimant_b_aftermarket']?>" />
	<label for="claimant_b_additional">Additional Information: </label><textarea name="claimant_b_additional"><?php echo $job['claimant_b_additional']?></textarea>
    </div>
    </div>
    <br class="clear" />
    <div class="job_type_form">
        <label>Service Type Requested</label>
		<select name="service">
            <option value="0">Select a Service</option>
    		<option value="1" <?php echo ($job['job_type'] == ucwords('vehicle theft analysis')?'selected="selected"':'')?>>Vehicle Theft Analysis</option>
    		<option value="2" <?php echo ($job['job_type'] == ucwords('accident reconstruction')?'selected="selected"':'')?>>Accident Reconstruction</option>
    		<option value="3" <?php echo ($job['job_type'] == ucwords('fire analysis')?'selected="selected"':'')?>>Fire Analysis</option>
    		<option value="4" <?php echo ($job['job_type'] == ucwords('mechanical analysis')?'selected="selected"':'')?>>Mechanical Analysis</option>
    		<option value="5" <?php echo ($job['job_type'] == 'Physical Damage Comparison')?'selected="selected"':''; ?>>Physical Damage Comparison</option>
    		<option value="6" <?php echo ($job['job_type'] == ucwords('report review')?'selected="selected"':'')?>>Report Review</option>
    		<option value="7" <?php echo ($job['job_type'] == ucwords('other')?'selected="selected"':'')?>>Other</option>
		</select>
    </div>
  
    <div class="job_specific_forms">
        <div class="accident_reconstruction_form inline">
            <h3>Accident Reconstruction</h3>
            <label for="accident_reconstruction_form">Do we have authorization to contact the vehicle owner?</label><br />
            <input type="radio" name="accident_reconstruction_contact_auth" id="accident_reconstruction_contact_auth_yes" value="1" <?php echo ($job['accident_reconstruction_contact_auth'] == '1'?'checked="checked"':'')?> /> 
            <label for="accident_reconstruction_contact_auth_yes">Yes</label>
            <input type="radio" name="accident_reconstruction_contact_auth" id="accident_reconstruction_contact_auth_no" value="0" <?php echo ($job['accident_reconstruction_contact_auth'] == '0'?'checked="checked"':'')?> />
            <label for="accident_reconstruction_contact_auth_no">No</label>
        </div>
        <div class="fire_analysis_form">
            <h3>Fire Analysis</h3>
            <label for="fire_analysis_optional_equipment">Optional Equipment/Features:</label> 
            <textarea name="fire_analysis_optional_equipment"><?php echo $job['fire_analysis_optional_equipment']?></textarea>
            <label for="fire_analysis_question_1">Was the vehicle being driven or was it parked at the time of the fire?</label>
            <textarea name="fire_analysis_question_1"><?php echo $job['fire_analysis_question_1']?></textarea>
            <label for="fire_analysis_question_2">If the vehicle was parked, how much time elapsed from the time you last drove the vehicle until the time of the fire?</label>
            <textarea name="fire_analysis_question_2"><?php echo $job['fire_analysis_question_2']?></textarea>
            <label for="fire_analysis_question_3">If the vehicle was being driven, for how long was it driven before the fire was noticed?</label>
            <textarea name="fire_analysis_question_3"><?php echo $job['fire_analysis_question_3']?></textarea>
            <label for="fire_analysis_question_4">What was the first observation you made to indicate something was wrong or abnormal before the fire? Examples would be observations of smoke, flame, glowing, odors, noises, explosions, operating problems with the vehicle, etc.</label>
            <textarea name="fire_analysis_question_4"><?php echo $job['fire_analysis_question_4']?></textarea>
            <label for="fire_analysis_question_5">If smoke, flames, or an odor were noticed, from where on the vehicle were they noticed? Examples would be left, right, or center regions of passenger compartment, dash, seats, door trim panels, dash vents, in front of windshield, around edges of hood, out front grille, out wheel wells, underneath vehicle, fluid burning on ground under vehicle, etc. Always ask which side the smoke/flames were first noticed from: driver side, passenger side, or center.</label>
            <textarea name="fire_analysis_question_5"><?php echo $job['fire_analysis_question_5']?></textarea>
            <label for="fire_analysis_question_6">Describe the next sequence of events (let the insured kind of expand on as much as they know about the development of the fire).</label>
            <textarea name="fire_analysis_question_6"><?php echo $job['fire_analysis_question_6']?></textarea>
            <label for="fire_analysis_question_7">Did the fire develop slowly or quickly? Estimate the amount of time from the first observation of smoke/flames (question 4) until the first observation of flames/fire.</label>
            <textarea name="fire_analysis_question_7"><?php echo $job['fire_analysis_question_7']?></textarea>
            <label for="fire_analysis_question_8">How long did it take for the fire department to arrive to extinguish the fire? Estimate the amount of time you observed the fire burning in the vehicle, from the time of the first observation in question 4 until the time the fire was extinguished. </label>
            <textarea name="fire_analysis_question_8"><?php echo $job['fire_analysis_question_8']?></textarea>
            <label for="fire_analysis_question_9">Were the windows open or closed at the time of the fire?</label>
            <textarea name="fire_analysis_question_9"><?php echo $job['fire_analysis_question_9']?></textarea> 
            <label for="fire_analysis_question_10">Were the doors/hood/trunk/hatch open or closed at the time of the fire?</label>
            <textarea name="fire_analysis_question_10"><?php echo $job['fire_analysis_question_10']?></textarea> 
            <label for="fire_analysis_question_11">Describe any operating problems you had been experiencing with the vehicle before the fire and in the weeks/months preceding the fire.</label>
            <textarea name="fire_analysis_question_11"><?php echo $job['fire_analysis_question_11']?></textarea> 
            <label for="fire_analysis_question_12">Describe and provide any invoices for any service work performed on the vehicle before the fire and in the weeks/months preceding the fire. </label>
            <textarea name="fire_analysis_question_12"><?php echo $job['fire_analysis_question_12']?></textarea> 
            <label for="fire_analysis_question_13">Describe any MAJOR service, like an engine or transmission replacement, performed within a year prior to the loss.</label>
            <textarea name="fire_analysis_question_13"><?php echo $job['fire_analysis_question_13']?></textarea> 
            <label for="fire_analysis_question_14">Describe any collision damages or repairs performed on the vehicle during the time you have owned the vehicle.</label>
            <textarea name="fire_analysis_question_14"><?php echo $job['fire_analysis_question_14']?></textarea> 
            <label for="fire_analysis_question_15">Were you carrying any flammable materials or liquids in the vehicle at the time of the fire? If forensics reveals that gasoline or a gasoline container was found in a burned vehicle, be sure to ask insured if they were carrying gasoline in the vehicle at the time of the fire (the possibility always exists someone was carrying gasoline for a lawnmower or similar gas-powered device, particularly in trucks or cargo vans).</label>
            <textarea name="fire_analysis_question_15"><?php echo $job['fire_analysis_question_15']?></textarea> 
            <label for="fire_analysis_question_16">Describe any personal items/valuables that were damaged/destroyed by the fire in the vehicle.</label>
            <textarea name="fire_analysis_question_16"><?php echo $job['fire_analysis_question_16']?></textarea> 
            <label for="fire_analysis_question_17">What was the exact geographic location of the fire scene? Get an address, restaurant, gas station, or other landmark, town, city, state, etc. </label>
            <textarea name="fire_analysis_question_17"><?php echo $job['fire_analysis_question_17']?></textarea> 
            <label for="fire_analysis_question_18">Classify the scene of the fire as: rural, city, town, residential area, heavily traveled street, parking lot, etc.</label>
            <textarea name="fire_analysis_question_18"><?php echo $job['fire_analysis_question_18']?></textarea> 
            <label for="fire_analysis_question_19">What time of day did the fire occur?</label>
            <textarea name="fire_analysis_question_19"><?php echo $job['fire_analysis_question_19']?></textarea> 
            <label for="fire_analysis_question_20">What were the weather conditions at the time of the fire? Do you remember if it was particularly windy, and if so, which direction relative to the vehicle the wind was blowing? Do you remember seeing the fire/smoke blowing to a particular side of the car?</label>
            <textarea name="fire_analysis_question_20"><?php echo $job['fire_analysis_question_20']?></textarea> 
            <label for="fire_analysis_question_21">Have you ever received any recall notices on your vehicle? If so, have the recall services been performed? Describe when each recall notice was received and when it was repaired, if at all.</label>
            <textarea name="fire_analysis_question_21"><?php echo $job['fire_analysis_question_21']?></textarea> 
            <label for="fire_analysis_question_22">Ask the insured point blank: did you see where the fire originated, or do you have any thoughts about what may have started the fire?</label>
            <textarea name="fire_analysis_question_22"><?php echo $job['fire_analysis_question_22']?></textarea> 
        </div>
        <div class="mechanical_analysis_form">
            <h3>Mechanical Analysis</h3>
            <label for="mechanical_analysis_optional_equipment">Optional Equipment: </label><input type="text" name="mechanical_analysis_optional_equipment" value="<?php echo $job['mechanical_analysis_optional_equipment']?>" />
            <label for="mechanical_analysis_recent_service_history">Recent Service History: </label><input type="text" name="mechanical_analysis_recent_service_history"  value="<?php echo $job['mechanical_analysis_recent_service_history']?>" />
            <label for="mechanical_analysis_recall_history">Recall History: </label><input type="text" name="mechanical_analysis_recall_history" value="<?php echo $job['mechanical_analysis_recall_history']?>" />
        </div>
        <div class="other_analysis_form inline">
            <h3>Other Analysis</h3>
            <label for="other_analysis_form">Do we have authorization to contact the vehicle owner?</label><br/>
                <input type="radio" name="other_contact_auth" value="<?php echo ($job['other_contact_auth']=='1'?'checked="checked"':'')?>" /> 
                <label for="other_contact_auth_yes">Yes</label>
                <input type="radio" name="other_contact_auth" value="<?php echo ($job['other_contact_auth']=='0'?'checked="checked"':'')?>" /> 
                <label for="other_contact_auth_no">No</label>
            <br class="clear" />
        </div>
        <div class="physical_damage_form inline ">
            <h3>Physical Damage Analysis</h3>
            <label for="physical_damage_form">Do we have authorization to contact the vehicle owner?</label><br/>
                <input type="radio" name="physical_damage_contact_auth" id="physical_damage_contact_auth_yes" value="1" <?php echo ($job['physical_damage_contact_auth']=='1'?'checked="checked"':'')?> />
                <label for="physical_damange_contact_auth_yes">Yes</label>
                <input type="radio" name="physical_damage_contact_auth" id="physical_damage_contact_auth_no" value="0" <?php echo ($job['physical_damage_contact_auth']=='0'?'checked="checked"':'')?> />
                <label for="physical_damage_contact_auth_no">No</label>
            <br class="clear" />
        </div>
        <div class="report_review_form inline ">
            <h3>Report Review</h3>
            <label for="report_review_form">Do we have authorization to contact the vehicle owner?</label><br/>
                <input type="radio" name="report_review_contact_auth" id="report_review_contact_auth_yes" value="1" <?php echo ($job['report_review_contact_auth']=='1'?'checked="checked"':'')?> />
                <label for="report_review_contact_auth_yes">Yes</label>
                <input type="radio" name="report_review_contact_auth" id="report_review_contact_auth" value="0" <?php echo ($job['report_review_contact_auth']=='0'?'checked="checked"':'')?> />
                <label for="report_review_contact_auth_no">No</label>
            <br class="clear" />
        </div>
        <div class="vehicle_theft_form inline ">
            <h3>Vehicle Theft</h3>
            <label for="vehicle_theft_security-system">Is the vehicle equipped with a factory perimeter security system?</label><br/>
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_yes" type="radio" value="yes" <?php echo ($job['vehicle_theft_security_system']=='yes'?'checked="checked"':'')?> />
                <label for="vehicle_theft_security_system_yes">Yes</label>
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_no" type="radio" value="no" <?php echo ($job['vehicle_theft_security_system']=='no'?'checked="checked"':'')?> />
                <label for="vehicle_theft_security_system_no">No</label>
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_optional" type="radio" value="optional" <?php echo ($job['vehicle_theft_security_system']=='optional'?'checked="checked"':'')?> />
                <label for="vehicle_theft_security_system_optional">Optional</label>
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_unknown" type="radio" value="unknown" <?php echo ($job['vehicle_theft_security_system']=='unknown'?'checked="checked"':'')?> />
                <label for="vehicle_theft_security_system_unknown">Unknown</label>
            <br class="clear" />
            <label for="vehicle_theft_security_system_after">Is the vehicle equipped with an aftermarket security system?</label><br/>
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_yes" type="radio" value="yes" <?php echo ($job['vehicle_theft_security_system_after']=='yes'?'checked="checked"':'')?>/>
                <label for="vehicle_theft_security_system_after_yes">Yes</label>
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_no" type="radio" value="no" <?php echo ($job['vehicle_theft_security_system_after']=='no'?'checked="checked"':'')?>/>
                <label for="vehicle_theft_security_system_after_no">No</label>
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_unknown" type="radio" value="unknown" <?php echo ($job['vehicle_theft_security_system_after']=='unknown'?'checked="checked"':'')?>/>
                <label for="vehicle_theft_security_system_after_unknown">Unknown</label>
            <br class="clear" />
            <label for="vehicle_theft_remote">Is the vehicle equipped with an aftermarket remote start system?</label><br/>
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_yes" type="radio" value="yes" <?php echo ($job['vehicle_theft_remote']=='yes'?'selected="selected"':'')?>/>
                <label for="vehicle_theft_remote_yes">Yes</label>
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_no" type="radio" value="no" <?php echo ($job['vehicle_theft_remote']=='no'?'selected="selected"':'')?>/>
                <label for="vehicle_theft_remote_no">No</label>
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_unknown" type="radio" value="unknown" <?php echo ($job['vehicle_theft_remote']=='unknown'?'selected="selected"':'')?>/>
                <label for="vehicle_theft_remote_unknown">Unknown</label>
            <label for="vehicle_theft_question_1">Please state the geographic location the vehicle was parked at the time of the alleged theft.</label>
            <textarea name="vehicle_theft_question_1"><?php echo $job['vehicle_theft_question_1']?></textarea> 
            <label for="vehicle_theft_question_2">If the vehicle was parked in a driveway or garage, were there any other vehicles that would have to have been moved in order to drive or move the subject vehicle away?</label>
            <textarea name="vehicle_theft_question_2"><?php echo $job['vehicle_theft_question_2']?></textarea> 
            <label for="vehicle_theft_question_3">If vehicle was parked on the street, please describe how it was parked: which side of the street, cars in front, behind, to the side, buildings in front, behind, to the side, etc.</label>
            <textarea name="vehicle_theft_question_3"><?php echo $job['vehicle_theft_question_3']?></textarea> 
            <label for="vehicle_theft_question_4">Was the vehicle locked?</label>
            <textarea name="vehicle_theft_question_4"><?php echo $job['vehicle_theft_question_4']?></textarea> 
            <label for="vehicle_theft_question_5">How did you lock the vehicle when you last left it: did you use the correct key blade, a remote transmitter fob, or a power lock button inside the car? </label>
            <textarea name="vehicle_theft_question_5"><?php echo $job['vehicle_theft_question_5']?></textarea> 
            <label for="vehicle_theft_question_6">Are you aware of an audible or visual confirmation from the vehicle when it locks? Can you remember if you received that confirmation when you last left the vehicle?</label>
            <textarea name="vehicle_theft_question_6"><?php echo $job['vehicle_theft_question_6']?></textarea> 
            <label for="vehicle_theft_question_7">Were all of the windows, sunroof, rear hatch glass closed or were any windows open when you last left the vehicle? </label>
            <textarea name="vehicle_theft_question_7"><?php echo $job['vehicle_theft_question_7']?></textarea> 
            <label for="vehicle_theft_question_8">Were all of the doors, hood, trunk, rear hatch closed or were any open or unlatched when you last left the vehicle?</label>
            <textarea name="vehicle_theft_question_8"><?php echo $job['vehicle_theft_question_8']?></textarea> 
            <label for="vehicle_theft_question_9">Were there keys/transmitter fobs stored inside the vehicle? If so, where were they stored and what did the keys operate?</label>
            <textarea name="vehicle_theft_question_9"><?php echo $job['vehicle_theft_question_9']?></textarea> 
            <label for="vehicle_theft_question_10">If there were keys stored in the vehicle, were any of them capable of starting the engine and driving the vehicle?</label>
            <textarea name="vehicle_theft_question_10"><?php echo $job['vehicle_theft_question_10']?></textarea> 
            <label for="vehicle_theft_question_11">What was the exact time and date you last parked the vehicle?</label>
            <textarea name="vehicle_theft_question_11"><?php echo $job['vehicle_theft_question_11']?></textarea> 
            <label for="vehicle_theft_question_12">What was the exact time and date you noticed the vehicle was missing?</label>
            <textarea name="vehicle_theft_question_12"><?php echo $job['vehicle_theft_question_12']?></textarea> 
            <label for="vehicle_theft_question_13">Did you report the vehicle stolen to the police? If so, what was the exact date and time?</label>
            <textarea name="vehicle_theft_question_13"><?php echo $job['vehicle_theft_question_13']?></textarea> 
            <label for="vehicle_theft_question_14">Who recovered the vehicle?</label>
            <textarea name="vehicle_theft_question_14"><?php echo $job['vehicle_theft_question_14']?></textarea> 
            <label for="vehicle_theft_question_15">Please state the exact geographic location of the vehicle when it was recovered.</label>
            <textarea name="vehicle_theft_question_15"><?php echo $job['vehicle_theft_question_15']?></textarea> 
            <label for="vehicle_theft_question_16">Describe the condition of the vehicle when it was recovered: engine running/not running, key(s) in car or no keys in car, collision damages, items missing, broken windows, etc.</label>
            <textarea name="vehicle_theft_question_16"><?php echo $job['vehicle_theft_question_16']?></textarea> 
            <label for="vehicle_theft_question_17">Was vehicle drivable after it was recovered?</label>
            <textarea name="vehicle_theft_question_17"><?php echo $job['vehicle_theft_question_17']?></textarea> 
            <label for="vehicle_theft_question_18">Describe any personal items/valuables that were in the vehicle at the time of the theft, and if they were stolen out of the vehicle.</label>
            <textarea name="vehicle_theft_question_18"><?php echo $job['vehicle_theft_question_18']?></textarea> 
            <label for="vehicle_theft_question_19">Did your vehicle have a remote start system? </label>
            <textarea name="vehicle_theft_question_19"><?php echo $job['vehicle_theft_question_19']?></textarea> 
            <label for="vehicle_theft_question_20">If yes, was the system an aftermarket system that you had installed by someone after you purchased the vehicle? </label>
            <textarea name="vehicle_theft_question_20"><?php echo $job['vehicle_theft_question_20']?></textarea> 
            <label for="vehicle_theft_question_21">Was it an aftermarket system that was ALREADY previously installed in the vehicle by someone at the time before your purchase of the vehicle? </label>
            <textarea name="vehicle_theft_question_21"><?php echo $job['vehicle_theft_question_21']?></textarea> 
            <label for="vehicle_theft_question_22">Was the system a factory-installed option installed by the manufacturer when the vehicle was made?</label>
            <textarea name="vehicle_theft_question_22"><?php echo $job['vehicle_theft_question_22']?></textarea> 
            <label for="vehicle_theft_question_23">Did you ever have to give up a key or purchase a new key to your vehicle when the remote start system was installed?</label>
            <textarea name="vehicle_theft_question_23"><?php echo $job['vehicle_theft_question_23']?></textarea> 
            <label for="vehicle_theft_question_24">Was the remote start system functioning properly?</label>
            <textarea name="vehicle_theft_question_24"><?php echo $job['vehicle_theft_question_24']?></textarea> 
            <label for="vehicle_theft_question_25">Were there any warning lights illuminated in the instrument panel the last time you operated the vehicle before the theft? Examples would be check-engine, ABS, brake, security, theft, red LED light, etc. Ever notice any of the lamps flashing, either while the vehicle was being driven or just after the ignition was turned on?</label>
            <textarea name="vehicle_theft_question_25"><?php echo $job['vehicle_theft_question_25']?></textarea> 
        </div>
    </div>
</div>
<?
if($files){
            echo '<div class="files">
            <h2 class="section_name"><span class="section_name_span">
                <span class="section_name_span_span">Files</span><div class="clear"></div></span></h2>
            <table class="files_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mime</th>
                        <th>Size</th>
                        <th>URL</th>
                    </tr>
                </thead>
                <tbody>';
                    foreach($files as $key => $value){
                        echo'<tr>';
                        echo'<td>'.$files[$key]['name'].'</td>';
                        echo'<td>'.$files[$key]['mime'].'</td>';
                        echo'<td>'.$files[$key]['size'].' Bytes</td>';
                        echo'<td><a href='.$files[$key]['url'].'>Download</a></td>';
                        echo'</tr>';
                    }
                echo'</tbody>
            </table>
            </div>';
                //a list with thumbnail views of the images.
            echo'<div class="files">
            <h2 class="section_name"><span class="section_name_span">
                <span class="section_name_span_span">Images</span><div class="clear"></div></span></h2>
            <ol class="images">';
                foreach($files as $key => $value){
                    if ($files[$key]['mime']==('images/bmp'||'images/cis-cod'||'images/gif'||'images/ief'
                            ||'images/jpeg'||'images/pipeg'||'images/pjpeg'||'images/png'||'images/svg+xml'
                            ||'images/tiff'||'images/x-cmu-raster'||'images/x-cmx'||'images/x-icon'
                            ||'images/x-png'||'images/x-portable-anymap'||'images/x-portable-bitmap'
                            ||'images/x-portable-graymap'||'images/x-portable-pixmap'||'images/x-rgb'
                            ||'images/x-xbitmap'||'images/x-xpixmap'||'images/x-xwindowdump')){
                        echo'<li>';
                        echo'<a href='.$files[$key]['url'].'><img src="'.$files[$key]['url'].'"/></a>';
                        echo'</li>';
                    }
                }
            echo'</ol>';
            }//if       
            ?> 
<div class="upload_files">
    <h3>Upload Additional Files</h3>
    <div>
        <span><a href="#" class="accident_remove_file">Remove</a><a href="#" class="accident_clear_file">Clear</a></span>
        <label>Select File:</label>
        <input type="file" name="file_upload[]" />
    </div>
    <span><a href="#" id="accident_add_file">Add a File</a></span>
</div>
<input type="submit" name="submit" value="Update Job" />
<?php ?>
<script>
    
    (function($,undefined){

        $(document).ready(function() {

            $( '.datepicker' ).datepicker({
			changeMonth: true,
			changeYear: true });

            //$('.job_specific_forms > div:visible').fadeOut('fast');
            
            
            if($.browser.msie){
                $('select[name="service"] > option').bind('click',function(){
                    value = $(this).val();
                    change_visible_form(value);
                });
            } else {
                $('select[name="service"]').bind('change',function(){
                    value = $(this).val();
                    change_visible_form(value);
                });
            }
            
            $('select[name="service"]').trigger('change');

            $('.claimant_a_form').hide();
            $('.claimant_b_form').hide();
            $('#cl_a_button').bind('click', cl_a_show);
            $('#cl_b_button').bind('click', cl_b_show);
            
            /*$('#file_upload').uploadify({
                'uploader'  : '/wp-content/themes/accident-review/lib/uploadify/uploadify.swf',
                'script'    : '/wp-content/themes/accident-review/lib/uploadify/uploadify.php',
                'cancelImg' : '/wp-content/themes/accident-review/lib/uploadify/cancel.png',
                'auto'      : true,
                'multi'     : false,
                'queueID'   : 'file_queue',
                //'method'    : 'POST',
                'fileDataName': 'file_upload',
                //'folder'    : '/uploads',
                onComplete  : function(event, ID, fileObj, response, data){
                    
                    the_data = eval('('+response+')');
                    if(the_data.error == '1'){
                        alert('Could not upload file!');
                    } else {
                        final_file_id = the_data.file_id;
                        alert(final_file_id);
                    }
                    
                },
                onClear   : function(event,ID,fileObj,data){
                    
                }
            });*/
            
            /*$('#file_upload').siblings('a').bind('click',function(event){
                $('#file_upload').uploadifyUpload();  
                event.preventDefault();
            });*/      
        });
        
<?php/*
    switch($job['jop_type_form']){
        case 'Accident Reconstruction':
            echo '
                $('.accident_reconstruction_form').show();
                $('.vehicle_theft_form').hide();
                $('.fire_analysis_form').hide();
                $('.mechanical_analysis_form').hide();
                $('.physical_damage_form').hide();
                $('.report_review_form').hide();
                $('.other_analysis_form').hide(); 
            ';
            break;
        case 'Vehicle Theft Analysis':
            echo '
                $('.accident_reconstruction_form').hide();
                $('.vehicle_theft_form').show();
                $('.fire_analysis_form').hide();
                $('.mechanical_analysis_form').hide();
                $('.physical_damage_form').hide();
                $('.report_review_form').hide();
                $('.other_analysis_form').hide(); 
            ';
            break;
        case 'Fire Analysis':
            echo '
                $('.accident_reconstruction_form').hide();
                $('.vehicle_theft_form').hide();
                $('.fire_analysis_form').show();
                $('.mechanical_analysis_form').hide();
                $('.physical_damage_form').hide();
                $('.report_review_form').hide();
                $('.other_analysis_form').hide(); 
            ';
            break;
        case 'Physical Damage Comparison':
            echo '
                $('.accident_reconstruction_form').hide();
                $('.vehicle_theft_form').hide();
                $('.fire_analysis_form').hide();
                $('.mechanical_analysis_form').hide();
                $('.physical_damage_form').show();
                $('.report_review_form').hide();
                $('.other_analysis_form').hide(); 
            ';
            break;
        case 'Mechanical Analysis':
            echo '
                $('.accident_reconstruction_form').hide();
                $('.vehicle_theft_form').hide();
                $('.fire_analysis_form').hide();
                $('.mechanical_analysis_form').show();
                $('.physical_damage_form').hide();
                $('.report_review_form').hide();
                $('.other_analysis_form').hide(); 
            ';
            break;
        case 'Report Review':
            echo '
                $('.accident_reconstruction_form').hide();
                $('.vehicle_theft_form').hide();
                $('.fire_analysis_form').hide();
                $('.mechanical_analysis_form').hide();
                $('.physical_damage_form').hide();
                $('.report_review_form').show();
                $('.other_analysis_form').hide(); 
            ';
            break;
        case 'Other':
        default:
            echo '
                $('.accident_reconstruction_form').hide();
                $('.vehicle_theft_form').hide();
                $('.fire_analysis_form').hide();
                $('.mechanical_analysis_form').hide();
                $('.physical_damage_form').hide();
                $('.report_review_form').hide();
                $('.other_analysis_form').show(); 
            ';
            break;
    }*/
?>
        
    function change_visible_form(value){
        $('.job_specific_forms > div:visible').hide();
        //$('.job_specific_forms input').attr({ 'checked':'', 'selected':'' });
        //$('.job_specific_forms textarea').attr({ 'value':'' });
        switch(value){
            case '1': $('.vehicle_theft_form').show();
                break;
            case '2': $('.accident_reconstruction_form').show();
                break;
            case '3': $('.fire_analysis_form').show();
                break;
            case '4': $('.mechanical_analysis_form').show();
                break;
            case '5': $('.physical_damage_form').show();
                break;
            case '6': $('.report_review_form').show();
                break;
            case '7': $('.other_analysis_form').show();
                break;
        }
    };  
    
    var a_show = 0;
    var b_show = 0;
    
    function cl_a_show(){
        if (a_show==0){
            $('.claimant_a_form').show();
            $('#cl_a_button').find('span').text('Hide');
            a_show=1;
        }else{
            $('.claimant_a_form').hide();
            $('#cl_a_button').find('span').text('Show');
            a_show=0;
        }
    }
            
    function cl_b_show(){
        if (b_show==0){
             $('.claimant_b_form').show();
             $('#cl_b_button').find('span').text('Hide');
             b_show=1;
        }else{
             $('.claimant_b_form').hide();
             $('#cl_b_button').find('span').text('Show');
             b_show=0;
        }
    }

})(jQuery);
</script>

</form>
<?php 
    echo'</div>';
?>
