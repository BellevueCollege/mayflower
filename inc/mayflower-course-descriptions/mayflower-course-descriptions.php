<?php
#######################################################
## Add course description shortcode
#######################################################

/**************************************
 * Aggregate functions and WP actions
 **************************************/


add_shortcode('coursedescription', 'coursedescription_func');  //declare single course shortcode function

/*****************************
 * Single course functions
 *****************************/


//function for rendering single course shortcode into HTML
function coursedescription_func($atts)
{
	$subject = $atts["subject"];
	$course = $atts["courseid"]; // Attribute name should always read in lower case.
	$description = $atts["description"];
	if (!empty($course) && !empty($subject)) {
		$course_split = explode(" ", $course);
		$course_letter = $course_split[0];
		$course_id = $course_split[1];
		$subject = trim(html_entity_decode($subject));
		// $url = "http://www.bellevuecollege.edu/classes/All/".$subject."?format=json";

		$url = 'https://www2.bellevuecollege.edu/data/api/v1/course/' . urlencode($subject) . '/' . urlencode(trim($course_id));
		$data = wp_remote_get($url);

		if (!empty($data) && !empty($data['body']) && !empty($data['body'])) {
			$json = json_decode($data['body']);
			$html = mayflower_decode_json_class_info($json, $description);
			return $html;
		}
	}
	return null;
}

//process json returned by API call
function mayflower_decode_json_class_info($json, $show_description = false)
{
	// return print_r( $course, true );
	$htmlString = '';
	$htmlString .= '<div class="classDescriptions">';

	$htmlString .= mayflower_course_html($json, $show_description);

	$htmlString .= "</div>"; //classDescriptions

	return $htmlString;
}


function mayflower_course_html($data, $show_description = false)
{
	if (isset($data->course)) { //if there is course data, return course information
		$course = $data->course;
		$title = $course->subject . ' '
			. $course->courseNumber . ': '
			. $course->title . ' - '
			. ($course->isVariableCredits ? 'variable' : $course->credits) . ' credits';

		$url = 'https://www2.bellevuecollege.edu/classes/All/' . $course->subject . '/' .
			$course->courseNumber;

		$description = $course->description;

		$more = 'View details for ' . $course->subject . ' '
			. $course->courseNumber;

		if ($show_description && 'false' != $show_description) {
			return "<h3><a href='$url'>$title</a></h3><p>$description</p><p><a href='$url'>$more</a></p>";
		} else {
			return "<h3><a href='$url'>$title</a></h3>";
		}
	} else { //if course not selected, return to inform user there are courses available
		return '<!-- No Course Available -->';
	}
}
