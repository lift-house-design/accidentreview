<?php
$the_bios = get_pages(array(
    'child_of' => get_option('hi_accident_bios_page')
));
?>
    <div class="accident-request-type-page">

        <div id="crumb">
            <br />
        </div>        
        <script type="text/javascript">
        $("#replaceme").replaceWith($("#crumb"));

        
        //$("#sidebar").replaceWith($("#mysidebar"));
        $("#mysidebar").hide();
        $("h2").addClass("margined");
        </script>
        <p class="margined">Assignment will be completed within 24 hours</p>
        <div class="new-assignment margined">
            <br />
            <ul>
                <li class="first">Select Job Assignment Type</li>
                <li><a class="theft" href="/reps/assignments/request?type=vehicle-theft-analysis">Vehicle Theft Analysis »</a></li>
                <li><a class="reconstruct" href="/reps/assignments/request?type=accident-reconstruction">Accident Reconstruction »</a></li>
                <li><a class="fire" href="/reps/assignments/request?type=fire-analysis">Fire Analysis »</a></li>
                <li><a class="mechanics" href="/reps/assignments/request?type=mechanical-analysis">Mechanical Analysis »</a></li>
                <li><a class="damage" href="/reps/assignments/request?type=physical-damage-comparison">Physical Damage Comparison »</a></li>
                <li><a class="report" href="/reps/assignments/request?type=report-review">Report Review »</a></li>
                <li><a class="other" href="/reps/assignments/request?type=other">Other »</a></li>
            </ul>
            <a class="link" href="/reps/service">Services Details »</a>
        </div>

        <div class="instructions">
            <div class="top">
                <div class="bottom">
                    <h3 class="unselectable toggler">Instructions</h3>
                    <div id="toggleable">
                        <p><strong>To Make assignments</strong></p>	
                        <ol>
                            <li>Select assignment type (you will be directed to another page)</li>
                            <li>Complete assignment form</li>
                            <li>Submit assignment</li>
                        </ol>
                        <p><strong>Manage assignments</strong></p>
                        <p>To manage assignments, click the "assignments" tab at the top of the page. From there you will be able to view and edit open, pending and complete assignments.</p>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(".toggler").click(function() {
                    $("#toggleable").toggle();
                    $(".toggler").toggleClass("toggled");
                })
            </script>
        </div>

    </div>