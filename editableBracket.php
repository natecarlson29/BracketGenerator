<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery.bracket.min.js"></script>
        <link rel="stylesheet" type="text/css" href="jquery.bracket.min.css" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Brackets - Bracket in Progress</title>
    </head>
    <body>
        <header>
            <h1>Capstone Bracket Generator</h1>
        </header>
        <nav>
            <a href="index.php?action=gotoPlayerSearch">Search Players</a>
            <a href="index.php?action=gotoViewTournaments">View Tournaments</a>
            <?php if($_SESSION['user_logged'] != ''){
                echo('<a href="index.php?action=gotoTournamentCreation">Create New Bracket</a>');
                echo('<a href="index.php?action=logout">Logout</a>');
            }else{
                echo('<a href="index.php?action=gotoLogin">Login</a>');
            }
            if($_SESSION['user_logged'] == 'admin'){
                echo('<a href="index.php?action=gotoRegistration">TO Registration</a>');
            }
?>
        </nav>
        <div class='wrapper1'> 
                <div class="tournament"></div>
                <div class="submitBracket"><h1>Submit Bracket</h1></div>
                <div class="kj"></div>
                    <script>
                        var multidimensionalArray = [];
                        
                        var playersArray = <?php echo json_encode($_SESSION['currentTourney']->getEntrants()); ?>;
                        
                        var i=0;
                        while(i*2<playersArray.length){
                            var valueTeams = new Array(2);
                            if(playersArray[i] !== null){
                                valueTeams[0] = '('+(i+1)+')'+playersArray[i];
                            }else{
                                valueTeams[0] = null;
                            }
                            if(playersArray[((playersArray.length)-1)-i] !== null){
                                valueTeams[1] = '('+(playersArray.length-i)+')'+playersArray[((playersArray.length)-1)-i];
                            }else{
                                valueTeams[1] = null;
                            }
                            multidimensionalArray.push(valueTeams);
                            i++;
                        }
                        
                        var autoCompleteData = {
                            teams : multidimensionalArray,
                            results : [[[[]]], [], []]
                          }

                        /* Data for autocomplete */
                        var acData = ["kr:MC", "ca:HuK", "se:Naniwa", "pe:Fenix",
                                      "us:IdrA", "tw:Sen", "fi:Naama"]

                        /* If you call doneCb([value], true), the next edit will be automatically 
                           activated. This works only in the first round. */
                        function acEditFn(container, data, doneCb) {
                          var input = $('<input type="text">')
                          input.val(data)
                          input.autocomplete({ source: acData })
                          input.blur(function() { doneCb(input.val()) })
                          input.keyup(function(e) { if ((e.keyCode||e.which)===13) input.blur() })
                          container.html(input)
                          input.focus()
                        }

                        function acRenderFn(container, data, score, state) {
                          switch(state) {
                            case 'empty-bye':
                              container.append('BYE')
                              return;
                            case 'empty-tbd':
                              container.append('TBD')
                              return;

                            case 'entry-no-score':
                            case 'entry-default-win':
                            case 'entry-complete':
                              var fields = data.split(':')
                              if (fields.length != 1)
                                container.append('<i>INVALID</i>')
                              else
                                container.append(fields[0])
                              return;
                          }
                        }

                        $(function() {
                            $('.tournament').bracket({
                              init: autoCompleteData,
                              save: function(){}, /* without save() labels are disabled */
                              disableToolbar : true,
                              teamWidth : 140,
                              decorator: {edit: acEditFn,
                                          render: acRenderFn}})
                        })   
                        
                        function saveFn(data, userData) {
                            var json = jQuery.toJSON(data)
                            alert('test');
                            $('#saveOutput').text('POST '+userData+' '+json)
                            /* You probably want to do something like this
                            jQuery.ajax("rest/"+userData, {contentType: 'application/json',
                                                          dataType: 'json',
                                                          type: 'post',
                                                          data: json})
                            */
                          }
                          
                        $(function() {
                            var container = $('.tournament')
                            container.bracket({
                              init: saveData,
                              save: saveFn,
                              userData: "http://myapi"})

                            /* You can also inquiry the current data */
                            var data = container.bracket('data')
                            $('#dataOutput').text(jQuery.toJSON(data))
                        })
                       
                    </script>
                    <script>
                    $( document ).ready(function() {
                        $( ".submitBracket" ).click(function() {
                            var firstPlace = $('.bubble:contains("1st")').prev().prev().html();
                            var firstPlaceF = firstPlace.substring(firstPlace.indexOf(")") + 1);
                            
                            var secondPlace = $('.bubble:contains("2nd")').prev().prev().html();
                            var secondPlaceF = secondPlace.substring(secondPlace.indexOf(")") + 1);
                            
                            var thirdPlace = $('.bubble:contains("3rd")').prev().prev().html();
                            var thirdPlaceF = thirdPlace.substring(thirdPlace.indexOf(")") + 1);
                            
                            var fourthPlace = $('.bubble:contains("4th")').prev().prev().html();
                            var fourthPlaceF = fourthPlace.substring(fourthPlace.indexOf(")") + 1);
                            //var foundIn = $('div:contains("1st")').val;
                            window.location.href = "index.php?action=gotoResults&first="+firstPlaceF+"&second="+secondPlaceF+"&third="+thirdPlaceF+"&fourth="+fourthPlaceF;
                        });
                    });
                    </script>
            </div>
        <footer>Nate Carlson - Solo Capstone Project</footer>
    </body>
</html>
