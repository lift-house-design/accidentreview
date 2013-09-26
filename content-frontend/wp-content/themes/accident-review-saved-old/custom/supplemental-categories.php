<?php


function build_vin_category_array($found_ids = array()){
    $out = array();
    foreach($display_category_values as $a_tab_name => $tab_content_ids){
        
        $tab_content = array();
        $tab_found_count = 0;
        
        foreach($tab_content_ids as $a_category_id){
            if(in_array($a_category_id,$found_ids)){
                
                $category_group_name = '';
                $generic_category_description = '';
                
                foreach($generic_category_values as $a_category_group_name => $category_group_ids){
                    foreach($category_group_ids as $the_category_id=>$the_category_generic_description){
                        if($a_category_id == $the_category_id){
                            $category_group_name = $a_category_group_name;
                            $generic_category_description = $the_category_generic_description;    
                        }
                    }
                }
                
                if($category_group_name != ''){
                    $tab_found_count++;
                    if(!array_key_exists($category_group_name,$tab_content)){
                        $tab_content[$category_group_name] = array();
                    }
                    $tab_content[$category_group_name][] = array(
                        'id' => $a_category_id,
                        'generic' =>   $generic_category_description
                    );
                }
            }
        }
        
        if($tab_found_count > 0){
            $out[$a_tab_name] = $tab_content;
        }
        
    }
    return $out;
}

function build_insurance_vin_category_array($found_ids = array()){
    $out = array();
    foreach($insurance_display_category_values as $a_tab_name => $tab_content_ids){
        
        $tab_content = array();
        $tab_found_count = 0;
        
        foreach($tab_content_ids as $a_category_id){
            if(in_array($a_category_id,$found_ids)){
                
                $category_group_name = '';
                $generic_category_description = '';
                
                foreach($generic_category_values as $a_category_group_name => $category_group_ids){
                    foreach($category_group_ids as $the_category_id=>$the_category_generic_description){
                        if($a_category_id == $the_category_id){
                            $category_group_name = $a_category_group_name;
                            $generic_category_description = $the_category_generic_description;    
                        }
                    }
                }
                
                if($category_group_name != ''){
                    $tab_found_count++;
                    if(!array_key_exists($category_group_name,$tab_content)){
                        $tab_content[$category_group_name] = array();
                    }
                    $tab_content[$category_group_name][] = array(
                        'id' => $a_category_id,
                        'generic' =>   $generic_category_description
                    );
                }
            }
        }
        
        if($tab_found_count > 0){
            $out[$a_tab_name] = $tab_content;
        }
        
    }
    return $out;
}

function build_vin_flat_id_array(){
    $out = array();
    foreach($display_category_values as $a_display_category=>$valid_ids){
        $out = array_merge($out,$valid_ids);
    }
    return $out;
}

function build_insurance_vin_flat_id_array(){
    $out = array();
    foreach($insurance_display_category_values as $a_display_category=>$valid_ids){
        $out = array_merge($out,$valid_ids);
    }
    return $out;
}


$display_category_values = array(
    'Engine' => array(
        '1045', '1046', '1047', '1048', '1049', '1050', '1051', '1052', '1053', '1054', '1057', '1058', '1059', '1135',
        '1152', '1165', '1209', '1213', '1217', '1218', '1221', '1226', '1229', '1302', '1306', '1307', '1308'
    ),
    'Steering and Suspension' => array(
        '1018', '1019', '1020', '1022', '1083', '1084', '1087', '1088', '1089', '1090', '1091', '1092', '1093', '1094', 
        '1095', '1096', '1097', '1098', '1099', '1123', '1124', '1125', '1128', '1129', '1139', '1193', '1202', '1207', 
        '1208', '1227', '1228', '1270'
    ),
    'Transmission and Drivetrain' => array(
        '1035', '1036', '1040', '1041', '1042', '1043', '1044', '1100', '1101', '1102', '1103', '1104', '1105', '1106', 
        '1107', '1108', '1134', '1145', '1146', '1147', '1148', '1180', '1195', '1196', '1210', '1220', '1301', '1033'
    ),
    'Safety' => array(
        '1001', '1002', '1004', '1005', '1006', '1007', '1008', '1145', '1142', '1298', '1197'
    ),
    'Body and Interior' => array(
        '1033', '1037', '1038', '1039', '1060', '1061', '1065', '1066', '1072', '1076', '1080', '1081', '1082', '1133', 
        '1138', '1141', '1142', '1143', '1144', '1151', '1153', '1154', '1155', '1158', '1168', '1169', '1173', '1174', 
        '1179', '1180', '1181', '1183', '1184', '1191', '1199', '1200', '1201', '1202', '1206', '1222', '1223', '1224', 
        '1273', '1298', '1303', '1304', '1305', '1211', '1212', '1296', '1068', '1069', '1070', '1071', '1073', '1126'
    ),
    'Security' => array(
        '1013', '1166', '1205', '1211', '1212', '1221', '1229', '1296'
    ),
    'Entry' => array(
        '1062', '1063', '1068', '1069', '1070', '1071', '1126', '1138', '1143', '1144', '1183', '1184', '1197', '1198', 
        '1206', '1305'
    )
);

$insurance_display_category_values = array(
    'Engine' => array(
        '1045', '1046', '1047', '1048', '1049', '1050', '1051', '1052', '1053', '1054', '1135', '1165'
    ),
    'Transmission' => array(
        '1101', '1102', '1103', '1104', '1105', '1106', '1107', '1108', '1146', '1147', '1148', '1210', '1220', '1301'
    )
);

$generic_category_values = array(
	'Other Information' => array(
		'1000'	=>	'No Category',
        '1194'	=>	'Spoiler-Rear'
	), 
	'Airbag Information' => array(		
		'1001'	=>	'Air Bag-Driver-Front',
		'1002'	=>	'Air Bag-Passenger-Front',
		'1004'	=>	'Air Bag-Passenger Switch (On/Off)',
		'1005'	=>	'Air Bag-Side-Body-Front',
		'1006'	=>	'Air Bag-Side-Body-Rear',
		'1007'	=>	'Air Bag-Side-Head-Front',
		'1008'	=>	'Air Bag-Side-Head-Rear'
	),
	'Air Conditioning Information' => array(
		'1009'	=>	'Air Cond-Auto Climate Control',
		'1010'	=>	'Air Cond-Dual Zone Front',
		'1011'	=>	'Air Cond-Front',
		'1012'	=>	'Air Cond-Rear'
	),
	'Alarm System Information' => array(
		'1013'	=>	'Alarm System'
	),
	'Stereo Information' => array(
		'1014'	=>	'Audio-AM/FM Stereo',
		'1016'	=>	'Audio-CD Changer',
		'1017'	=>	'Audio-CD Player',
		'1149'	=>	'Audio-Satellite Radio',
		'1150'	=>	'Audio-MP3 Player',
		'1136'	=>	'Audio-Upgrade Sound System',	
		'1162'	=>	'Audio-Rear Seat Audio Controls',
		'1163'	=>	'Audio-Equalizer',
		'1230'	=>	'Audio-Auxiliary Input',
		'1299'	=>	'Audio-HD Radio',
		'1298'	=>	'Display-Heads-Up',
		'1300'	=>	'Hard Disk Drive Media Storage',
		'1215'	=>	'Entertainment System'
	),
	'Braking Information' => array(
		'1018'	=>	'Brakes-ABS-4 Wheel',
		'1019'	=>	'Brakes-ABS-Rear',
		'1020'	=>	'Brakes-Type-4 Wheel DISC',
		'1022'	=>	'Brakes-Type-Front Disc/Rear Drum',	
		'1228'	=>	'Brake Assist'
	),	
	'Drivetrain Information' => array(
		'1040'	=>	'Drivetrain-4WD',
		'1041'	=>	'Drivetrain-AWD',
		'1042'	=>	'Drivetrain-FWD',
		'1043'	=>	'Drivetrain-RWD',
		'1044'	=>	'Dual Rear Wheels'
	),
	'Engine Information' => array(
		'1045'	=>	'Engine-10 Cyl',
		'1046'	=>	'Engine-12 Cyl',
		'1047'	=>	'Engine-3 Cyl',
		'1048'	=>	'Engine-4 Cyl',
		'1049'	=>	'Engine-5 Cyl',
		'1050'	=>	'Engine-6 Cyl-Straight',
		'1051'	=>	'Engine-6 Cyl-V6',
		'1135'	=>	'Engine-6 Cyl-Flat',
		'1052'	=>	'Engine-8 Cyl',
		'1165'	=>	'Engine-Rotary',	
		'1302'	=>	'Engine-Electric'
	),
	'Engine Supplemental Information' => array(
		'1053'	=>	'Engine-Supercharged',
		'1054'	=>	'Engine-Turbocharged',
		'1226'	=>	'Engine-High Output'
	),
	'Floor Mats Information' => array(
		'1055'	=>	'Floor Mats-Front',
		'1056'	=>	'Floor Mats-Rear'
	),
	'Fuel System Information' => array(
		'1057'	=>	'Fuel System-Propane',
		'1058'	=>	'Fuel System-Diesel',
		'1059'	=>	'Fuel System-Gasoline',
		'1152'	=>	'Fuel System-Gasoline/Electric Hybrid',
		'1167'	=>	'Fuel System-Plug-In Electric',
		'1209'	=>	'Fuel System-Natural Gas',
		'1213'	=>	'Fuel System-Flex Fuel',
		'1306'	=>	'Fuel System-Flex Fuel/Electric Hybrid',
		'1307'	=>	'Fuel System-Gasoline/Plug-In Electric',
		'1308'	=>	'Fuel System-Flex Fuel/Plug-In Electric'
	),
	'Headlights Information' => array(
		'1060'	=>	'Headlights-Auto-On',
		'1061'	=>	'Headlights-Daytime Running lights',
		'1168'	=>	'Headlights-High Intensity Discharge',
		'1169'	=>	'Headlights-Auto-Off',
		'1151'	=>	'Fog Lamps-Front'
	),
	'Roof Information' => array(
		'1068'	=>	'Roof-Sun-Popup/Removable',
		'1069'	=>	'Roof-Sun-Pwr Tilt/Sliding',
		'1070'	=>	'Roof-T-Top',
		'1071'	=>	'Roof-Targa',
		'1138'	=>	'Roof-Convertible Hardtop',
		'1143'	=>	'Roof-Panoramic',
		'1144'	=>	'Roof-Dual Moon',
		'1183'	=>	'Roof-Sun-Manual-Tilt/Sliding',
		'1184'	=>	'Roof-Sun-Fixed',
		'1185'	=>	'Roof-Sun-Shield',
		'1186'	=>	'Roof-Sun-Wind Deflector',
		'1305'	=>	'Roof-Convertible Soft Top',
        '1172'	=>	'Luggage Rack/Roof Rack'
	),
	'Seating Information' => array(
		'1073'	=>	'Seat-Additional Rear',
		'1074'	=>	'Seat-Pwr-Driver',
		'1075'	=>	'Seat-Pwr-Passenger',
		'1076'	=>	'Seat-Rear Pass-Through',
		'1077'	=>	'Seat Trim-Cloth',
		'1078'	=>	'Seat Trim-Leather',
		'1079'	=>	'Seat Trim-Vinyl',
		'1156'	=>	'Seat-Heated Driver',
		'1157'	=>	'Seat-Heated Passenger',
		'1189'	=>	'Seat-Lumbar-Driver',
		'1190'	=>	'Seat-Lumbar-Passenger',
		'1191'	=>	'Seat-Memory',
		'1266'	=>	'Seat-Heated Rear',
		'1267'	=>	'Seat-Cooled Driver',
		'1268'	=>	'Seat-Cooled Passenger',
		'1269'	=>	'Seat-Cooled Rear',
		'1080'	=>	'Seats-Front Bench-Fixed',
		'1081'	=>	'Seats-Front Bench-Split',
		'1082'	=>	'Seats-Front Bucket',
		'1141'	=>	'Seats-2nd Row Bucket',
		'1304'	=>	'Seats-2nd Row Bench',
		'1309'	=>	'Seat Trim-Premium Synthetic'
	),
	'Steering Information' => array(
		'1083'	=>	'Steering-Manual',
		'1084'	=>	'Steering-Pwr',
		'1270'	=>	'All Wheel Steering'
	),
	'Tire Information' => array(
		'1088'	=>	'Tire-Front-All-Season',
		'1089'	=>	'Tire-Front-All-Terrain',
		'1090'	=>	'Tire-Front-Highway',
		'1091'	=>	'Tire-Front-On/Off Road',
		'1092'	=>	'Tire-Front-Performance',
		'1093'	=>	'Tire-Rear-All-Season',
		'1094'	=>	'Tire-Rear-All-Terrain',
		'1095'	=>	'Tire-Rear-Highway',
		'1096'	=>	'Tire-Rear-On/Off Road',
		'1097'	=>	'Tire-Rear-Performance',
		'1098'	=>	'Tire-Spare-Compact',
		'1099'	=>	'Tire-Spare-Full-size',
		'1128'	=>	'Tire-Front-Touring',
		'1129'	=>	'Tire-Rear-Touring',
		'1202'	=>	'Tire-Pressure Monitoring System'
	),
	'Transmission Type' => array(
    	'1101'	=>	'Transmission-Auto-3 Spd',
    	'1102'	=>	'Transmission-Auto-4 Spd',
    	'1103'	=>	'Transmission-Auto-5 Spd',
    	'1104'	=>	'Transmission-Auto-6 Spd',
    	'1105'	=>	'Transmission-Manual-4 Spd',
    	'1106'	=>	'Transmission-Manual-5 Spd',
    	'1107'	=>	'Transmission-Manual-6 Spd',
    	'1108'	=>	'Transmission-Manual-7 Spd',
    	'1134'	=>	'Transmission-Continuously Variable',
    	'1146'	=>	'Transmission-Manual-8 Spd',
    	'1147'	=>	'Transmission-Manual-9 Spd',
    	'1148'	=>	'Transmission-Manual-10 Spd',
    	'1195'	=>	'Transmission-Dual Shift Mode',
    	'1196'	=>	'Transmission-Overdrive-Switch',
    	'1210'	=>	'Transmission-Auto-7 Spd',
    	'1301'	=>	'Transmission-Auto-1 Spd'
	),
    'Wheel Information' => array(
    	'1123'	=>	'Wheels-Aluminum',
    	'1124'	=>	'Wheels-Chrome',
    	'1208'	=>	'Wheels-Steel',
    	'1125'	=>	'Wheels-Wire Wheel Covers',
    	'1205'	=>	'Wheels-Locks',
    	'1207'	=>	'Wheels-Wheel Covers'
	),
	'Mirror Information' => array(
    	'1273'	=>	'Mirrors-Pwr Folding',
    	'1065'	=>	'Mirrors-Pwr Driver',
    	'1153'	=>	'Mirrors-Pwr Passenger',
    	'1154'	=>	'Mirrors-Heated Driver',
    	'1155'	=>	'Mirrors-Heated Passenger',
    	'1173'	=>	'Mirrors-Electrochromic Rearview',
    	'1174'	=>	'Mirrors-Integrated Turn Signals',
    	'1175'	=>	'Mirrors-Vanity-Driver',
    	'1176'	=>	'Mirrors-Vanity-Passenger',
    	'1177'	=>	'Mirrors-Vanity-Driver Illuminated',
    	'1178'	=>	'Mirrors-Vanity-Passenger Illuminated',
    	'1179'	=>	'Mirrors-Memory'
	),
    'Lock Information' => array(
    	'1063'	=>	'Locks-Pwr',
    	'1039'	=>	'Locks-Child Safety Rear Door',
    	'1062'	=>	'Keyless Entry'
	),
    'Windshield Wipers Information' => array(
    	'1127'	=>	'Wipers-Intermittent',
    	'1159'	=>	'Wipers-Variable Speed Intermittent',
    	'1160'	=>	'Wipers-Rain Sensing'
	),
    'Differential Information' => array(
    	'1035'	=>	'Differential-Locking Front',
    	'1036'	=>	'Differential-Locking Rear'
	),
    'Door Information' => array(
    	'1037'	=>	'Door-Passenger 3rd',
    	'1038'	=>	'Door-Passenger 4th',
    	'1222'	=>	'Door-Passenger 3rd-Power',
    	'1223'	=>	'Door-Passenger 4th-Power'
	),
    'Window Information' => array(
    	'1126'	=>	'Windows-Pwr',
    	'1158'	=>	'Windows-Deep Tinted',
    	'1206'	=>	'Window-Sliding Rear',
        '1034'	=>	'Defogger-Rear Window'
	),
    'Steering Wheel Information' => array(
    	'1161'	=>	'Steering Wheel-Audio Controls',
    	'1192'	=>	'Steering Wheel-Leather Wrapped',
    	'1087'	=>	'Steering Wheel-Adjustable'
	),
    'Suspension Type' => array(
    	'1139'	=>	'Suspension-Air',
    	'1193'	=>	'Suspension-Active Suspension System'
	),
    'Electronics Options' => array(
    	'1033'	=>	'Cruise Control',
    	'1066'	=>	'Navigation System',
    	'1142'	=>	'Night Vision',
    	'1180'	=>	'Parking Aid',
    	'1203'	=>	'Trip Computer',
    	'1204'	=>	'Universal Garage Door Opener',
    	'1164'	=>	'Auxiliary Pwr Outlet',
    	'1221'	=>	'Remote Engine Start',
    	'1224'	=>	'Back-Up Camera',
    	'1229'	=>	'Keyless Start'
	),
    'Towing Information' => array(
    	'1199'	=>	'Trailer Hitch Receiver',
    	'1200'	=>	'Tow Hooks-Front',
    	'1201'	=>	'Tow Hooks-Rear'
	),
    'Running Boards Information' => array(
    	'1072'	=>	'Running Boards',
    	'1303'	=>	'Running Boards-Pwr Retract'
	),
    'Trunk Information' => array(
    	'1197'	=>	'Trunk-Emergency Release',
    	'1198'	=>	'Trunk-Release-Remote'
	),
    'Interior Information' => array(
    	'1272'	=>	'Interior-Cargo Shade',
    	'1170'	=>	'Interior-Trim-Woodgrain',
    	'1187'	=>	'Reading Lamps-Front',
    	'1188'	=>	'Reading Lamps-Rear',
        '1182'	=>	'Rear Seat Heat Ducts',
        '1181'	=>	'Pedals-Adjustable'
	),
    'Telematics' => array(
    	'1212'	=>	'Telematics',
    	'1296'	=>	'Telematics-Navigation'
	),
    'Truck Bed Information' => array(
    	'1216'	=>	'Bed Liner',
    	'1271'	=>	'Bed-Tonneau Cover',
    	'1225'	=>	'Power Liftgate',
        '1133'	=>	'Stepside Pickup Box'
	),
    'Safety Related' => array(
    	'1100'	=>	'Traction Control',
    	'1145'	=>	'Rollover Protection System',
    	'1211'	=>	'Telephone-Hands-Free Wireless Connection',
    	'1227'	=>	'Electronic Stability Control'
	),
	'Security Related' => array(
	   '1166'	=>	'Engine Immobilizer/Vehicle Anti-Theft System'
	)
);

?>